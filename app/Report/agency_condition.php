<?php
  /* 代理情况表 */
  //header("Content-Type:text/html;charset=utf-8");
  $mysqli = new mysqli('118.244.197.36','root','HWVosvmGYP6knCjp6Ihx','robot');
  
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
  $provinceid=$_POST['provinceid'];
  $cityid=$_POST['cityid'];
 /*
  $provinceid=26;
  $cityid=2;
  $starttime="2015-07-01 00:00:00";
  $endtime="2015-09-01 00:00:00";
*/
  if(! filter_var($starttime, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/s")))) {
     die("invalid starttime");
  } 
  if(! filter_var($endtime, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/s")))) {
     die("invalid endtime");
  }
  if(! filter_var($provinceid, FILTER_VALIDATE_INT)) {
     die("invalid provinceid");
  } 
  if(! filter_var($cityid, FILTER_VALIDATE_INT)) {
     die("invalid cityid");
  }

  $query="DROP VIEW IF EXISTS `agency_condition`;";
  $mysqli->query($query);
  $query = "create view agency_condition as select id,name,name_in_charge,phone
            from i_agency
	        where city_id=$cityid and province_id=$provinceid 
			order by name;";
  $viewresult = $mysqli->query($query);
  
  /* 代理商 地区 联系人 电话 机器总数*/
  $query = "select maintable.id,maintable.name,maintable.name_in_charge,maintable.phone,ifnull(subtable.num,0) as robotbuynum 
           from agency_condition as maintable left join 
		   (select agency_id,count(distinct id) as num from i_robot_lease_log where lease_started_at>='$starttime' and lease_ended_at<='$endtime' group by agency_id) as subtable 
            on maintable.id=subtable.agency_id
			order by name;";
  $robotbuyresult=$mysqli->query($query);
  /* Mark购买总数 */
  $query = "select maintable.name,ifnull(subtable.num,0) as markbuynum from agency_condition as maintable left join 
            (select agency_id,count(id) as num from i_mark where shipped_at>='$starttime' and shipped_at<='$endtime' group by agency_id ) as subtable
            on maintable.id=subtable.agency_id order by name;";
  $markbuyresult=$mysqli->query($query);
  /* 历史消耗Mark */
  $query = " select maintable.name,ifnull(subtable.num,0) as historyusenum from agency_condition as maintable left join 
            (select agency_id,count(id) as num from i_mark where status=2 group by agency_id ) as subtable
            on maintable.id=subtable.agency_id order by name ;";
  $historyuseresult=$mysqli->query($query);
  /* 消耗Mark */
  $query = " select maintable.name,ifnull(subtable.num,0) as usenum from agency_condition as maintable left join 
            (select agency_id,count(id) as num from i_mark where used_at>='$starttime' and used_at<='$endtime' group by agency_id ) as subtable
            on maintable.id=subtable.agency_id order by name ;";
  $useresult=$mysqli->query($query);
  
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
			<caption style="font-family:Arial, Helvetica;text-align:left;font-size:30px;text-align:center">代理情况表</caption>
			<thead>
				<tr ><th>代理商</th><th>省份id </th><th>城市id </th><th>联系人 </th><th>电话</th><th>机器总数 </th><th>医院总数 </th><th>Mark购买总数 </th>
				<th>历史消耗Mark </th><th>消耗Mark </th> </tr>
			</thead>
			<tbody>  ';
  
    $num=0;
	while($robotbuyrow = $robotbuyresult->fetch_array()
			and $markbuyrow = $markbuyresult->fetch_array()
			and $historyuserow = $historyuseresult->fetch_array()
			and $userow = $useresult->fetch_array() ) 
	{
	   //$s代表show
	   $agencyid = $robotbuyrow['id'];
	   $sagencyname = $robotbuyrow['name'];
	   $snameincharge = $robotbuyrow['name_in_charge'];
	   $sphone = $robotbuyrow['phone'];
	   $srobotbuynum[$num] = $robotbuyrow['robotbuynum'];
	   
	   //医院必须是该地区（郭老师的建议）
	   //mark 
	   $query = "select distinct hospital_id from i_mark,i_hospital  
	            where i_hospital.id=hospital_id and agency_id=$agencyid and city_id=$cityid and province_id=$provinceid;";
	   $markresult=$mysqli->query($query);
	   //robot
	   $query = "select distinct hospital_id from i_robot_lease_log,i_hospital  
	            where i_hospital.id=hospital_id and agency_id=$agencyid and city_id=$cityid and province_id=$provinceid;";
	   $robotresult=$mysqli->query($query);
	   $hnum[$num]=0; //用来统计医院数目
	   while($markrow=$markresult->fetch_array())
	   {
	      $hospital[$hnum[$num]]=$markrow['hospital_id'];
		  $hnum[$num]++;
	   }
	   while($robotrow=$robotresult->fetch_array())
	   {
	     if(in_array($robotrow['hospital_id'],$hospital)) continue;
		 else {$hospital[$hnum[$num]]=$robotrow['hospital_id'];$hnum[$num]++;}
	   }
	   //得出$hnum 为医院数目
	   $smarkbuynum[$num] = $markbuyrow['markbuynum'];
	   $shistoryusenum[$num] = $historyuserow['historyusenum'];
	   $susenum[$num] = $userow['usenum'];
	   
	   //按行显示至表格
	   echo "<tr><td>$sagencyname</td><td> $provinceid </td><td> $cityid </td> <td>$snameincharge </td><td> $sphone</td>
	       <td>$srobotbuynum[$num]</td> <td>$hnum[$num]</td> <td>$smarkbuynum[$num]</td> 
		   <td> $shistoryusenum[$num]</td>  <td>$susenum[$num] </td>  </tr>";
	   $num++;
	}
	
	    $tsrobotbuynum=0;
		$thnum=0;
		$tsmarkbuynum=0;
        $tshistoryusenum=0;
        $tsusenum=0;		
		
    //统计总数
	for($i=0;$i<$num;$i++) {
	    $tsrobotbuynum+=$srobotbuynum[$i];
		$thnum+=$hnum[$i];
		$tsmarkbuynum+=$smarkbuynum[$i];
        $tshistoryusenum+=$shistoryusenum[$i];
        $tsusenum+=$susenum[$i];	
	}
  
  //将总数显示出来
   echo "<tr><td>总数 </td><td style='border-right-width:0'> </td><td style='border-left-width:0;border-right-width:0'> </td>
		<td style='border-left-width:0;border-right-width:0'> </td><td style='border-left-width:0'> </td><td> $tsrobotbuynum </td>
	       <td>$thnum </td> <td>$tsmarkbuynum </td> <td> $tshistoryusenum </td> <td>$tsusenum </td>
	  </tr>";
  
  echo '</tbody>
		  </table> 
		</body>
		</html>';
  
  $mysqli->close();
?>