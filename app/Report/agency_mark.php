<?php
  /* 厂商 代理商Mark情况统计表 */
  header("Content-Type:text/html;charset=utf-8");
  $mysqli = new mysqli('localhost','root',null,'robot');
  
  /* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
  /*解决字符编码*/
  $query="set names 'utf8'";
  $mysqli->query($query);
  
  
  $provinceid=$_POST['provinceid'];
  $cityid=$_POST['cityid'];
  $starttime=$_POST['starttime'];
  $endtime=$_POST['endtime'];
 
 /*
  $starttime="2015-07-01 00:00:00";
  $endtime="2015-09-01 00:00:00";
  $provinceid=22;
  $cityid=2;
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
  
  $query="DROP VIEW IF EXISTS `agency_mark`;";
  $mysqli->query($query);
  
  //地区来限制代理商，代理商按行显示
  //查询 库存总数	已销售	已损坏	损坏已更新	已绑定	使用未绑定	已结账	绑定未结账
  $query = "create view agency_mark 
  (mark_id,province_id,city_id,agency_id,agency_name,sold,sold_at,damaged_at,used_at,doctor_id,archive_at,status,hospital_id) as 
  select i_mark.id,province_id,city_id,agency_id,i_agency.name,sold,sold_at,damaged_at,used_at,doctor_id,archive_at,i_mark.status,i_mark.hospital_id from i_mark,i_agency
  where   province_id=$provinceid and city_id= $cityid and agency_id=i_agency.id;";
  $viewresult = $mysqli->query($query);
  
  /*库存总数*/
  $query = "select distinct maintable.province_id,maintable.city_id,maintable.name,ifnull(subtable.num,0) as stocknum from 
  (select * from i_agency where  province_id=$provinceid and city_id= $cityid) as maintable left join
  (select agency_name,count(mark_id) as num from agency_mark where hospital_id=-1 and status=1 group by agency_name ) as subtable 
  on maintable.name=subtable.agency_name order by name;";
  $stockresult = $mysqli->query($query);
  
  /*已销售*/
  $query = "select distinct maintable.province_id,maintable.city_id,maintable.name,ifnull(subtable.num,0) as soldnum from 
  (select * from i_agency where  province_id=$provinceid and city_id= $cityid) as maintable left join
  (select agency_name,count(mark_id) as num from agency_mark where sold_at>='$starttime' and sold_at<='$endtime' group by agency_name ) as subtable 
  on maintable.name=subtable.agency_name order by name;";
  $soldresult = $mysqli->query($query);
  
  /*已损坏*/
  $query = "select distinct maintable.province_id,maintable.city_id,maintable.name,ifnull(subtable.num,0) as badnum from 
  (select * from i_agency where  province_id=$provinceid and city_id= $cityid)  as maintable left join
  (select agency_name,count(mark_id) as num from agency_mark where damaged_at>='$starttime' and damaged_at<='$endtime' and status=3 group by agency_name ) as subtable 
  on maintable.name=subtable.agency_name order by name;";
  $badresult = $mysqli->query($query);
  
  /*损坏已更新*/
  $query = "select distinct maintable.province_id,maintable.city_id,maintable.name,ifnull(subtable.num,0) as updatenum from 
  (select * from i_agency where  province_id=$provinceid and city_id= $cityid) as maintable left join
  (select agency_name,count(mark_id) as num from agency_mark where damaged_at>='$starttime' and damaged_at<='$endtime' and status=4 group by agency_name ) as subtable 
  on maintable.name=subtable.agency_name order by name;";
  $updateresult = $mysqli->query($query); 
  
  /*已绑定*/
  $query = "select distinct maintable.province_id,maintable.city_id,maintable.name,ifnull(subtable.num,0) as bindnum from 
  (select * from i_agency where  province_id=$provinceid and city_id= $cityid) as maintable left join
  (select agency_name,count(mark_id) as num from agency_mark where used_at>='$starttime' and used_at<='$endtime' and ifnull(doctor_id,-1)!=-1 group by agency_name ) as subtable 
  on maintable.name=subtable.agency_name order by name;";
  $bindresult = $mysqli->query($query);   
  
  /*使用未绑定*/
  $query = "select distinct maintable.province_id,maintable.city_id,maintable.name,ifnull(subtable.num,0) as unbindnum from 
  (select * from i_agency where  province_id=$provinceid and city_id= $cityid) as maintable left join
  (select agency_name,count(mark_id) as num from agency_mark where used_at>='$starttime' and used_at<='$endtime' and ifnull(doctor_id,-1)=-1 group by agency_name ) as subtable 
  on maintable.name=subtable.agency_name order by name;";
  $unbindresult = $mysqli->query($query);     
  
  /*已结账*/
  $query = "select distinct maintable.province_id,maintable.city_id,maintable.name,ifnull(subtable.num,0) as archivenum from 
  (select * from i_agency where  province_id=$provinceid and city_id= $cityid) as maintable left join
  (select agency_name,count(mark_id) as num from agency_mark where archive_at>='$starttime' and archive_at<='$endtime' group by agency_name ) as subtable 
  on maintable.name=subtable.agency_name order by name;";
  $archiveresult = $mysqli->query($query);  
  
  /*绑定未结账*/
   $query = "select distinct maintable.province_id,maintable.city_id,maintable.name,ifnull(subtable.num,0) as unarchivenum from 
   (select * from i_agency where  province_id=$provinceid and city_id= $cityid) as maintable left join
  (select agency_name,count(mark_id) as num from agency_mark where archive_at<=>null and used_at>='$starttime' and used_at<='$endtime' and ifnull(doctor_id,-1)!=-1 group by agency_name ) as subtable 
  on maintable.name=subtable.agency_name order by name;";
  $unarchiveresult = $mysqli->query($query);  
  
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
			<caption style="font-family:Arial, Helvetica;text-align:left;font-size:30px;text-align:center">代理商mark情况统计表</caption>
			<thead>
				<tr ><th>省份id </th><th>城市id </th><th>代理商 </th><th>库存总数 </th><th>已销售 </th><th>已损坏 </th><th>损坏已更新 </th>
				<th>已绑定 </th><th>使用未绑定 </th><th>已结账 </th> <th>绑定未结账 </th></tr>
			</thead>
			<tbody>  ';
					
  $num=0; //初始化为0,用来记录该报表行数
  $i=0;  //临时变量 统计总数时会用到
  
  while($stockrow = $stockresult->fetch_array()
		and $soldrow = $soldresult->fetch_array()  
		and $badrow = $badresult->fetch_array()
		and $updaterow = $updateresult->fetch_array()
		and $bindrow = $bindresult->fetch_array()
		and $unbindrow = $unbindresult->fetch_array()
		and $archiverow = $archiveresult->fetch_array()
		and $unarchiverow = $unarchiveresult->fetch_array()
		)
		
	{//$s代表show
	  $sprovinceid = $stockrow['province_id'];
	  $scityid = $stockrow['city_id'];
	  $sagencyname = $stockrow['name'];
	  $sstocknum[$num] = $stockrow['stocknum'];
	  $ssoldnum[$num] = $soldrow['soldnum'];
	  $sbadnum[$num] = $badrow['badnum'];
	  $supdatenum[$num] = $updaterow['updatenum'];
	  $sbindnum[$num] = $bindrow['bindnum'];
	  $sunbindnum[$num] = $unbindrow['unbindnum'];
	  $sarchivenum[$num] = $archiverow['archivenum'];
	  $sunarchivenum[$num] = $unarchiverow['unarchivenum'];
	//按行显示至表格
	  echo "<tr><td> $sprovinceid </td><td> $scityid </td> <td>$sagencyname </td><td> $sstocknum[$num]</td>
	       <td>$ssoldnum[$num]</td> <td>$sbadnum[$num]</td> <td>$supdatenum[$num]</td> <td>$sbindnum[$num] </td>
		   <td>$sunbindnum[$num] </td>  <td>$sarchivenum[$num] </td>  <td>$sunarchivenum[$num] </td>
	  </tr>";
	  $num++;
	}
	
		$tsstocknum=0;
		$tssoldnum=0;
		$tsbadnum=0;
		$tsupdatenum=0;
		$tsbindnum=0;
		$tsunbindnum=0;
        $tsarchivenum=0;
        $tsunarchivenum=0;		

	for($i=0;$i<$num;$i++)
	{
	   //算出各num总数,变量名前加ts，t代表total  s代表show

	    $tsstocknum+=$sstocknum[$i];
		$tssoldnum+=$ssoldnum[$i];
		$tsbadnum+=$sbadnum[$i];
		$tsupdatenum+=$supdatenum[$i];
		$tsbindnum+=$sbindnum[$i];
		$tsunbindnum+=$sunbindnum[$i];
        $tsarchivenum+=$sarchivenum[$i];
        $tsunarchivenum+=$sunarchivenum[$i];		
	}
		//将总数显示出来
		echo "<tr><td>总数 </td><td style='border-right-width:0'> </td><td style='border-left-width:0'> </td><td> $tsstocknum </td>
	       <td>$tssoldnum </td> <td>$tsbadnum </td> <td>$tsupdatenum </td> <td>$tsbindnum </td>
		   <td>$tsunbindnum </td>  <td>$tsarchivenum </td>  <td>$tsunarchivenum </td>
	  </tr>";
	echo '</tbody>
		  </table> 
		</body>
		</html>';

  $mysqli->close();
?>