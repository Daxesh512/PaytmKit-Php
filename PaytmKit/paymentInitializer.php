<?php
/*
Paytm Payments Gateway : Version 1.0
Hook Status : Integrated
Third party services : False
RDB : Auth based injection
Data Storage : SQL : Payments Table
Redirection : Dashboard Page : echo-dashboard.php

*/

//Session Check
session_start();

if(!isset($_SESSION["mail"])){
    header("location: https://www.xyberneo.com/demo_9J21");
    exit();
}

$email = $_SESSION["mail"];

//Getting All Data sent by the form
$mode = $_POST["mode"];
$amount = "99";//$_POST["amount"];
$comment =$_POST["comment"];

//Validating the comment and including the configuration file for connection to db
if(strlen($comment) == "0"){
    $comment = "Null";
}
require_once "connection.php";

//Creating order id and cust id and thereby injecting to sql
$oid = rand(10000000,99999999);
$cid = rand(1000,9999);
$cid2 = date("d");
$cid = "$cid2$cid";
date_default_timezone_set("Asia/Kolkata");
$timeSTP = date("d/m/y h:i:s a");

//Injecting
    $query = "INSERT INTO `payments` (`email`, `amount`, `orderID`, `timeStamp`, `status`) VALUES ('".$email."', '99', '".$oid."', '".$timeSTP."', 'Initiated')";
    $conn->query($query);
    
?>

<!-- Now Sending Data via Autolaod function (javaScript) to the gateway-->

<html>
<head>
<title>Merchant Check Out Page</title>
<meta name="GENERATOR" content="Evrsoft First Page">
</head>
<body onload = "submitter()">

	<pre>
	</pre>
	<form method="post" action="PaytmKit/pgRedirect.php" id = "paytmForm" style = "display:none">
		<table border="1">
			<tbody>
				<tr>
					<th>S.No</th>
					<th>Label</th>
					<th>Value</th>
				</tr>
				<tr>
					<td>1</td>
					<td><label>ORDER_ID::*</label></td>
					<td><input id="ORDER_ID" tabindex="1" maxlength="20" size="20"
						name="ORDER_ID" autocomplete="off" value="<?php echo $oid; ?>">
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td><label>CUSTID ::*</label></td>
					<td><input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $cid; ?>"></td>
				</tr>
				<tr>
					<td>3</td>
					<td><label>INDUSTRY_TYPE_ID ::*</label></td>
					<td><input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail"></td>
				</tr>
				<tr>
					<td>4</td>
					<td><label>Channel ::*</label></td>
					<td><input id="CHANNEL_ID" tabindex="4" maxlength="12"
						size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
					</td>
				</tr>
				<tr>
					<td>5</td>
					<td><label>txnAmount*</label></td>
					<td><input title="TXN_AMOUNT" tabindex="10"
						type="text" name="TXN_AMOUNT"
						value="<?php echo "$amount"?>">
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><input value="CheckOut" type="submit"	onclick=""></td>
				</tr>
			</tbody>
		</table>

		
		<script>
		function submitter(){
		    document.getElementById("paytmForm").submit()
		}
		</script>
	</form>
</body>
</html>
