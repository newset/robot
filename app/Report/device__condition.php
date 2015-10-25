<?php
  /* 代理商 设备统计表 */
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
  
  $starttime=$_POST['starttime'];
  $endtime=$_POST['endtime'];
  $agencyid=$_POST['agencyid'];
 /*
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
  if(! filter_var($agencyid, FILTER_VALIDATE_INT))
  {
     die("invalid agencyid");
  }  
   $query = "select name into @agencyname from i_agency where id=$agencyid;";
   $mysqli->query($query);
	  
  $query="DROP VIEW IF EXISTS `device__condition`;";
  $mysqli->query($query);
  //该时间应该是一个时间段，租赁时间在这之内都应该包含
  $query = "create view device__condition as select robot_id,i_robot.status,name as hospital_name,province_id,city_id,lease_type_id,lease_started_at,lease_ended_at
            from i_robot_lease_log,i_hospital,i_robot
	        where agency_id=$agencyid and 
			(lease_started_at>='$starttime' and lease_started_at<='$endtime' or
			 lease_ended_at>='$starttime' and lease_ended_at<='$endtime' or
			 lease_started_at<='$starttime' and lease_ended_at>='$endtime' )
			and hospital_id=i_hospital.id and i_robot.id=robot_id
			order by robot_id,hospital_name;";
  $viewresult = $mysqli->query($query);

  /* 手术总数 */
  /* 历史总数 */
   $query=" select distinct maintable.robot_id,maintable.province_id,maintable.city_id,
              @agencyname as agency_name,maintable.hospital_name,
          maintable.lease_started_at,maintable.lease_ended_at,ifnull(subtable.num,0) as hissurgerynum 
		  from device__condition as maintable left join
		  (select robot_id,count(distinct ddid_usb) as num from i_mark group by robot_id ) 
		   as subtable on maintable.robot_id=subtable.robot_id 
		   order by robot_id,hospital_name ;";
   $hissurgeryresult=$mysqli->query($query);
  /* 维修次数 */
   
  /* 销售状态 lease_type_id*/
   $query="select lease_type_id from device__condition;";
   $salestatusresult=$mysqli->query($query);
  /* 工作状态 */
   $query="select status from device__condition;";
   $workstatusresult=$mysqli->query($query);
  /* 租赁开始时间 */
   $query="select lease_started_at from device__condition;";
   $leasestartresult=$mysqli->query($query);
  /* 租赁结束时间 */
   $query="select lease_ended_at from device__condition;";
   $leaseendresult=$mysqli->query($query);
  
  
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
			<caption style="font-family:Arial, Helvetica;text-align:left;font-size:30px;text-align:center">代理商设备统计表</caption>
			<thead>
				<tr ><th>设备编号</th><th>省份id </th><th>城市id </th><th>代理商 </th><th>医院 </th><th>手术总数 </th><th>历史总数 </th><th>维修次数 </th>
				<th>销售状态 </th><th>租赁到期时间 </th><th>租赁开始时间 </th></tr>
			</thead>
			<tbody>  ';		
  $num=0; //初始化为0
  $temp=0;
  $i=0;
  
  while($hissurgeryrow = $hissurgeryresult->fetch_array()
		and $salestatusrow = $salestatusresult->fetch_array()
		and $leasestartrow = $leasestartresult->fetch_array()
		and $leaseendrow = $leaseendresult->fetch_array() 
		)		
	{//$s代表show
	  $srobotid = $hissurgeryrow['robot_id'];
	  $sprovinceid = $hissurgeryrow['province_id'];
	  $scityid = $hissurgeryrow['city_id'];
	  $sagencyname = $hissurgeryrow['agency_name'];
	  $shospitalname = $hissurgeryrow['hospital_name'];
	  $shissurgerynum[$num] = $hissurgeryrow['hissurgerynum'];
	  $ssalestatus = $salestatusrow['lease_type_id'];
      $sleasestart = $leasestartrow['lease_started_at'];
	  $sleaseend = $leaseendrow['lease_ended_at'];
	  
	  //计算手术总数、维修次数
	  /* 手术总数 */
	  $query= "select count(distinct ddid_usb) as num from i_mark
		where used_at>='$sleasestart' and used_at<='$sleaseend' and robot_id=$srobotid )";
      $surgeryresult=$mysqli->query($query);
	  $surgeryrow = $surgeryresult->fetch_array();
	  $ssurgerynum[$num] = $surgeryrow['num'];
	  
	  /* 维修次数 */
	  $query= "select count(id) as num from i_robot_log
		where created_at>='$sleasestart' and created_at<='$sleaseend' and robot_id=$srobotid and action_type_id=2)";
      $fixresult=$mysqli->query($query);
	  $fixrow = $fixresult->fetch_array();
	  $sfixnum[$num] = $fixrow['num'];
	   	  
	  $robotid[$num]=$srobotid;
	 //按行显示至表格
	  echo "<tr><td>$srobotid</td><td> $sprovinceid </td><td> $scityid </td> <td>$sagencyname </td><td> $shospitalname</td>
	       <td>$ssurgerynum[$num]</td> <td>$shissurgerynum[$num]</td> <td>$sfixnum[$num]</td> 
		   <td> $ssalestatus </td>  <td>$sleaseend </td>  <td>$sleasestart </td>
	  </tr>";
	  $num++;
	}
	    $tssurgerynum=0;
		$tshissurgerynum=0;
		$tsfixnum=0;	
		
    //统计历史总数要注意去除重复值,通过额外的$robotid[$num]来判断
	for($i=0;$i<$num;$i++)
	{
	   //算出各num总数,变量名前加ts，t代表total  s代表show
		$tssurgerynum+=$ssurgerynum[$i];
		if($i>0) {
		   if($robotid[$i]===$robotid[$i-1])
		    $tshissurgerynum+=0;
		   else
		    $tshissurgerynum+=$shissurgerynum[$i];
		}
		else
		   $tshissurgerynum+=$shissurgerynum[$i];
		$tsfixnum+=$sfixnum[$i];	
	}	
		//将总数显示出来
		echo "<tr><td>总数 </td><td style='border-right-width:0'> </td><td style='border-left-width:0;border-right-width:0'> </td>
		<td style='border-left-width:0;border-right-width:0'> </td><td style='border-left-width:0'> </td><td> $tssurgerynum </td>
	       <td>$tshissurgerynum </td> <td>$tsfixnum </td> <td style='border-right-width:0'> </td>
		   <td style='border-left-width:0;border-right-width:0'> </td> <td style='border-left-width:0'> </td>
	  </tr>";
	
	echo '</tbody>
		  </table> 
		</body>
		</html>';
  $mysqli->close();
  

?>