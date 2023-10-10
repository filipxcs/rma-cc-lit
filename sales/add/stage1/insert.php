<?php php php 
session_start();
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php php php 
require("../../../params.php");
require("../../../mysql.php");
$userid=$_SESSION["userid"];
$num=$_POST['numrows'];
$online_id=$_POST['online_id'];
$wait="0";
for ($i = 0; $i < $num; $i++ )
	{
	$ins_id=$_POST['id'.$i];
	switch ($_POST['approval'.$i])
	{
	case 1:   // -------------------- Εγκρίνεται ---------------------------
	Print "Εγκρίνεται<br>";
	$comments=$_POST['comments'.$i];
		$query = "update rma.zonlinerma_s set status='3' where online='$online_id' and id='$ins_id'";
	$result=mysql_query($query);
	$query="select id,senid,leename,codcode,itmname,user,serial,reason,price,qty,date,guar1,guar2,docid,mciid,comments,salesman,salesman_email from rma.zonlinerma_s where online='$online_id' and id='$ins_id'";
	$result=mysql_query($query);	
	$nums=mysql_numrows($result);
	
	$id=mysql_result($result,0,"id");
	$comments_m=mysql_result($result,0,"comments");
	$senid=mysql_result($result,0,"senid");
	$price=mysql_result($result,0,"price");
	$qty=mysql_result($result,0,"qty");
	$leename=mysql_result($result,0,"leename");
	$codcode=mysql_result($result,0,"codcode");
    $itmname=mysql_result($result,0,"itmname");
	$user=mysql_result($result,0,"user");
	$serial=mysql_result($result,0,"serial");
	$reason=mysql_result($result,0,"reason");
    $guar1=mysql_result($result,0,"guar1");
	$guar2=mysql_result($result,0,"guar2");
	$date=mysql_result($result,0,"date");
	$docid=mysql_result($result,0,"docid");
	$mciid=mysql_result($result,0,"mciid");
	$salesman=mysql_result($result,0,"salesman");
	$salesman_email=mysql_result($result,0,"salesman_email");
	
	$timestamp=time();
	$query = " INSERT INTO rma.rmamain_s VALUES (\"\",\"3\",\"$user\",\"$timestamp\")";
	$result=mysql_query($query);
	$query = " SELECT MAX(rmaid) as rmaid FROM rma.rmamain_s WHERE userid='$user' AND sessionid='$timestamp'";
	$result=mysql_query($query);
	$rmaid=mysql_result($result,0,"rmaid");
	$query = " INSERT INTO rma.rmasales VALUES (\"\",\"$rmaid\",\"1\",\"$senid\",\"$leename\",\"$codcode\",\"$itmname\",\"$serial\",\"$online_id\",\"$inwar\",\"$reason\",\"$price\",\"$qty\",\"$docid\",\"$mciid\",\"$date\",\"$comments_m\",\"$salesman\",\"$salesman_email\")";
	$result=mysql_query($query);
	$query = " INSERT INTO rma.online VALUES (\"\",\"$online_id\",\"$user\")";
	$result=mysql_query($query);


	//ayto gia na moy bazei svsto xrhsth sto trans
	$query10="select login from rma.user where userid=$userid";
	$result10=mysql_query($query10);	
	$username=mysql_result($result10,0,"login");
	//______________
	
	
	
	$query = " INSERT INTO rma.transactions_s VALUES (\"\",\"$rmaid\",\"$date\",\"Έγκριση\",\"$userid\",\"$username\",\"\",\"\",\"$comments\")";
	print $guar1."--".$guar2."--".$query;
	$result=mysql_query($query);

	//-------------- email ------
	$query="select user,codcode,date_format(date,'%d-%c-%Y')AS 'mail_date' from rma.zonlinerma_s where online='$online_id' and id='$ins_id'";
	$result=mysql_query($query);
	$user=mysql_result($result,0,"user");
	$codcode=mysql_result($result,0,"codcode");
	$mail_date=mysql_result($result,0,"mail_date");
$query="select email from cclitworld.users_users where login='$user'";
	$result=mysql_query($query);
	$message='';
$email_to =mysql_result($result,0,"email");
		$semi_rand = md5( time() ); 
		$mime_boundary = "Multipart_Boundary_x{$semi_rand}x"; 
		$email_from = "Macedonian Peripherals RMA Department <rma@cc-lit.gr>"; 
		$email_subject = "RMA Update"; 
	
      $headers = "From: $email_from";
      $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\"";
    	$message_part=	"Η αίτησή σας για επιστροφή προϊόντος στην εταιρεία μας με ημερομηνία ".$mail_date." για το είδος ".$codcode." έχει εγκριθεί με αριθμό RMA ".$online_id;
		$message = "This is a multi-part message in MIME format. \n\n".
				"--{$mime_boundary}\n" . 
                "Content-Type: text/plain; charset=\"utf8\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . "\n\n".
								"$message_part";
 
//print $email_to;
//print     $_REQUEST['prosfonisi'];
mail($email_to, $email_subject, $message, $headers);
//mail( $email_to, $email_subject, $message, $headers);
//------------------- email end -----------------------------------
	break;
	case 2:   // -------------------- Αποριπτεται --------------------------
	$comments=$_POST['comments'.$i];
		$query = "update rma.zonlinerma_s set status='1',comments='$comments' where online='$online_id' and id='$ins_id'";
	$result=mysql_query($query);
	$query="select id,senid,leename,codcode,itmname,user,serial,reason,price,qty,date,guar1,guar2,docid,mciid,comments,salesman,salesman_email from rma.zonlinerma_s where online='$online_id' and id='$ins_id'";
	$result=mysql_query($query);	
	$nums=mysql_numrows($result);
	
	$id=mysql_result($result,0,"id");
	$comments_m=mysql_result($result,0,"comments");
	$senid=mysql_result($result,0,"senid");
	$price=mysql_result($result,0,"price");
	$qty=mysql_result($result,0,"qty");
	$leename=mysql_result($result,0,"leename");
	$codcode=mysql_result($result,0,"codcode");
    $itmname=mysql_result($result,0,"itmname");
	$user=mysql_result($result,0,"user");
	$serial=mysql_result($result,0,"serial");
	$reason=mysql_result($result,0,"reason");
    $guar1=mysql_result($result,0,"guar1");
	$guar2=mysql_result($result,0,"guar2");
	$date=mysql_result($result,0,"date");
	$docid=mysql_result($result,0,"docid");
	$mciid=mysql_result($result,0,"mciid");
	$salesman=mysql_result($result,0,"salesman");
	$salesman_email=mysql_result($result,0,"salesman_email");
	
	$timestamp=time();
	$query = " INSERT INTO rma.rmamain_s VALUES (\"\",\"3\",\"$user\",\"$timestamp\")";
	$result=mysql_query($query);
	$query = " SELECT MAX(rmaid) as rmaid FROM rma.rmamain_s WHERE userid='$user' AND sessionid='$timestamp'";
	$result=mysql_query($query);
	$rmaid=mysql_result($result,0,"rmaid");
	$query = " INSERT INTO rma.rmasales VALUES (\"\",\"$rmaid\",\"1\",\"$senid\",\"$leename\",\"$codcode\",\"$itmname\",\"$serial\",\"$online_id\",\"$inwar\",\"$reason\",\"$price\",\"$qty\",\"$docid\",\"$mciid\",\"$date\",\"$comments_m\",\"$salesman\",\"$salesman_email\")";
	$result=mysql_query($query);
	$query = " INSERT INTO rma.online VALUES (\"\",\"$online_id\",\"$user\")";
	$result=mysql_query($query);


	//ayto gia na moy bazei svsto xrhsth sto trans
	$query10="select login from rma.user where userid=$userid";
	$result10=mysql_query($query10);	
	$username=mysql_result($result10,0,"login");
	//______________
	

		
	$query = " INSERT INTO rma.transactions_s VALUES (\"\",\"$rmaid\",\"$date\",\"Απόρριψη\",\"$userid\",\"$username\",\"\",\"\",\"$comments\")";
	print $guar1."--".$guar2."--".$query;
	$result=mysql_query($query);

	// ---------- email -----------------
	$query="select user,codcode,date_format(date,'%d-%c-%Y')AS 'mail_date' from rma.zonlinerma_s where online='$online_id' and id='$ins_id'";
	$result=mysql_query($query);
	$user=mysql_result($result,0,"user");
	$codcode=mysql_result($result,0,"codcode");
	$mail_date=mysql_result($result,0,"mail_date");
	$query="select email from cclitworld.users_users where login='$user'";
	$result=mysql_query($query);
	$message='';
	$email_to =mysql_result($result,0,"email");
		$semi_rand = md5( time() ); 
		$mime_boundary = "Multipart_Boundary_x{$semi_rand}x"; 
		$email_from = "Macedonian Peripherals RMA Department <rma@cc-lit.gr>"; 
		$email_subject = "RMA Update"; 
	
      $headers = "From: $email_from";
      $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\"";
    	$message_part=	"Η αίτηση σας για επιστροφή προϊόντος στην εταιρεία μας με ημερομηνία ".$mail_date." για το είδος ".$codcode." έχει απορριφθεί. Για περισσότερες λεπτομέρειες μπορείτε να ενημερωθείτε απο το www.cc-lit.gr.";
		$message = "This is a multi-part message in MIME format. \n\n".
				"--{$mime_boundary}\n" . 
                "Content-Type: text/plain; charset=\"utf8\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . "\n\n".
								"$message_part";
 
//print $email_to;
//print     $_REQUEST['prosfonisi'];
mail($email_to, $email_subject, $message, $headers);
//mail( $email_to, $email_subject, $message, $headers);
// ------------email end ---------------------------
	break;
	case 4:   // -----------Σε αναμονη -------------
	$wait++;
	break;
	}
	print $num."-".$_POST['id'.$i]."-".$_POST['approval'.$i]."-".$_POST['charge_status'.$i]."-".$_POST['charge'.$i]."<br>";
	}
	if($wait=="0")
	{$query = "update rma.zonline set status='1' where id='$online_id'";
	$result=mysql_query($query);}
	
	if ($appr>0)
	{print "<br>still pending";}
?>
<body bgcolor=<?php php php print $colour?>>

<?php php php 


print "<font size=\"5\"><Center>
  <p>Έγινε καταχώρηση</p>";
  
mysql_close();
?>
</body>
</html>
</BODY>
</html>

