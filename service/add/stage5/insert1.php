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
mysql_query("SET NAMES 'utf8'");
$userid=$_SESSION["userid"];
$num=$_POST['numrows'];
$cmp=$_POST['company'];
$online_id=$_POST['online_id'];
$wait="0";
$edited="0";
$today=date("Y-m-d");
for ($i = 0; $i < $num; $i++) {
    if ($_POST['approval'.$i]=="3") {
        $appr++;
    }
    $ins_id=$_POST['id'.$i];
    switch ($_POST['approval'.$i]) {
    case 1:   // -------------------- Εγκρίνεται ---------------------------
    $edited++;
    print "Εγκρίνεται<br>";
    $charge=$_POST['charge'.$i];
    $comments=$_POST['comments'.$i];
    $query = "update rma.rma_onlinerma set status='3',charge='$charge',userid='$userid' where online='$online_id' and id='$ins_id'";
    $result=mysql_query($query);
    $query="select id,senid,leename,codcode,itmname,user,serial,problem,comments,pepserial,guar1,guar2,date,status from rma.rma_onlinerma where online='$online_id' and id='$ins_id'";
    $result=mysql_query($query);
    $nums=mysql_numrows($result);
    
    $id=mysql_result($result, 0, "id");
    $senid=mysql_result($result, 0, "senid");
    $leename=mysql_result($result, 0, "leename");
    $codcode=mysql_result($result, 0, "codcode");
    $itmname=mysql_result($result, 0, "itmname");
    $itmname = mysql_real_escape_string($itmname);
    $user=mysql_result($result, 0, "user");
    $serial=mysql_result($result, 0, "serial");
    $problem=mysql_result($result, 0, "problem");
    $comments=mysql_result($result, 0, "comments");
    $pepser=mysql_result($result, 0, "pepserial");
    if ($pepser=="0") {
        $pepserial="";
    } else {
        $pepserial=$pepser;
    }
    $guar1=mysql_result($result, 0, "guar1");
    $guar2=mysql_result($result, 0, "guar2");
    $date=mysql_result($result, 0, "date");
    $status=mysql_result($result, 0, "status");

    if ($guar1 == "1" && $guar2 == "1") {
        $inwar="1";
    } else {
        $inwar="2";
    }
    //if ($guar1 == "0" )
    //{$comments .="Το προϊόν δεν είναι εντός χρόνου εγγύησης.\n\n";}
    //if ($guar2 == "0" )
    ///{$comments .="Το προϊόν δεν πληρεί τους όρους εγγύησης.\n\n";}
    $timestamp=time();
    $query = " INSERT INTO rma.rmamain VALUES ('','2','$user','$timestamp')";
    $result=mysql_query($query);
    $query = " SELECT MAX(rmaid) as rmaid FROM rma.rmamain WHERE userid='$user' AND sessionid='$timestamp'";
    $result=mysql_query($query);
    $rmaid=mysql_result($result, 0, "rmaid");
    $query = " INSERT INTO rma.rmaservice VALUES ('','$rmaid','1','$senid','','$leename','$codcode','$itmname','$serial','$online_id','2','$inwar','2','','','','$problem','$pepserial','','','','','online αίτηση','cc-lit')";
    #print $query."</br>";
    $log_query = mysql_real_escape_string($query);
    $result=mysql_query($query);
    
    $query = " INSERT INTO rma.rma_log VALUES ('','$rmaid','rmaservice','$log_query')";
    $result=mysql_query($query);
    
    $query = " INSERT INTO rma.online VALUES ('','$online_id','$user','')";
    $result=mysql_query($query);
    $query = " INSERT INTO rma.transactions VALUES ('','$rmaid','$date','Δήλωση','$userid','$user','','','$comments')";
    print $guar1."--".$guar2."--".$query;
    $result=mysql_query($query);
    $query = " INSERT INTO rma.online_handle VALUES ('','$online_id','$rmaid','$today','3','')";
    $result=mysql_query($query);


    break;
    case 2:   // -------------------- Αποριπτεται --------------------------
    $edited++;
    $comments=$_POST['comments'.$i];
    $query = "update rma.rma_onlinerma set status='1',comments='$comments',userid='$userid' where online='$online_id' and id='$ins_id'";
    $result=mysql_query($query);
    $query="select id,senid,leename,codcode,itmname,user,serial,problem,comments,pepserial,guar1,guar2,date,status from rma.rma_onlinerma where online='$online_id' and id='$ins_id'";
    $result=mysql_query($query);
    $nums=mysql_numrows($result);
    
    $id=mysql_result($result, 0, "id");
    $senid=mysql_result($result, 0, "senid");
    $leename=mysql_result($result, 0, "leename");
    $codcode=mysql_result($result, 0, "codcode");
    $itmname=mysql_result($result, 0, "itmname");
    $itmname = mysql_real_escape_string($itmname);
    $user=mysql_result($result, 0, "user");
    $serial=mysql_result($result, 0, "serial");
    $problem=mysql_result($result, 0, "problem");
    $comments=mysql_result($result, 0, "comments");
    $pepser=mysql_result($result, 0, "pepserial");
    if ($pepser=="0") {
        $pepserial="";
    } else {
        $pepserial=$pepser;
    }
    $guar1=mysql_result($result, 0, "guar1");
    $guar2=mysql_result($result, 0, "guar2");
    $date=mysql_result($result, 0, "date");
    $status=mysql_result($result, 0, "status");

    if ($guar1 == "1" && $guar2 == "1") {
        $inwar="1";
    } else {
        $inwar="2";
    }
    $timestamp=time();
    $query = " INSERT INTO rma.rmamain VALUES ('','2','$user','$timestamp')";
    $result=mysql_query($query);
    $query = " SELECT MAX(rmaid) as rmaid FROM rma.rmamain WHERE userid='$user' AND sessionid='$timestamp'";
    $result=mysql_query($query);
    $rmaid=mysql_result($result, 0, "rmaid");
    $query = " INSERT INTO rma.rmaservice VALUES ('','$rmaid','10','$senid','','$leename','$codcode','$itmname','$serial','$online_id','2','$inwar','2','','','','$problem','$pepserial','','','','','online αίτηση','cc-lit')";
    $log_query = mysql_real_escape_string($query);
    $result=mysql_query($query);
    
    $query = " INSERT INTO rma.rma_log VALUES ('','$rmaid','rmaservice','$log_query')";
    $result=mysql_query($query);
    
    $query = " INSERT INTO rma.online VALUES ('','$online_id','$user','')";
    $result=mysql_query($query);
    $query = " INSERT INTO rma.transactions VALUES ('','$rmaid','$date','Απόρριψη','$userid','$user','','','$comments')";
    
    $result=mysql_query($query);
    $query = " INSERT INTO rma.online_handle VALUES ('','$online_id','$rmaid','$today','1','')";
    $result=mysql_query($query);
    print $guar1."--".$guar2."--".$query;
    break;
    case 3:   // -----------Σε αναμονη επιβεβαιωσης απο πελατη -------------
    $edited++;
    $charge=$_POST['charge'.$i];
    $comments=$_POST['comments'.$i];
    $query = "update rma.rma_onlinerma set status='2',charge='$charge',comments='$comments',userid='$userid' where online='$online_id' and id='$ins_id'";
    $result=mysql_query($query);

    break;
    case 4:   // -----------Σε αναμονη -------------
    $wait++;
    break;
    }
    print $num."-".$_POST['id'.$i]."-".$_POST['approval'.$i]."-".$_POST['charge_status'.$i]."-".$_POST['charge'.$i]."<br>";
}
    if ($wait=="0") {
        $query = "update rma.rma_online set status='1' where id='$online_id'";
        $result=mysql_query($query);
    }
    
    if ($appr>0) {
        print "<br>still pending";
    }
    if ($edited>"0") {
        if ($status == '1') {

            /**
             * Αποστολή email όταν η αίτηση RMA έχει απορριφθεί.***
             */
            // ------------- email -----------------------------
            $query="select user,codcode,date_format(date,'%d-%c-%Y')AS 'mail_date' from rma.rma_onlinerma where online='$online_id' and id='$ins_id'";
            $result=mysql_query($query);
            $user=mysql_result($result, 0, "user");
            $mail_date=mysql_result($result, 0, "mail_date");
            $query="select email from rma.rma_sen_ids where login='$user'";
            $result=mysql_query($query);
            $message='';
            $mail_receiver=mysql_result($result, 0, "email");
            $email_to =$mail_receiver;
            $semi_rand = md5(time());
            $mime_boundary = "Multipart_Boundary_x{$semi_rand}x";
            $email_from = "CC-LIT RMA Department <service@cc-lit.gr>";
            $email_subject = "RMA Update";

            $headers = "From: $email_from";
            $headers .= "\nMIME-Version: 1.0\n" .
                    "Content-Type: multipart/mixed;\n" .
                    " boundary=\"{$mime_boundary}\"";
            $message_part=	"This auto message is encoded in UTF-8. \n\n";
            $message_part .=	"Η αίτηση σας για επιστροφή προϊόντων στο τεχνικό τμήμα με ημερομηνία ".$mail_date." έχει απορριφθεί. \n\nΜε αιτιολογία: ".$comments." -  Παρακαλούμε συνδεθείτε στο Rma μεσώ του wesite μας για περισσότερες πληροφορίες \n\n \n\n";
            $message_part .=	"H aithsh sas gia epistrofh proiontwn sto texniko tmhma me hmeromhnia ".$mail_date." exei aporrifthei. \n\nMe aitiologia: ".$comments." - Parakaloume syndethite sto RMA meso tou website mas gia perissoteres plirofories";
            $message = "This is a multi-part message in MIME format. \n\n".
                "--{$mime_boundary}\n" .
                "Content-Type: text/plain; charset=\"utf8\"\n" .
                "Content-Transfer-Encoding: 7bit\n\n" . "\n\n".
                                "$message_part";

            mail($email_to, $email_subject, $message, $headers);
        // ------------------------ email end ---------------------------------------------------------
        } elseif ($status == '3') {

            /**
             * Αποστολή email όταν η αίτηση RMA έχει εγκριθεί.***
             */
            // ------------- email -----------------------------
            $query="select user,codcode,date_format(date,'%d-%c-%Y')AS 'mail_date' from rma.rma_onlinerma where online='$online_id' and id='$ins_id'";
            $result=mysql_query($query);
            $user=mysql_result($result, 0, "user");
            $mail_date=mysql_result($result, 0, "mail_date");
            $query="select email from rma.rma_sen_ids where login='$user'";
            $result=mysql_query($query);
            $message='';
            $mail_receiver=mysql_result($result, 0, "email");
            $email_to =$mail_receiver;
            $semi_rand = md5(time());
            $mime_boundary = "Multipart_Boundary_x{$semi_rand}x";
            $email_from = "CC-LIT RMA Department <service@cc-lit.gr>";
            $email_subject = "RMA Update";
    
            $headers = "From: $email_from";
            $headers .= "\nMIME-Version: 1.0\n" .
                    "Content-Type: multipart/mixed;\n" .
                    " boundary=\"{$mime_boundary}\"";
            $message_part=	"This auto message is encoded in UTF-8. \n\n";
            $message_part .=	"Η αίτηση σας για επιστροφή προϊόντων στο τεχνικό τμήμα με αριθμό ".$online_id." και ημερομηνία ".$mail_date." έχει εγκριθεί. \n\n \n\n";
            $message_part .=	"H aithsh sas gia epistrofh proiontwn sto texniko tmhma me arithmo ".$online_id." kai hmerominia ".$mail_date." exei egkrithei.";
            $message = "This is a multi-part message in MIME format. \n\n".
                "--{$mime_boundary}\n" .
                "Content-Type: text/plain; charset=\"utf8\"\n" .
                "Content-Transfer-Encoding: 7bit\n\n" . "\n\n".
                                "$message_part";
 
            mail($email_to, $email_subject, $message, $headers);
        // ------------------------ email end ---------------------------------------------------------
        } elseif ($status == '2') {
            // ------------- email -----------------------------
            $query="select user,codcode,date_format(date,'%d-%c-%Y')AS 'mail_date' from rma.rma_onlinerma where online='$online_id' and id='$ins_id'";
            $result=mysql_query($query);
            $user=mysql_result($result, 0, "user");
            $mail_date=mysql_result($result, 0, "mail_date");
            $query="select email from rma.rma_sen_ids where login='$user'";
            $result=mysql_query($query);
            $message='';
            $mail_receiver=mysql_result($result, 0, "email");
            $email_to =$mail_receiver;
            $semi_rand = md5(time());
            $mime_boundary = "Multipart_Boundary_x{$semi_rand}x";
            $email_from = "CC-LIT RMA Department <service@cc-lit.gr>";
            $email_subject = "RMA Update";
    
            $headers = "From: $email_from";
            $headers .= "\nMIME-Version: 1.0\n" .
                    "Content-Type: multipart/mixed;\n" .
                    " boundary=\"{$mime_boundary}\"";
            $message_part=	"This auto message is encoded in UTF-8. \n\n";
            $message_part .=	$mail_real_receiver."Στην αίτηση σας για επιστροφή προϊόντων στο τεχνικό τμήμα με ημερομηνία ".$mail_date." υπάρχει χρέωση με αιτιολογία: ".$comments." , παρακαλούμε συνδεθείτε στο RMA μεσώ του wesite μας και απαντήστε στο ερώτημα. \n\n";
            $message_part .=	"Sthn aithsh sas gia epistrofh prointwn sto texniko tmhma me hmeromhnia ".$mail_date." yparxei xrewsh me aitiologia: ".$comments." , parakaloume syndetheite sto RMA meso tou website mas kai apanthste sto erwthma";
            $message = "This is a multi-part message in MIME format. \n\n".
                "--{$mime_boundary}\n" .
                "Content-Type: text/plain; charset=\"utf8\"\n" .
                "Content-Transfer-Encoding: 7bit\n\n" . "\n\n".
                                "$message_part";
 

            mail($email_to, $email_subject, $message, $headers);
            // ------------------------ email end ---------------------------------------------------------

            // ------------- email -----------------------------
            $query="select user,codcode,date_format(date,'%d-%c-%Y')AS 'mail_date' from rma.rma_onlinerma where online='$online_id' and id='$ins_id'";
            $result=mysql_query($query);
            $user=mysql_result($result, 0, "user");
            $mail_date=mysql_result($result, 0, "mail_date");
            $query="select email from rma.rma_sen_ids where login='$user'";
            $result=mysql_query($query);
            $message='';
            $mail_real_receiver=mysql_result($result, 0, "email");
            $mail_receiver="sfouggaras.nikos@cc-lit.gr";
            $email_to =$mail_receiver;
            $semi_rand = md5(time());
            $mime_boundary = "Multipart_Boundary_x{$semi_rand}x";
            $email_from = "CC-LIT RMA Department <service@cc-lit.gr>";
            $email_subject = "RMA Update";
    
            $headers = "From: $email_from";
            $headers .= "\nMIME-Version: 1.0\n" .
                    "Content-Type: multipart/mixed;\n" .
                    " boundary=\"{$mime_boundary}\"";
            $message_part=	"This auto message is encoded in UTF-8. \n\n";
            #$message_part .=	"Η αίτηση σας για επιστροφή προϊόντων στο τεχνικό τμήμα με ημερομηνία ".$mail_date." έχει υποστεί επεξεργασία. Για περισσότερες λεπτομέρειες παρακαλώ να ενημερωθείτε απο το www.cc-lit.gr.\n\n";
            $message_part .=	$mail_real_receiver."Στην αίτηση σας για επιστροφή προϊόντων στο τεχνικό τμήμα με ημερομηνία ".$mail_date." υπάρχει χρέωση με αιτιολογία: ".$comments." , παρακαλούμε συνδεθείτε στο RMA μεσώ του wesite μας και απαντήστε στο ερώτημα. \n\n";
            #$message_part .=	"H aithsh sas gia epistrofh proiontwn sto texniko tmhma me hmeromhnia ".$mail_date." exei ypostei epeksergasia. Gia perissoteres leptomeries parakalw na enimerw8eite apo to www.cc-lit.gr.";
            $message_part .=	"Sthn aithsh sas gia epistrofh prointwn sto texniko tmhma me hmeromhnia ".$mail_date." yparxei xrewsh me aitiologia: ".$comments." , parakaloume syndetheite sto RMA meso tou website mas kai apanthste sto erwthma";
            $message = "This is a multi-part message in MIME format. \n\n".
                "--{$mime_boundary}\n" .
                "Content-Type: text/plain; charset=\"utf8\"\n" .
                "Content-Transfer-Encoding: 7bit\n\n" . "\n\n".
                                "$message_part";
 
            //print $email_to;
    //print     $_REQUEST['prosfonisi'];
    //mail($email_to, $email_subject, $message, $headers);
    //mail( $email_to, $email_subject, $message, $headers);
// ------------------------ email end ---------------------------------------------------------
        }
    }
    
?>
<body bgcolor=<?php print $colour?>>

<?php


print "<font size=\"5\"><Center>
  <p>Έγινε καταχώρηση</p>";
  
mysql_close();
?>
</body>
</html>
</BODY>
</html>

