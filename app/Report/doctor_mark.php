<?php
  /*厂商 医生Mark使用情况表 */
  //$mysqli = new mysqli('118.244.197.36','root','HWVosvmGYP6knCjp6Ihx','robot');
  /* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
 
  $hospitalid=$_POST['hospitalid'];
  $provinceid=$_POST['provinceid'];
  $cityid=$_POST['cityid'];
  $starttime=$_POST['starttime'];
  $endtime=$_POST['endtime'];
  $agencyid=$_POST['agencyid'];
 /*	
  $hospitalid=29; 
  $provinceid=29;
  $cityid=6;
  $starttime="2015-07-01 00:00:00";
  $endtime="2015-09-01 00:00:00";
  $agencyid=905;
*/
  if(! filter_var($starttime, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/s"))))
  {
     die("invalid starttime");
  }
  
  if(! filter_var($endtime, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/s"))))
  {
     die("invalid endtime");
  }
  if(! filter_var($hospitalid, FILTER_VALIDATE_INT))
  {
     die("invalid hospitalid");
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
  $query="set names 'utf8'";
  $setcode = $mysqli->query($query);
  
  /* 医生姓名表 */
  $query="DROP VIEW IF EXISTS `doctor_name`;";
  $mysqli->query($query); 
  $query="create view doctor_name (hospital_id,hospital_name,doctor_id,doctor_name) as 
  select i_hospital.id,i_hospital.name,i_doctor.id,i_doctor.name from i_hospital,i_doctor
  where province_id=$provinceid and city_id= $cityid and i_hospital.id=$hospitalid and i_hospital.id=i_doctor.hospital_id 
  order by i_doctor.name ;";  
  $viewresult = $mysqli->query($query);
  
  /* 当未选择代理商时，医生姓名与代理商 cross join后的视图 */
  $query="DROP VIEW IF EXISTS `doctor_cross_agency`;";
  $mysqli->query($query);
  $query = "create view doctor_cross_agency 
  (doctor_id,doctor_name,hospital_id,hospital_name,agency_id,agency_name) as 
  select doctor_id,doctor_name,hospital_id,hospital_name,id,name from 
  doctor_name cross join i_agency order by doctor_name,name;";
  $viewresult = $mysqli->query($query);
  
  //查找已经被医生用过的mark信息  
  $query="DROP VIEW IF EXISTS `doctor_agency_mark`;";
  $mysqli->query($query);
  $query = "create view doctor_agency_mark 
  (mark_id,hospital_name,agency_name,doctor_name,agency_id,hospital_id,archive_at) as 
  select i_mark.id,i_hospital.name,i_agency.name,i_doctor.name,agency_id,i_doctor.hospital_id,archive_at 
  from i_mark,i_agency,i_doctor,i_hospital
  where i_mark.agency_id=i_agency.id and i_mark.doctor_id=i_doctor.id
  and i_mark.hospital_id=i_hospital.id
  and i_mark.hospital_id=$hospitalid and i_hospital.province_id=$provinceid and i_hospital.city_id=$cityid";
  $viewresult = $mysqli->query($query);	
  
   if($agencyid==""){	   
       /* 不选定代理商 */
	   //1.已归档
       $query = "select distinct maintable.hospital_name,maintable.doctor_name,maintable.agency_name,ifnull(subtable.num,0) as archivenum 
		  from doctor_cross_agency as maintable left join
		  (select doctor_name,agency_name,count(mark_id) as num from doctor_agency_mark
		   where archive_at>='$starttime' and archive_at<='$endtime' group by agency_name,doctor_name ) 
		   as subtable on maintable.agency_name=subtable.agency_name and maintable.doctor_name=subtable.doctor_name 
		   order by doctor_name,agency_name";
		  $archiveresult=$mysqli->query($query);
  
       //2.未归档
     $query = "select distinct maintable.hospital_name,maintable.doctor_name,maintable.agency_name,ifnull(subtable.num,0) as unarchivenum 
		  from doctor_cross_agency as maintable left join
		  (select doctor_name,agency_name,count(mark_id) as num from doctor_agency_mark
		   where archive_at<=>null group by agency_name,doctor_name ) 
		   as subtable on maintable.agency_name=subtable.agency_name and maintable.doctor_name=subtable.doctor_name 
		   order by doctor_name,agency_name";
		  $unarchiveresult=$mysqli->query($query);
	   //3.查询历史归档数 不受任何限制（暂且理解为受代理商限制，但不受时间限制）
	   $query = "select distinct maintable.hospital_name,maintable.doctor_name,maintable.agency_name,ifnull(subtable.num,0) as historyarchivenum 
		  from doctor_cross_agency as maintable left join
		  (select doctor_name,agency_name,count(mark_id) as num from doctor_agency_mark
		   where archive_at is not null group by agency_name,doctor_name ) 
		   as subtable on maintable.agency_name=subtable.agency_name and maintable.doctor_name=subtable.doctor_name 
		   order by doctor_name,agency_name";
		  $historyarchiveresult=$mysqli->query($query);   
	 
   }
   else{
       //给定了agencyid
      $query = "select name into @agency_name from i_agency where id=$agencyid;";
      $mysqli->query($query);
	   
	   //1. 
	  $query= "select distinct maintable.hospital_name,maintable.doctor_name,@agency_name as agency_name,ifnull(subtable.num,0) as archivenum 
		  from doctor_name as maintable left join
		  (select doctor_name,count(mark_id) as num from doctor_agency_mark
		   where archive_at>='$starttime' and archive_at<='$endtime' and agency_id=$agencyid group by doctor_name ) 
		   as subtable on maintable.doctor_name=subtable.doctor_name 
		   order by doctor_name";
	  $archiveresult=$mysqli->query($query);
   
     //2. 
  $query= "select distinct maintable.hospital_name,maintable.doctor_name,@agency_name as agency_name,ifnull(subtable.num,0) as unarchivenum 
		  from doctor_name as maintable left join
		  (select doctor_name,count(mark_id) as num from doctor_agency_mark
		   where archive_at<=>null and agency_id=$agencyid group by doctor_name ) 
		   as subtable on maintable.doctor_name=subtable.doctor_name 
		   order by doctor_name";
	  $unarchiveresult=$mysqli->query($query);	 
	 //3. 
       $query= "select distinct maintable.hospital_name,maintable.doctor_name,@agency_name as agency_name,ifnull(subtable.num,0) as historyarchivenum 
		  from doctor_name as maintable left join
		  (select doctor_name,count(mark_id) as num from doctor_agency_mark
		   where archive_at is not null and agency_id=$agencyid group by doctor_name ) 
		   as subtable on maintable.doctor_name=subtable.doctor_name 
		   order by doctor_name";
	  $historyarchiveresult=$mysqli->query($query);
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
			<caption style="font-family:Arial, Helvetica;text-align:left;font-size:30px;text-align:center">医生mark使用情况表</caption>
			<thead>
			  <tr style="background: #FFF"><th>医院 </th><th>医生姓名 </th><th>代理商 </th><th>已归档 </th><th>未归档 </th><th> 历史归档数</th></tr>
			</thead>
			<tbody>  ';
			
			
  $num=0; // 
  $i=0;

  while($archiverow = $archiveresult->fetch_array()
		and $unarchiverow = $unarchiveresult->fetch_array()  
		and $historyarchiverow = $historyarchiveresult->fetch_array()
		)
		
	{//$s show	  
	  $shospitalname = $archiverow['hospital_name'];
	  $sdoctorname = $archiverow['doctor_name'];
	  $sagencyname = $archiverow['agency_name'];
	  $sarchivenum[$num] = $archiverow['archivenum'];
	  $sunarchivenum[$num] = $unarchiverow['unarchivenum'];
	  $shistoryarchivenum[$num] = $historyarchiverow['historyarchivenum'];

	// 
	  echo "<tr><td>$shospitalname </td><td>$sdoctorname </td><td>$sagencyname </td><td> $sarchivenum[$num]</td>
	       <td>$sunarchivenum[$num]</td> <td>$shistoryarchivenum[$num]</td> </tr>";
	  $num++;
	}
	
		$tsarchivenum=0;
		$tsunarchivenum=0;
		$tshistoryarchivenum=0;


	for($i=0;$i<$num;$i++)
	{
	    
	    $tsarchivenum=$sarchivenum[$i];
		$tsunarchivenum=$sunarchivenum[$i];
		$tshistoryarchivenum=$shistoryarchivenum[$i];
	}
	
		 
		echo "<tr><td>总数 </td><td style='border-right-width:0'> </td><td style='border-left-width:0'> </td><td> $tsarchivenum </td>
	       <td>$tsunarchivenum </td> <td>$tshistoryarchivenum </td> </tr>";
		
		
	echo '</tbody>
		  </table> 
		</body>
		</html>';   
   
   
   
   $mysqli->close();
?>