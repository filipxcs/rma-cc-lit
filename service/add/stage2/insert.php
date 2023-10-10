<?php
session_start();
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
require("../../../params.php");
require("../../../mysql.php");
require("../../../session_check.php");
$date_paralavh=date("Y-m-d");
$userid=$_SESSION["userid"];
$online=$_POST['online'];


	$query="select cmp from rma.rma_online where id='$_POST[online]'";
	$result=mysql_query($query);
	$cmp=mysql_result($result,0,"cmp");
	if ($cmp==1)
	{$company='Netconnect S.A.';$website='http://www.netconnect.gr';}
	else 
	{$company='CC-Lit.S.A.';$website='http://www.pcshop.gr';}
?>
<body bgcolor=<?php print $colour?>>
<?php

print "<font size=\"5\"><Center>
  <p>Έγινε καταχώρηση</p>
</Center>";
$query = "INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$date_paralavh\",\"Παραλαβή\",\"$userid\",\"\",\"$_POST[docid]\",\"$_POST[docdetails]\",\"$_POST[parathrhseis_paralavis]\")";
$result=mysql_query($query);

$query = "INSERT INTO package VALUES (\"\",\"$_POST[rmaid]\",\"$_POST[package]\",\"$_POST[included]\",\"$_POST[package_details]\")";
$result=mysql_query($query);

$query = " UPDATE rmaservice set stageid=2,inwar='$_POST[warranty]',company='$company' where rmaid = '$_POST[rmaid]'";
$result=mysql_query($query);
print $query;

// ------------- email -----------------------------
	$query="select user from rma.rma_onlinerma where online='$_POST[online]'";
	$result=mysql_query($query);
	$user=mysql_result($result,0,"user");
	$mail_date=date("Y-m-d");
$query="select email from rma.rma_sen_ids where login='$user'";
	$result=mysql_query($query);
	$message='';
	$mail_real_receiver=mysql_result($result,0,"email");
	$mail_receiver="sfouggaras.nikos@cc-lit.gr;kirsanova.lousina@cc-lit.gr";
$email_to =$mail_receiver;
		$semi_rand = md5( time() ); 
		$mime_boundary = "Multipart_Boundary_x{$semi_rand}x"; 
		$email_from = "CC-LIT RMA Department <service@cc-lit.gr>"; 
		$email_subject = "RMA Update receive"; 
	
      $headers = "From: $email_from";
      $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\"";
    	$message_part=	"This auto message is encoded in UTF-8. \n\n";
    	#$message_part .=	"Το RMA σας με αριθμό ".$online." έχει παραληφθεί απο το τεχνικό μας τμήμα. Για περισσότερες λεπτομέρειες παρακαλώ να ενημερωθείτε απο το www.cc-lit.gr.\n\n";
    	$message_part .=	$mail_real_receiver."Η αιτησή σας με αριθμό RMA ".$online." έχει παραληφθεί απο το τεχνικό μας τμήμα.Για περισσότερες λεπτομέρειες παρακαλώ να ενημερωθείτε απο το ".$website.". \n\n";
    	#$message_part .=	"To RMA saw me ari8mo ".$online." exei paralif8ei apo to texniko mas tmhma. Gia perissoteres leptomeries parakalw na enimerw8eite apo to www.cc-lit.gr.";
    	$message_part .=	"To RMA sas me ari8mo ".$online." exei paralif8ei apo to texniko mas tmhma.Gia perissoteres leptomeries parakalw na enimerw8eite apo to ".$website.". \n\n";
		$message = "This is a multi-part message in MIME format. \n\n".
				"--{$mime_boundary}\n" . 
                "Content-Type: text/plain; charset=\"utf8\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . "\n\n".
								"$message_part";
 
//print $email_to;
//print     $_REQUEST['prosfonisi'];
mail($email_to, $email_subject, $message, $headers);
//mail( $email_to, $email_subject, $message, $headers);
// ------------------------ email end ---------------------------------------------------------

// ------------- email -----------------------------
	$query="select user from rma.rma_onlinerma where online='$_POST[online]'";
	$result=mysql_query($query);
	$user=mysql_result($result,0,"user");
	$mail_date=date("Y-m-d");
$query="select email from rma.rma_sen_ids where login='$user'";
	$result=mysql_query($query);
	$message='';

	$mail_receiver=mysql_result($result,0,"email");
$email_to =$mail_receiver;
		$semi_rand = md5( time() ); 
		$mime_boundary = "Multipart_Boundary_x{$semi_rand}x"; 
		$email_from = "CC-LIT RMA Department <service@cc-lit.gr>"; 
		$email_subject = "RMA Update"; 
	
      $headers = "From: $email_from";
      $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\"";
    	$message_part=	"This auto message is encoded in UTF-8. \n\n";
    	#$message_part .=	"Το RMA σας με αριθμό ".$online." έχει παραληφθεί απο το τεχνικό μας τμήμα. Για περισσότερες λεπτομέρειες παρακαλώ να ενημερωθείτε απο το www.cc-lit.gr.\n\n";
    	$message_part .=	"Το RMA σας με αριθμό ".$online." έχει παραληφθεί απο το τεχνικό μας τμήμα.Για περισσότερες λεπτομέρειες παρακαλώ να ενημερωθείτε απο το ".$website.". \n\n";
    	#$message_part .=	"To RMA saw me ari8mo ".$online." exei paralif8ei apo to texniko mas tmhma. Gia perissoteres leptomeries parakalw na enimerw8eite apo to www.cc-lit.gr.";
    	$message_part .=	"To RMA sas me ari8mo ".$online." exei paralif8ei apo to texniko mas tmhma.Gia perissoteres leptomeries parakalw na enimerw8eite apo to ".$website.". \n\n";
		$message = "This is a multi-part message in MIME format. \n\n".
				"--{$mime_boundary}\n" . 
                "Content-Type: text/plain; charset=\"utf8\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . "\n\n".
								"$message_part";
 
//print $email_to;
//print     $_REQUEST['prosfonisi'];
mail($email_to, $email_subject, $message, $headers);
//mail( $email_to, $email_subject, $message, $headers);
// ------------------------ email end ---------------------------------------------------------


mysql_close();
?>
</body>
</html>
</BODY>
</html>

