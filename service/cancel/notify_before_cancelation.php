<?php
/**
 * @author Lazaridis Ioannis
 * @email lazaridis.ioannis@cc-lit.gr
 * @create date 2020-07-28 09:35:53
 * @modify date 2020-07-28 09:35:53
 * @desc Βρίσκει όλα τα RMA ηλικίας 10 ημερών
 * που δεν έχουν παραλήφθεί τα προϊόντα τους και
 * στέλνει ενημερωτικό email στους users.
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../mysql.php';


function _notify_user_before_cancelation()
{
    function _send_email_to_service($message, $rmaonline)
    {
        //Δημιουργία email.
        $email_from = "CC-LIT RMA Department <service@cc-lit.gr>";

        $headers = "From: $email_from \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=\"utf8\"r\n";
        $to_email = 'service@cc-lit.gr';
        $subject = "Ενημέρωση κατάστασης RMA #$rmaonline";
        ;
        // $message = "
        // Καλημέρα σας.<br><br>
        // Τα RMA με αριθμό <strong> ".$all_rmaonline." </strong> ακυρώθηκαν λόγω παρέλευσης 25 ημερών.";

        //Αποστολή email.
        mail($to_email, $subject, $message, $headers);
    }

    function _send_email_to_client($message, $rmaonline, $email_receiver)
    {
        //Δημιουργία email.
        $email_from = "CC-LIT RMA Department <service@cc-lit.gr>";
        $headers = "From: $email_from \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=\"utf8\"r\n";
        $to_email = "$email_receiver";
        $subject = "Ενημέρωση κατάστασης RMA #$rmaonline";
        // $message = "
        // Καλημέρα σας.<br><br>result4
        // Τα RMA με αριθμό <strong> ".$all_rmaonline." </strong> ακυρώθηκαν λόγω παρέλευσης 25 ημερών.";

        //Αποστολή email.
        mail($to_email, $subject, $message, $headers);
    }

    
    $query="SELECT * FROM rmaservice,transactions WHERE rmaservice.rmaid=transactions.rmaid AND rmaservice.stageid='1' AND transactions.date = DATE_ADD(curdate(), INTERVAL -10 DAY) order by rmaservice.rmaid";
    $result=mysql_query($query);
    $num=mysql_numrows($result);
    
    if ($num != 0) {
        for ($i=0; $i < $num; $i++) {
            $rmaid=mysql_result($result, $i, "rmaid");
            $rmaonline=mysql_result($result, $i, "online");
            $query3="select user,codcode,date_format(date,'%d-%c-%Y')AS 'mail_date' from rma.rma_onlinerma where online=$rmaonline";
            $result3=mysql_query($query3);
            $user=mysql_result($result3, 0, "user");
            $query4="select email from rma.rma_sen_ids where login='$user'";
            $result4=mysql_query($query4);
            $email_receiver=mysql_result($result4, 0, "email");

            //Αποστολή email σε πελάτη.
            $message = "
            Καλημέρα σας.<br><br>
            Ο αριθμός RMA <strong> ".$rmaonline." </strong> θα ακυρωθεί εντός 10 ημερών. Παρακαλώ φροντίστε για την παράδοση του προϊόντος στο τεχνικό μας τμήμα.<br><br>
            Σας ευχαριστούμε πολύ.";
            _send_email_to_client($message, $rmaonline, $email_receiver);
            
            //Αποστολή email σε Service.
            $message = "
            Καλημέρα σας.<br><br>
            Ο χρήστης ".$user." ενημερώθηκε ότι το RMA του  με αριθμό <strong> ".$rmaonline." </strong> θα ακυρωθεί εντός 10 ημερών.";
            _send_email_to_service($message, $rmaonline);
        }
    } else {
        //Αποστολή email σε Service.
        $message = "
        Καλημέρα σας.<br><br>
        Δεν υπάρχουν RMA ηλικίας 10 ημερών και άνω που να μην έχουν παραληφθεί τα προϊόντα τους.";

        _send_email_to_service($message);
        throw new Exception('Δεν υπάρχουν RMA ηλικίας 10 ημερών και άνω που να μην έχουν παραληφθεί τα προϊόντα τους.');
    }
}

try {
    _notify_user_before_cancelation();
} catch (Exception $e) {
    echo '<strong>Caught exception:</strong> ',  $e->getMessage(), "\n";
}
