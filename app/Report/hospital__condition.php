<?php
  /* 代理商 医院情况表*/
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
  
  $agencyid=$_POST['agencyid'];
  //$agencyid=905;
  
  if(! filter_var($agencyid, FILTER_VALIDATE_INT))
  {
     die("invalid agencyid");
  }
  
  /* 创建i_mark 中关于特定代理商的视图 */
  $query="DROP VIEW IF EXISTS `hospital__condition`;";
  $mysqli->query($query);
  $query = "create view hospital__condition as 
  select id,hospital_id,sold,sold_at,damaged_at,used_at,archive_at,status from i_mark
  where agency_id=$agencyid;";
  $viewresult = $mysqli->query($query);
   
  /* 医院库存  不受代理商限制？ (status=1或4  未使用 损坏更新)*/
  $query = "select maintable.name,ifnull(subtable.num,0) as savenum 
  from (select distinct name,id from i_hospital order by name) as maintable left join
  (select hospital_id,count(id) as num from i_mark where status=1 or status=4 group by hospital_id ) 
   as subtable on maintable.id=subtable.hospital_id order by name;";
  $saveresult = $mysqli->query($query);
  
  /* 医院购买  受代理商限制 不受时间限制？*/
  $query = "select ifnull(subtable.num,0) as buynum 
  from (select distinct name,id from i_hospital order by name) as maintable left join
  (select hospital_id,count(id) as num from hospital__condition group by hospital_id ) 
   as subtable on maintable.id=subtable.hospital_id order by name;";
  $buyresult = $mysqli->query($query);  

 
  /* 医院使用 status=2 正常使用完毕*/
  $query = "select ifnull(subtable.num,0) as usenum 
  from (select distinct name,id from i_hospital order by name) as maintable left join
  (select hospital_id,count(id) as num from hospital__condition where status=2 group by hospital_id ) 
   as subtable on maintable.id=subtable.hospital_id order by name;";
  $useresult = $mysqli->query($query);  
  
  /* 已损坏 */
  $query = "select ifnull(subtable.num,0) as badnum 
  from (select distinct name,id from i_hospital order by name) as maintable left join
  (select hospital_id,count(id) as num from hospital__condition where status=3 group by hospital_id ) 
   as subtable on maintable.id=subtable.hospital_id order by name;";
  $badresult = $mysqli->query($query);  
  
  
  /* 损坏已更新 */
  $query = "select ifnull(subtable.num,0) as updatenum 
  from (select distinct name,id from i_hospital order by name) as maintable left join
  (select hospital_id,count(id) as num from hospital__condition where status=4 group by hospital_id ) 
   as subtable on maintable.id=subtable.hospital_id order by name;";
  $updateresult = $mysqli->query($query);    
  

  echo '<!DOCTYPE html>
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
			  }
			    td
				  {
				    text-align:center;
				  }
			  
				        #show thead, #show tr {
						border-top-width: 1px;
						border-top-style: solid;
						border-top-color: rgb(230, 189, 189);
						}
						#show {
						border:1px solid rgb(230, 189, 189);
						}

						/* Padding and font style */
						#show td, #show th {
						padding: 5px 10px;
						font-size: 12px;
						font-family: Verdana;
						color: rgb(177, 106, 104);
						}

						/* Alternating background colors */
						#show tr:nth-child(odd) {
						background: rgb(238, 211, 210)
						}
						#show tr:nth-child(even) {
						background: #FFF
						}
		  </style>
		</head>
		<body>

		  <table id="show"  >
			<caption style="font-family:Arial, Helvetica;text-align:left;color: rgb(177, 106, 104);">医院情况表</caption>
			<thead>
				<tr style="background: #FFF"><th>医院名称 </th><th>医院库存 </th><th>医院购买 </th><th>医院使用 </th><th>已损坏 </th><th>损坏已更新 </th></tr>
			</thead>
			<tbody>  ';
	
  $num=0; //初始化为0
  $i=0;
  
  while($saverow = $saveresult->fetch_array()
		and $buyrow = $buyresult->fetch_array()  
		and $userow = $useresult->fetch_array()
		and $badrow = $badresult->fetch_array()
		and $updaterow = $updateresult->fetch_array()
		)
		
	{//$s代表show
	  $shospitalname = $saverow['name'];
	  $ssavenum[$num] = $saverow['savenum'];
	  $sbuynum[$num] = $buyrow['buynum'];
	  $susenum[$num] = $userow['usenum'];
	  $sbadnum[$num] = $badrow['badnum'];
	  $supdatenum[$num] = $updaterow['updatenum'];
	//按行显示至表格
	  echo "<tr><td>$shospitalname </td><td>$ssavenum[$num] </td><td> $sbuynum[$num]</td>
	      <td>$susenum[$num]</td> <td>$sbadnum[$num]</td> <td>$supdatenum[$num]</td>
	  </tr>";
	  $num++;
	}
	    $tssavenum=0;
		$tsbuynum=0;
		$tsusenum=0;
		$tsbadnum=0;
		$tsupdatenum=0;

	for($i=0;$i<$num;$i++)
	{
	   //算出各num总数,变量名前加ts，t代表total  s代表show
	   $tssavenum += $ssavenum[$i];
	   $tsbuynum += $sbuynum[$i];
	   $tsusenum += $susenum[$i];
	   $tsbadnum += $sbadnum[$i];
	   $tsupdatenum += $supdatenum[$i];
	}
	
		//将总数显示出来
		echo "<tr><td>总数 </td>
	       <td>$tssavenum </td><td> $tsbuynum </td> <td>$tsusenum </td> <td>$tsbadnum </td> <td>$tsupdatenum </td>
	  </tr>";
		
		
	echo '</tbody>
		  </table> 
		</body>
		</html>';

  $mysqli->close();
?>