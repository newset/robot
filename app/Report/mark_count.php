<?php
   /* 厂商 Mark情况统计表 */
//  header("Content-Type:text/html;charset=utf-8");
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
 /*
  $starttime="2015-07-01 00:00:00";
  $endtime="2015-09-01 00:00:00";
  */
  if(! filter_var($starttime, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/s"))))
  {
     die("invalid starttime");
  }
  
  if(! filter_var($endtime, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/s"))))
  {
     die("invalid endtime");
  }
  
  /* 已生产	*/
  $query ="select count(id) as num from i_mark where created_at>='$starttime' and created_at<='$endtime';";
  $produceresult=$mysqli->query($query);
  $produceresultarray= $produceresult->fetch_array();
  $result1 = $produceresultarray['num'];
 
  /*已销售 */ 
  $query ="select count(id) from i_mark where sold_at>=? and sold_at<=?";
  $stmt2 = $mysqli->stmt_init();     
  $stmt2->prepare($query); 
  $stmt2->bind_param('ss',$starttime ,$endtime);
  $stmt2->execute();
  $stmt2->bind_result($result2);
  $stmt2->fetch();
  $stmt2->close();
   
  /*已损坏 */
  $query ="select count(id) from i_mark where damaged_at>=? and damaged_at<=? and status=3";
  $stmt3 = $mysqli->stmt_init();     
  $stmt3->prepare($query); 
  $stmt3->bind_param('ss',$starttime ,$endtime);
  $stmt3->execute();
  $stmt3->bind_result($result3);
  $stmt3->fetch();
  $stmt3->close();
  
  /*损坏已更新 */  
  $query ="select count(id) from i_mark where damaged_at>=? and damaged_at<=? and status=4";
  $stmt4 = $mysqli->stmt_init();     
  $stmt4->prepare($query); 
  $stmt4->bind_param('ss',$starttime ,$endtime);
  $stmt4->execute();
  $stmt4->bind_result($result4);
  $stmt4->fetch();
  $stmt4->close();
 
  /*库存总数 */ 
  $query ="select count(id) as num from i_mark where status=1 and agency_id=-1 and hospital_id=-1"; 
  $stockresult=$mysqli->query($query);
  $stockresultarray= $stockresult->fetch_array();
  $result5 = $stockresultarray['num'];

  /*已绑定 */ 
  $query ="select count(id) from i_mark where used_at>=? and used_at<=? and ifnull(doctor_id,-1)!=-1 ";
  $stmt6 = $mysqli->stmt_init();     
  $stmt6->prepare($query); 
  $stmt6->bind_param('ss',$starttime ,$endtime);
  $stmt6->execute();
  $stmt6->bind_result($result6);
  $stmt6->fetch();
  $stmt6->close();

	echo "<!DOCTYPE html>
			<html>
			<head>
			 <meta http-equiv='Content-Type' content='text/html;charset=utf-8' />
			  <style type='text/css'>
				@media print
				  {
					 #show{
					   width:100%; 
					   margin:0;
				       padding:0	 
					 }
				  } 
				  
				  caption {  
					padding: 0 0 5px 0;  
					font: italic 20px 'trebuchet ms', verdana, arial, helvetica, sans-serif;  
					text-align: right;  
				    }  
				  
				  td
				  {
				    text-align:center;
				  }
			  
				        #show thead, #show tr {
						border-top-width: 1px;
						border-top-style: solid;
						border-top-color: #c1dad7;
						}
						#show {
						border:1px solid #c1dad7;
						}

						/* Padding and font style */
						#show td, #show th {
						padding: 5px 10px;
						font-size: 12px;
						font-family: Verdana;					
						}

						/* Alternating background colors */
						#show tr:nth-child(odd) {
						background: #f5fafa;
						color:#4f6b72;
						}
						#show tr:nth-child(even) {
						background: #FFF;
						color:#4f6b72;
						}
			  </style>
			</head>
			<body>
			  <table id='show'>
				<caption style='font-family:Arial, Helvetica;text-align:left;color:#4f6b72'>Mark情况统计表</caption>
				<thead>
					<tr style='background: #FFF' ><th>已生产 </th><th>已销售 </th><th>已损坏 </th><th>损坏已更新 </th><th>库存总数 </th><th>已绑定 </th></tr>
				</thead>
				<tbody>  
				    <tr><td>$result1 </td><td>$result2 </td><td>$result3</td><td>$result4</td> <td>$result5</td> <td>$result6</td> </tr>
	  	        </tbody>
		      </table> 
		</body>
		</html>";
  $mysqli->close();
?>