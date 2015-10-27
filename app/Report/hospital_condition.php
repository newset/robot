<?php
/* 厂商 医院情况表 */
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
  
  if($agencyid!=""&&! filter_var($agencyid, FILTER_VALIDATE_INT))
  {
     die("invalid agencyid");
  }
  
  /*解决字符编码*/
  $query="set names 'utf8';";
  $mysqli->query($query);
  
  /* 创建卖给位于该地区的hospital的mark情况使用视图 */
  $query="DROP VIEW IF EXISTS `hospital_agency_mark_name`;";
  $mysqli->query($query);
  $query = "create view hospital_agency_mark_name 
  (mark_id,agency_id,agency_name,hospital_id,hospital_name,used_at,status,damaged_at,sold_at) as 
  select i_mark.id,agency_id,i_agency.name,hospital_id,i_hospital.name,used_at,i_mark.status,damaged_at,sold_at 
  from i_mark,i_agency,i_hospital
  where agency_id=i_agency.id and i_hospital.id=hospital_id and i_hospital.province_id=$provinceid and i_hospital.city_id=$cityid;";
  $viewresult = $mysqli->query($query);
   
  /* 创建该地区医院与所有代理商的cross join视图(hospital_cross_agency)  由于视图不能包含子查询，故采用视图嵌套*/
  $query="DROP VIEW IF EXISTS `hospital_region`;";
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
  
  if($agencyid==""){
  //1、多少医生  （含有province_id  city_id）
  $query = "select  distinct  $provinceid as province_id,$cityid as city_id ,maintable.hospital_id, maintable.hospital_name,maintable.agency_name,ifnull(subtable.num,0) as doctornum 
  from hospital_cross_agency as maintable left join
  (select hospital_id,count(id) as num from i_doctor group by hospital_id ) 
   as subtable on maintable.hospital_id=subtable.hospital_id order by hospital_name,agency_name";
  $doctornumresult=$mysqli->query($query);
  
  //2、多少机器
  $query = "select  distinct maintable.hospital_id, maintable.hospital_name,maintable.agency_name,ifnull(subtable.num,0) as robotnum 
  from hospital_cross_agency as maintable left join
  (select hospital_id,agency_id,count(id) as num from i_robot_lease_log group by hospital_id,agency_id ) 
   as subtable on maintable.hospital_id=subtable.hospital_id and maintable.agency_id=subtable.agency_id order by hospital_name,agency_name";
  $robotnumresult=$mysqli->query($query);
  
  //3、购买mark总数  
  $query= "select  distinct maintable.hospital_name,maintable.agency_name,ifnull(subtable.num,0) as buynum 
  from hospital_cross_agency as maintable left join
  (select agency_name,hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where sold_at>='$starttime' and sold_at<='$endtime' group by agency_name,hospital_name ) 
   as subtable on maintable.agency_name=subtable.agency_name and maintable.hospital_name=subtable.hospital_name 
   order by hospital_name,agency_name";
  $buyresult=$mysqli->query($query);
  
  //4、消耗mark总数 (已使用mark)
  $query= "select distinct maintable.hospital_name,maintable.agency_name,ifnull(subtable.num,0) as usenum 
  from hospital_cross_agency as maintable left join
  (select agency_name,hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where used_at>='$starttime' and used_at<='$endtime' and status=2  group by agency_name,hospital_name ) 
   as subtable on maintable.agency_name=subtable.agency_name and maintable.hospital_name=subtable.hospital_name 
   order by hospital_name,agency_name";
  $useresult=$mysqli->query($query);
  
  //5、历史消耗mark  (历史已使用mark)
  $query= "select distinct maintable.hospital_name,maintable.agency_name,ifnull(subtable.num,0) as historyusenum 
  from hospital_cross_agency as maintable left join
  (select agency_name,hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where status=2  group by agency_name,hospital_name ) 
   as subtable on maintable.agency_name=subtable.agency_name and maintable.hospital_name=subtable.hospital_name 
   order by hospital_name,agency_name";
  $historyuseresult=$mysqli->query($query);  
  }
  
  else{
   $query = "select name into @agency_name from i_agency where id=@agencyid;";
   $mysqli->query($query);
   
   //1、多少医生 （含有province_id  city_id）
   $query= "select  $provinceid as province_id,$cityid as city_id,@agency_name as agency_name,maintable.hospital_id,maintable.hospital_name,ifnull(subtable.num,0) as doctornum 
   from  hospital_region as maintable left join
   (select hospital_id,count(id) as num from i_doctor group by hospital_id ) 
   as subtable on maintable.hospital_id=subtable.hospital_id order by hospital_name";
   $doctornumresult=$mysqli->query($query);
   
   //2、多少机器
   $query= "select maintable.hospital_id,maintable.hospital_name,ifnull(subtable.num,0) as robotnum 
   from  hospital_region as maintable left join
   (select hospital_id,count(id) as num from i_robot_lease_log where agency_id=$agencyid group by hospital_id ) 
   as subtable on maintable.hospital_id=subtable.hospital_id order by hospital_name";
   $robotnumresult=$mysqli->query($query);
   
   //3、购买mark总数  
  $query= "select maintable.hospital_name,ifnull(subtable.num,0) as buynum 
   from (select distinct hospital_name from hospital_region ) as maintable left join
   (select hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where sold_at>='$starttime' and sold_at<='$endtime' and agency_id=$agencyid group by hospital_name ) 
   as subtable on maintable.hospital_name=subtable.hospital_name order by hospital_name";
   $buyresult=$mysqli->query($query);
   
   //4、消耗mark总数
   $query= "select maintable.hospital_name,ifnull(subtable.num,0) as usenum 
   from (select distinct hospital_name from hospital_region ) as maintable left join
   (select hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where used_at>='$starttime' and used_at<='$endtime' and status=2 and agency_id=$agencyid group by hospital_name ) 
   as subtable on maintable.hospital_name=subtable.hospital_name order by hospital_name";
   $useresult=$mysqli->query($query);
   
   //5、历史消耗mark
   $query= "select maintable.hospital_name,ifnull(subtable.num,0) as historyusenum 
   from (select distinct hospital_name from hospital_region ) as maintable left join
   (select hospital_name,count(mark_id) as num from hospital_agency_mark_name
   where status=2 and agency_id=$agencyid group by hospital_name ) 
   as subtable on maintable.hospital_name=subtable.hospital_name order by hospital_name";
   $historyuseresult=$mysqli->query($query);
   
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
				<tr style="background: #FFF"><th>省份id </th> <th>城市id </th> <th>医院名称 </th><th>代理商 </th><th>医生数量 </th><th>机器数量 </th><th>购买Mark总数 </th><th>消耗Mark总数 </th><th>历史消耗Mark总数 </th></tr>
			</thead>
			<tbody>  ';
		
  $num=0; //初始化为0
  $i=0;
  $name1 = "0";
   while( $doctorrow = $doctornumresult->fetch_array()
	    and $robotrow = $robotnumresult->fetch_array()
	    and $buyrow = $buyresult->fetch_array()
		and $userow = $useresult->fetch_array()  
		and $historyuserow = $historyuseresult->fetch_array()
		)	
	{//$s代表show
	  $sprovinceid = $doctorrow['province_id'];
	  $scityid = $doctorrow['city_id'];
      $shospitalname = $doctorrow['hospital_name'];
	  $sagencyname = $doctorrow['agency_name'];
	  $sdoctornum[$num] = $doctorrow['doctornum'];
	  $srobotnum[$num] = $robotrow['robotnum'];	 
	  $sbuynum[$num] = $buyrow['buynum'];
	  $susenum[$num] = $userow['usenum'];
	  $shistoryusenum[$num] = $historyuserow['historyusenum'];
	  
	  if($name1===$shospitalname) $sdoctornum[$num] = 0;
	  $name1 = $shospitalname;
	//按行显示至表格
	  echo "<tr><td>$sprovinceid </td><td>$scityid </td><td> $shospitalname</td>
	       <td>$sagencyname</td> <td>$sdoctornum[$num]</td> <td>$srobotnum[$num]</td> <td>$sbuynum[$num]</td>
		   <td>$susenum[$num] </td>  <td>$shistoryusenum[$num] </td>
	  </tr>";
	  $num++;
	}
	
		$tsdoctornum=0;
		$tsrobotnum=0;
		$tsbuynum=0;
		$tsusenum=0;
		$tshistoryusenum=0;

	for($i=0;$i<$num;$i++)
	{
	   //算出各num总数,变量名前加ts，t代表total  s代表show
	   $tsdoctornum += $sdoctornum[$i];
	   $tsrobotnum += $srobotnum[$i];
	   $tsbuynum += $sbuynum[$i];
	   $tsusenum += $susenum[$i];
	   $tshistoryusenum += $shistoryusenum[$i];
	}
	
		//将总数显示出来
		echo "<tr><td>总数 </td><td style='border-right-width:0'> </td><td style='border-right-width:0;border-left-width:0;'> </td>
		   <td style='border-left-width:0'> </td>
		   <td> $tsdoctornum </td>
	       <td>$tsrobotnum </td> <td>$tsbuynum </td> <td>$tsusenum </td> <td>$tshistoryusenum </td>
	  </tr>";	
	echo '</tbody>
		  </table> 
		</body>
		</html>';
  
  $mysqli->close();
?>