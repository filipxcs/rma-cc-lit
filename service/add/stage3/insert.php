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
$userid=$_SESSION["userid"];
$online=$_POST['online'];

$query="select cmp from rma.rma_online where id='$online'";
$result=mysql_query($query);
$num=mysql_numrows($result);
for ($i = 0; $i < $num; $i++ )
	{
	$cmp=mysql_result($result,$i,"cmp");
	}

print $online;
$date=date("Y-m-d");
?>
<body bgcolor=<?php print $colour?>>

<?php
print $_POST[stageid]."-".$_POST[Category];
if ($_POST[stageid] == "6" && $_POST[Category] == "7")
{
$query = "INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$date\",\"Χρέωση\",\"$userid\",\"\",\"\",\"\",\"$_POST[parathrhseis_transaction]\")";
$result=mysql_query($query);
$query = " INSERT INTO charges VALUES (\"\",\"$_POST[rmaid]\",\"$userid\",\"\",\"$date\",\"\",\"$_POST[xreosi]\",\"$_POST[parathrhseis_transaction]\",\"1\")";
$result=mysql_query($query);
}
else if ($_POST[stageid] == "6" && $_POST[Category] == "2")
{
$query = "INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$date\",\"Επικοινωνία\",\"$userid\",\"\",\"\",\"\",\"$_POST[parathrhseis_transaction]\")";
$result=mysql_query($query);
}
else 
{
if ($_POST[epiveveosh] == "1")
{}
else 
{
$query = " INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$date\",\"Δίαγνωση\",\"$userid\",\"\",\"\",\"\",\"$_POST[epiveveosh]\")";
$result=mysql_query($query);
}

if ($_POST[Category] == "4" || $_POST[Category] == "5" || $_POST[Category] == "6")
{
$query = "INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$date\",\"Τερματισμός\",\"$userid\",\"\",\"\",\"\",\"$_POST[parathrhseis_transaction]\")";
$result=mysql_query($query);
$query = "INSERT INTO checks VALUES (\"\",\"$_POST[rmaid]\",\"$userid\",\"$date\",\"$_POST[Category]\",\"\")";
$result=mysql_query($query);
$query = " UPDATE rmaservice set stageid=6 where rmaid = '$_POST[rmaid]'";
$result=mysql_query($query);
// ------------- email -----------------------------
	$query="select user from rma.rma_onlinerma where online='$_POST[online]'";
	$result=mysql_query($query);
	$user=mysql_result($result,0,"user");
	$mail_date=date("Y-m-d");
	$query="select email from rma.rma_sen_ids where login='$user'";
	$result=mysql_query($query);
	$message='';
	$mail_real_receiver=mysql_result($result,0,"email");
	$mail_receiver="service@cc-lit.gr";
$email_to =$mail_receiver;
		$semi_rand = md5( time() ); 
		$mime_boundary = "Multipart_Boundary_x{$semi_rand}x"; 
		$email_from = "CC-LIT RMA Department <service@cc-lit.gr>"; 
		$email_subject = "RMA Update send"; 
	
      $headers = "From: $email_from";
      $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\"";
    	$message_part=	"This auto message is encoded in UTF-8. \n\n";
    	$message_part .=	$mail_real_receiver." \n\n \n\n";
    	$message_part .=	"Αγαπητέ πελάτη, \n\n";
    	$message_part .=	"Θα θέλαμε να σας ενημερώσουμε ότι η αίτησή σας με RMA ".$online." έχει ολοκληρωθεί. \n\n";
    	$message_part .=	"Αν είστε πελάτης ΑΘήνας ή Θεσσαλονίκης, παρακαλώ να παραλάβετε σε εύλογο χρονικό διάστημα, το προϊόν από τις εγκαταστάσεις μας. \n\n";
    	$message_part .=	"Αν είστε πελάτης Επαρχίας, θα σας αποσταλεί το προϊόν σύντομα. \n\n";
    	$message_part .=	"Για οποιαδήποτε επιπλέον πληροφορία ή διευκρίνιση μπορείτε να καλέσετε στο 801 700 7762. \n\n \n\n";
    	$message_part .=	"Με εκτίμηση \n\n";
    	$message_part .=	"Τμήμα Service CC-Lit Α.Ε. \n\n \n\n";
    	$message_part .=	"Agapite Pelath, \n\n \n\n";
    	$message_part .=	"8a 8elame na sas enhmervsoume oti h aithsh sas me RMA ".$online." exei oloklhrv8ei. \n\n";
    	$message_part .=	"An eiste pelaths A8hnas h 8essalonikhs, parakalv na paralavete se eulogo xroniko diasthma, to proion sas apo tus egkatastaseis mas. \n\n";
    	$message_part .=	"An eiste pelaths Eparxias, 8a sas apostalei to proion syntoma. \n\n";
    	$message_part .=	"Gia opoiadhpote epipleon plhroforia h dieukrinhsh mporeite na kaleitai sto 801 700 7762. \n\n \n\n";
    	$message_part .=	"Me ektimhsh \n\n";
    	$message_part .=	"Tmhma service CC-Lit S.A. \n\n \n\n";
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
    	$message_part .=	"Αγαπητέ πελάτη, \n\n";
    	$message_part .=	"Θα θέλαμε να σας ενημερώσουμε ότι η αίτησή σας με RMA ".$online." έχει ολοκληρωθεί. \n\n";
    	$message_part .=	"Αν είστε πελάτης ΑΘήνας ή Θεσσαλονίκης, παρακαλώ να παραλάβετε σε εύλογο χρονικό διάστημα, το προϊόν από τις εγκαταστάσεις μας. \n\n";
    	$message_part .=	"Αν είστε πελάτης Επαρχίας, θα σας αποσταλεί το προϊόν σύντομα. \n\n";
    	$message_part .=	"Για οποιαδήποτε επιπλέον πληροφορία ή διευκρίνιση μπορείτε να καλέσετε στο 801 700 7762. \n\n \n\n";
    	$message_part .=	"Με εκτίμηση \n\n";
    	$message_part .=	"Τμήμα Service CC-Lit Α.Ε. \n\n \n\n";
    	$message_part .=	"Agapite Pelath, \n\n \n\n";
    	$message_part .=	"8a 8elame na sas enhmervsoume oti h aithsh sas me RMA ".$online." exei oloklhrv8ei. \n\n";
    	$message_part .=	"An eiste pelaths A8hnas h 8essalonikhs, parakalv na paralavete se eulogo xroniko diasthma, to proion sas apo tis egkatastaseis mas. \n\n";
    	$message_part .=	"An eiste pelaths Eparxias, 8a sas apostalei to proion syntoma. \n\n";
    	$message_part .=	"Gia opoiadhpote epipleon plhroforia h dieukrinish mporeite na kaleite sto 801 700 7762. \n\n \n\n";
    	$message_part .=	"Me ektimhsh \n\n";
    	$message_part .=	"Tmhma service CC-Lit S.A. \n\n \n\n";
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
}
else if ($_POST[Category] == "1")
{$query = "INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$date\",\"Έλεγχος\",\"$userid\",\"\",\"\",\"\",\"$_POST[parathrhseis_transaction]\")";
$result=mysql_query($query);
}
else if ($_POST[Category] == "2")
{$query = "INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$date\",\"Επικοινωνία\",\"$userid\",\"\",\"\",\"\",\"$_POST[parathrhseis_transaction]\")";
$result=mysql_query($query);
}
else if ($_POST[Category] == "8")
{$query = "INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$date\",\"Εσωτερικό\",\"$userid\",\"\",\"\",\"\",\"$_POST[parathrhseis_transaction]\")";
$result=mysql_query($query);
}
else if ($_POST[Category] == "9")
{$query = "INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$date\",\"Επιλογή χειρισμού\",\"$userid\",\"\",\"\",\"\",\"$_POST[parathrhseis_transaction]\")";
$result=mysql_query($query);
}
else if ($_POST[Category] == "3")
{$query = "INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$date\",\"Επισκευή\",\"$userid\",\"\",\"\",\"\",\"$_POST[parathrhseis_transaction]\")";
$result=mysql_query($query);
$query = " UPDATE rmaservice set noreason='$_POST[anaitia_epistrofh],userblame='$_POST[ypiatiotita_xrhsth] where rmaid = '$_POST[rmaid]'";
$result=mysql_query($query);
}
else if ($_POST[Category] == "7")
{
$query = "INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$date\",\"Χρέωση\",\"$userid\",\"\",\"\",\"\",\"$_POST[parathrhseis_transaction]\")";
$result=mysql_query($query);
if ($_POST['is_fax']==1)
{
$query = " INSERT INTO charges VALUES (\"\",\"$_POST[rmaid]\",\"$userid\",\"\",\"$date\",\"\",\"$_POST[xreosi]\",\"$_POST[parathrhseis_transaction]\",\"1\")";
$result=mysql_query($query);
}
else
{
$query = " INSERT INTO charges VALUES (\"\",\"$_POST[rmaid]\",\"$userid\",\"\",\"$date\",\"\",\"$_POST[xreosi]\",\"$_POST[parathrhseis_transaction]\",\"0\")";
$result=mysql_query($query);
}
$query = " UPDATE rmaservice set noreason='$_POST[anaitia_epistrofh],userblame='$_POST[ypaitiotita_xrhsth] where rmaid = '$_POST[rmaid]'";
$result=mysql_query($query);
$query = " select tiki_user from rma.transactions where rmaid='$_POST[rmaid]' and kind='Δήλωση'";
$result=mysql_query($query);
$usrname=mysql_result($result,0,"tiki_user");
$query = " select email from rma.rma_sen_ids where login='$usrname'";
$result=mysql_query($query);
$email=mysql_result($result,0,"email");
$query = " select online from rma.rmaservice where rmaid='$_POST[rmaid]'";
$result=mysql_query($query);
$online=mysql_result($result,0,"online");

if ($_POST['is_fax']==1)
{
}
else
{
### ------ Send email
if ($cmp=='2')
{
$query="select user from rma.rma_onlinerma where online='$_POST[online]'";
	$result=mysql_query($query);
	$user=mysql_result($result,0,"user");
	$mail_date=date("Y-m-d");
$query="select email from rma.rma_sen_ids where login='$user'";
	$result=mysql_query($query);
	$message='';
		$semi_rand = md5( time() ); 
		$mime_boundary = "Multipart_Boundary_x{$semi_rand}x"; 
		$email_from = " webmaster <web@cc-lit.gr>"; 
		$email_subject = "RMA Request"; 
	
      $headers = "From: $email_from";
      $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\"";
		$message_part  =	"This auto message is encoded in UTF-8. \n\n";
    	$message_part .=	"Χρειάζεται επιβεβαίωση χρέωσης για το RMA με αριθμό ".$online.". Κάνετε login στο http://www.pcshop.gr . Επιλέξτε απο το μενού Συνεργασία -> RMA -> τεχνικό RMA -> Προβολή επιστροφών -> Τον Αριθμό RMA ".$online.".  \n\n";
		$message_part .=	"Xreiazete epivevaiwsh xreosis gia to RMA me arithmo ".$online.". Kanete login sto http://www.pcshop.gr . Epilexte apo to menu Synergasia -> RMA -> texniko RMA -> Provoli epistrofon -> Ton Ari8mo RMA ".$online;
		$message = "This is a multi-part message in MIME format. \n\n".
				"--{$mime_boundary}\n" . 
                "Content-Type: text/plain; charset=\"utf8\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . "\n\n".
								"$message_part";
 
//print $email_to;
//print     $_REQUEST['prosfonisi'];
mail($email_to, $email_subject, $message, $headers);
}

if ($cmp=='1')
{
$query="select user from rma.rma_onlinerma where online='$_POST[online]'";
	$result=mysql_query($query);
	$user=mysql_result($result,0,"user");
	$mail_date=date("Y-m-d");
$query="select email from rma.rma_sen_ids where login='$user'";
	$result=mysql_query($query);
	$message='';
		$semi_rand = md5( time() ); 
		$mime_boundary = "Multipart_Boundary_x{$semi_rand}x"; 
		$email_from = " webmaster <web@netconnect.gr>"; 
		$email_subject = "RMA Request"; 
	
      $headers = "From: $email_from";
      $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\"";
		$message_part  =	"This auto message is encoded in UTF-8. \n\n";
    	$message_part .=	"Χρειάζεται επιβεβαίωση χρέωσης για το RMA με αριθμό ".$online.". Κάνετε login στο http://www.netconnect.gr . Επιλέξτε απο το μενού Συνεργασία -> RMA -> τεχνικό RMA -> Προβολή επιστροφών -> Τον Αριθμό RMA ".$online.".  \n\n";
		$message_part .=	"Xreiazete epivevaiwsh xreosis gia to RMA me arithmo ".$online.". Kanete login sto http://www.netconnect.gr . Epilexte apo to menu Synergasia -> RMA -> texniko RMA -> Provoli epistrofon -> Ton Ari8mo RMA ".$online;
		$message = "This is a multi-part message in MIME format. \n\n".
				"--{$mime_boundary}\n" . 
                "Content-Type: text/plain; charset=\"utf8\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . "\n\n".
								"$message_part";
 
//print $email_to;
//print     $_REQUEST['prosfonisi'];
mail($email_to, $email_subject, $message, $headers);
}

}
#######################
}

}
$query = " UPDATE rmaservice set inwar='$_POST[warranty]' where rmaid = '$_POST[rmaid]'";
$result=mysql_query($query);

print "<font size=\"5\"><Center>
  <p>Έγινε καταχώρηση</p>
</Center></font>";

print "</br>".$cmp;
mysql_close();
?>
</body>
</html>
</BODY>
</html>

