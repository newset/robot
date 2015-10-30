<?php
/*代理商  Mark统计表 */
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
  $agencyid=$_POST['agencyid'];

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
  
  $query="DROP VIEW IF EXISTS `agency__mark`;";
  $mysqli->query($query);

   $query = "create view agency__mark as 
  select id,sold,sold_at,shipped_at,damaged_at,used_at,archive_at,status,hospital_id from i_mark
  where agency_id=$agencyid;";
  $viewresult = $mysqli->query($query);
  
   /*库存总数 */
   $query="select count(id) as stocknum from agency__mark where status=1 and hospital_id=-1;";
   $stockresult = $mysqli->query($query);
   
   /*已销售 有时间限制*/
   $query = "select count(id) as soldnum from agency__mark where sold_at>='$starttime' and sold_at<='$endtime';";
   $soldresult = $mysqli->query($query);
   
   /*进货量 */ 
   $query="select count(id) as purchasenum from agency__mark where shipped_at>='$starttime' and shipped_at<='$endtime';";
   $purchaseresult = $mysqli->query($query);
   
   /*已使用 */
   $query="select count(id) as usenum from agency__mark where  used_at>='$starttime' and used_at<='$endtime';";
   $useresult = $mysqli->query($query);
   
   /*已归档 */
   $query="select count(id) as archivenum from agency__mark where  archive_at>='$starttime' and archive_at<='$endtime';";
   $archiveresult = $mysqli->query($query);
   
   /*已损坏 */
   $query="select count(id) as badnum from agency__mark where  status=3 and damaged_at>='$starttime' and damaged_at<='$endtime';";
   $badresult = $mysqli->query($query);

   /*损坏已更换 */
   $query="select count(id) as updatenum from agency__mark where  status=4 and damaged_at>='$starttime' and damaged_at<='$endtime';";
   $updateresult = $mysqli->query($query);
  
   
    echo '<!DOCTYPE html>
		<html>
		<head>
		 <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		  <style type="text/css" >
			  @media print
				  {
					 #show{
					   width:100%;
					   margin:0;
					   padding:0	 
					 }
				  }
		  </style>
		  <style type="text/css" media="all">
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
			<caption style="font-family:Arial, Helvetica;text-align:left;color: rgb(177, 106, 104);">代理商mark情况统计表</caption>
			<thead>
				<tr style="background: #FFF"><th>库存总数 </th><th>已销售 </th><th>进货量 </th><th>已使用 </th><th>已归档 </th><th>已损坏 </th><th>损坏已更换 </th></tr>
			</thead>
			<tbody>  ';
			
  
  while($stockrow = $stockresult->fetch_array()
		and $soldrow = $soldresult->fetch_array()  
		and $purchaserow = $purchaseresult->fetch_array()
		and $userow = $useresult->fetch_array()
		and $archiverow = $archiveresult->fetch_array()		
		and $badrow = $badresult->fetch_array()
		and $updaterow = $updateresult->fetch_array()
		)
		
	{//$s代表show
	  $sstocknum = $stockrow['stocknum'];
	  $ssoldnum = $soldrow['soldnum'];	  
	  $susenum = $userow['usenum'];
	  $spurchasenum = $purchaserow['purchasenum'];	    
	  $sarchivenum = $archiverow['archivenum'];	  
	  $sbadnum = $badrow['badnum'];
	  $supdatenum = $updaterow['updatenum'];
	  
	//按行显示至表格
	  echo "<tr><td> $sstocknum </td><td> $ssoldnum </td> <td>$spurchasenum</td><td> $susenum </td>
	       <td> $sarchivenum</td> <td>$sbadnum </td> <td>$supdatenum</td> </tr>";
	}

	echo '</tbody>
		  </table> 
		</body>
		</html>';
  
  $mysqli->close();
?>