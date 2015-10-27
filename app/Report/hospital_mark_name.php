<?php
  /* 厂商 医院Mark使用情况表 */
  //header("Content-Type:text/html;charset=utf-8");
  $mysqli = new mysqli('118.244.197.36','root','HWVosvmGYP6knCjp6Ihx','robot');
  
  /* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
  
  $provinceid=$_POST['provinceid'];
  $cityid=$_POST['cityid'];
  $starttime=$_POST['starttime'];
  $endtime=$_POST['endtime'];
  $agencyid=$_POST['agencyid'];

 /*
 //将$agencyid设置为-1即不加代理商过滤
  $provinceid=26;
  $cityid=2;
  $starttime="2015-07-01 00:00:00";
  $endtime="2015-09-01 00:00:00";
  $agencyid="";
  */
  if(! filter_var($starttime, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/s"))))
  {
     die("invalid starttime");
  }
  
  if(! filter_var($endtime, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/s"))))
  {
     die("invalid endtime");
  }
  
  if(! filter_var($provinceid, FILTER_VALIDATE_INT))
  {
     die("invalid provinceid");
  }
  
  if(! filter_var($cityid, FILTER_VALIDATE_INT))
  {
     die("invalid cityid");
  }
  
  if($agencyid!=""&&!filter_var($agencyid, FILTER_VALIDATE_INT))
  {
     die("invalid agencyid");
  }
  
  /*解决字符编码*/
  $query="set names 'utf8';";
  $mysqli->query($query);
  
  /* 创建所有卖给位于该地区的hospital的mark情况使用视图 */
  $query="DROP VIEW IF EXISTS `hospital_agency_mark_name`;";
  $mysqli->query($query);
  $query = "create view hospital_agency_mark_name 
  (mark_id,agency_id,agency_name,hospital_id,hospital_name,used_at,status,damaged_at,sold_at) as 
  select i_mark.id,agency_id,i_agency.name,hospital_id,i_hospital.name,used_at,i_mark.status,damaged_at,sold_at 
  from i_mark,i_agency,i_hospital
  where agency_id=i_agency.id and i_hospital.id=hospital_id and i_hospital.province_id=$provinceid and i_hospital.city_id=$cityid;"; 
  $viewresult = $mysqli->query($query);
   
  /* 创建该地区医院与所有代理商的cross join视图(hospital_cross_agency)  由于视图不能包含子查询，故采用视图嵌套*/
  $query="DROP VIEW IF EXISTS `hospital_region`;";   //该视图包含该地区的医院 
  $mysqli->query($query);
  $query = " create view hospital_region(hospital_id,hospital_name) as 
  select id,name from i_hospital where province_id=$provinceid and city_id=$cityid order by name;";
  $viewresult = $mysqli->query($query);
  
  $query="DROP VIEW IF EXISTS `hospital_cross_agency`;";
  $mysqli->query($query);
  $query = "create view hospital_cross_agency 
  (hospital_id,hospital_name,agency_id,agency_name) as 
  select hospital_id,hospital_name,id,name from 
  hospital_region cross join i_agency order by hospital_name,name;";
  $viewresult = $mysqli->query($query);

  if($agencyid==""){ //代理商一栏选择‘不限’ 这里定义为""
 //1.购买总数
  $query= "select distinct maintable.agency_name,maintable.hospital_name,ifnull(subtable.num,0) as buynum 
  from hospital_cross_agency as maintable left join
  (select agency_name,hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where sold_at>='$starttime' and sold_at<='$endtime' group by agency_name,hospital_name ) 
   as subtable on maintable.agency_name=subtable.agency_name and maintable.hospital_name=subtable.hospital_name 
   order by hospital_name,agency_name";
  $buyresult=$mysqli->query($query);
  //2.已使用
    $query= "select distinct maintable.agency_name,maintable.hospital_name,ifnull(subtable.num,0) as usenum 
  from hospital_cross_agency as maintable left join
  (select agency_name,hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where used_at>='$starttime' and used_at<='$endtime' and status=2  group by agency_name,hospital_name ) 
   as subtable on maintable.agency_name=subtable.agency_name and maintable.hospital_name=subtable.hospital_name 
   order by hospital_name,agency_name";
  $useresult=$mysqli->query($query);
  //3.已损坏
    $query= "select distinct  maintable.agency_name,maintable.hospital_name,ifnull(subtable.num,0) as badnum 
  from hospital_cross_agency as maintable left join
  (select agency_name,hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where damaged_at>='$starttime' and damaged_at<='$endtime' and status=3 group by agency_name,hospital_name ) 
   as subtable on maintable.agency_name=subtable.agency_name and maintable.hospital_name=subtable.hospital_name 
   order by hospital_name,agency_name";
  $badresult=$mysqli->query($query);
  //4.损坏已更新
   $query= "select distinct maintable.agency_name,maintable.hospital_name,ifnull(subtable.num,0) as updatenum 
  from hospital_cross_agency as maintable left join
  (select agency_name,hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where damaged_at>='$starttime' and damaged_at<='$endtime' and status=4 group by agency_name,hospital_name ) 
   as subtable on maintable.agency_name=subtable.agency_name and maintable.hospital_name=subtable.hospital_name 
   order by hospital_name,agency_name";
  $updateresult=$mysqli->query($query);
  
  //5.总库存
   $query= "select distinct maintable.agency_name,maintable.hospital_name,ifnull(subtable.num,0) as stocknum 
  from hospital_cross_agency as maintable left join
  (select name ,count(i_mark.id) as num from i_mark,i_hospital 
  where hospital_id=i_hospital.id and (status=1 or status=4) group by name ) 
   as subtable on  maintable.hospital_name=name order by hospital_name,agency_name";
  $stockresult=$mysqli->query($query);
  }
  else{ //代理商选择了一个id
  //1.购买总数
  $query = "select name into @agency_name from i_agency where id=@agencyid;";
  $mysqli->query($query);
  
  $query= "select @agency_name as agency_name,maintable.hospital_name,ifnull(subtable.num,0) as buynum 
  from (select distinct hospital_name from hospital_region ) as maintable left join
  (select hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where sold_at>='$starttime' and sold_at<='$endtime' and agency_id=@agencyid group by hospital_name ) 
   as subtable on maintable.hospital_name=subtable.hospital_name order by hospital_name";
  $buyresult=$mysqli->query($query);
  //2.已使用
    $query= "select @agency_name as agency_name,maintable.hospital_name,ifnull(subtable.num,0) as usenum 
  from (select distinct hospital_name from hospital_region ) as maintable left join
  (select hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where  agency_id=@agencyid and used_at>='$starttime' and used_at<='$endtime' and status=2  group by hospital_name ) 
   as subtable on maintable.hospital_name=subtable.hospital_name order by hospital_name";
  $useresult=$mysqli->query($query);
  //3.已损坏
    $query= "select @agency_name as agency_name, maintable.hospital_name,ifnull(subtable.num,0) as badnum 
  from (select distinct hospital_name from hospital_region )  as maintable left join
  (select hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where agency_id=@agencyid and damaged_at>='$starttime' and damaged_at<='$endtime' and status=3 group by hospital_name ) 
   as subtable on maintable.hospital_name=subtable.hospital_name order by hospital_name";
  $badresult=$mysqli->query($query);
  //4.损坏已更新
   $query= "select @agency_name as agency_name, maintable.hospital_name,ifnull(subtable.num,0) as updatenum 
  from (select distinct hospital_name from hospital_region ) as maintable left join
  (select hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where agency_id=@agencyid and damaged_at>='$starttime' and damaged_at<='$endtime' and status=4 group by hospital_name ) 
   as subtable on maintable.hospital_name=subtable.hospital_name order by hospital_name";
  $updateresult=$mysqli->query($query);
  //5.总库存
   $query= "select @agency_name as agency_name, maintable.hospital_name,ifnull(subtable.num,0) as stocknum 
  from (select distinct hospital_name from hospital_region ) as maintable left join
  (select name ,count(i_mark.id) as num from i_mark,i_hospital 
  where hospital_id=i_hospital.id and (status=1 or status=4) group by name) 
   as subtable on maintable.hospital_name=subtable.name order by hospital_name";
  $stockresult=$mysqli->query($query);
  }

  echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html>
		<head>
		 <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		  <style type="text/css">
              @media print
			  {
			     #show{
				   width:100%;
				   margin:0;
				   padding:0	 
				 }
				 table.gridtable {
				 font-size:8px  !important;
				 }
			  }
			  
			   table.gridtable {
			         
					  font-family: verdana,arial,sans-serif;
					  font-size:11px;
					  color:#333333;
					  border-width: 1px;
					  border-color: #666666;
					  border-collapse: collapse;
				  }
				  table.gridtable th {
					  border-width: 1px;
					  padding: 8px;
					  border-style: solid;
					  border-color: #666666;
					  background-color: #dedede;
					  text-align:center;
				  }
				  table.gridtable td {
				      text-align:center;
					  border-width: 1px;
					  padding: 8px;
					  border-style: solid;
					  border-color: #888888;
					  background-color: #fff;
				  }
		  </style>
		</head>
		<body>

		  <table id="show" class="gridtable" >
			<caption style="font-family:Arial, Helvetica;text-align:left;font-size:30px;text-align:center">医院mark使用情况表</caption>
			<thead>
				<tr style="background: #FFF"><th>医院 </th><th>代理商 </th><th>购买总数 </th><th>库存 </th><th>已使用 </th><th>已损坏 </th><th>损坏已更新 </th></tr>
			</thead>
			<tbody>  ';
			
  $num=0; //初始化为0
  $i=0;
  $name1 = "0";
  while($buyrow = $buyresult->fetch_array()
		and $userow = $useresult->fetch_array()  
		and $badrow = $badresult->fetch_array()
		and $updaterow = $updateresult->fetch_array()
		and $stockrow = $stockresult->fetch_array()
		)
	{//$s代表show
	  $sagencyname = $buyrow['agency_name'];
	  $shospitalname = $buyrow['hospital_name'];
	  $sbuynum[$num] = $buyrow['buynum'];
	  $sstocknum[$num] = $stockrow['stocknum'];
	  $susenum[$num] = $userow['usenum'];
	  $sbadnum[$num] = $badrow['badnum'];
	  $supdatenum[$num] = $updaterow['updatenum'];
	  if($name1===$shospitalname) $sstocknum[$num] = 0;
	  $name1 = $shospitalname;
	//按行显示至表格
	  echo "<tr><td>$shospitalname </td><td>$sagencyname </td><td> $sbuynum[$num]</td>
	       <td>$sstocknum[$num]</td> <td>$susenum[$num]</td> <td>$sbadnum[$num]</td> <td>$supdatenum[$num]</td>
	  </tr>";
	  $num++;
	}
	
		$tsbuynum=0;
		$tsstocknum=0;
		$tsusenum=0;
		$tsbadnum=0;
		$tsupdatenum=0;
		
	for($i=0;$i<$num;$i++)
	{
	   //算出各num总数,变量名前加ts，t代表total  s代表show
	   $tsbuynum += $sbuynum[$i];
	   $tsstocknum += $sstocknum[$i];
	   $tsusenum += $susenum[$i];
	   $tsbadnum += $sbadnum[$i];
	   $tsupdatenum += $supdatenum[$i];
	}
		//将总数显示出来
		echo "<tr><td>总数 </td><td> </td><td> $tsbuynum </td>
	       <td>$tsstocknum </td> <td>$tsusenum </td> <td>$tsbadnum </td> <td>$tsupdatenum </td>
	  </tr>";

	echo '</tbody>
		  </table> 
		</body>
		</html>';	
	$mysqli->close();
?>