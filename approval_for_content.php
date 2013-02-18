<?php
include 'connect.php';

$email = '';
$content = '';
$brand_name = '';
$content_type = '';
$ticket_name = '';
$content_number = '';
$email1 = ''

$query = mysql_query("SELECT gt.client_id,gt.ticket_name,gt.main_type,ci.* FROM generate_ticket gt, client_info ci where ci.fb_pageid = gt.client_id") or die(mysql_error());
while($result = mysql_fetch_array($query,MYSQL_ASSOC)){
	$query1 = mysql_query("SELECT count(*) total,type FROM ".$result['client_id']."_updates status = 4 group by ticket_id") or die(mysql_error());
	$result1 = mysql_fetch_array($query,MYSQL_ASSOC);
	if($result1['total'] > 0){
		$email = 'tarun@yrals.com';
		$email1 = 'joshi.dvsiet@gamil.com'
		$content = $result['type'];
		$brand_name = $result['client_name'];
		$content_type = $result['main_type'];
		$ticket_name = $result['ticket_name'];
		$content_number = $result1['total'];
	}
}


function mail_approval_for_content($email, $content, $brand_name, $content_type, $ticket_name,$content_number)
{
$to = '';
$subject = "Approval Required for ".$content." || ".$brand_name."";
$message = "Dear Team ".$brand_name.", 
<br><br>

Your <font color='#000099'>".$content_type."</font> are written and ready for approval on Tabigation.
<br>
Here are the details of the content that needs your approval.
<br><br>
<font color='#000099'>
1. ".$ticket_name." - ".$content_type.": ".$content_number."
</font>
<br><br>
Kindly login to Tabigation and provide us your approvals and feedback, within the next 7 days.
<br>
We look forward to receiving your approvals on this as soon as possible, so we may incorporate any feedback you may have.<br>
Do let us know if you need any help or have any questions.
";

	$from = "$email1";
	$headers = "To: <".$email.">\r\n";
	//$headers .= "To: <".$emailC1.">\r\n";
	//$headers .= "To: Rochelle Pereira <rochelle@yrals.com>\r\n"; 
	//$headers = "To: Yuvraj <yuvraj@yrals.com>\r\n"; 
	$headers .=  "From: Tabigation <$from>\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset='ISO-8859-1'\r\n";
	mail($to,$subject,$message,$headers);
}


mail_approval_for_content($email, $content, $brand_name, $content_type, $ticket_name,$content_number);

?>
