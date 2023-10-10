<?php
    /**
     * @author Lazaridis Ioannis
     * @email lazaridis.ioannis@cc-lit.gr
     * @create date 2020-07-23 09:15:59
     * @modify date 2020-07-28 09:35:08
     * @desc Php script που ορίζει ώς άκυρα RMA
     * είναι ηλικίας 25 ημερών αλλά δεν έχει γίνει 
     * παραλαβή των προϊόντων.
     * Ταυτόχρονα στέλνει ενημερωτικό email στην δ/νση
     * service@cc-lit.gr που περιέχει τους online
     * αριθμούς RMA που ακυρώθηκαν.
     */

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require '../../mysql.php';


function uncancel(){
    $rmaonline = '26721';
    $uncancel_query = "SELECT * FROM rmaservice,transactions WHERE rmaservice.rmaid=transactions.rmaid AND rmaservice.stageid='9' AND online=$rmaonline order by rmaservice.rmaid ";
    $uncancel_result = mysql_query($uncancel_query);
    $uncancel_numrows =mysql_numrows($uncancel_result);

    if ($uncancel_numrows != 0) {
        /** Find rmaids  */
        $uncancel_rmaid=mysql_result($uncancel_result, $i, "rmaid");

        //Αλλαγή του stageid =>1 δηλαδή kind = Δήλωση με βάση το rmaid.
        $uncancel_query2 = "UPDATE rmaservice set stageid=1 where rmaid=$uncancel_rmaid";
        $uncancel_result2=mysql_query($uncancel_query2);

        // $uncancel_query3 = "DELETE FROM `transactions` WHERE rmaid = '95308' AND kind='Ακύρωση'";
        $uncancel_result3=mysql_query($uncancel_query3);


    }


}


    function _automatic_cancelation()
    {
        // $query="SELECT * FROM rmaservice,transactions WHERE rmaservice.rmaid=transactions.rmaid AND rmaservice.stageid='1' AND transactions.date<DATE_ADD(curdate(), INTERVAL -25 DAY) order by rmaservice.rmaid";
        $query="SELECT * FROM rmaservice
            LEFT JOIN transactions ON rmaservice.rmaid=transactions.rmaid 
            LEFT JOIN rma_onlinerma ON rmaservice.online=rma_onlinerma.online 
            WHERE rmaservice.stageid='1' AND transactions.date<DATE_ADD(curdate(), INTERVAL -25 DAY) GROUP BY rmaservice.rmaid ORDER BY rmaservice.rmaid";
        $result=mysql_query($query);
        $num=mysql_numrows($result);

        function _send_email_to_service($message)
        {
            //Δημιουργία email.
            $email_from = "CC-LIT RMA Department <service@cc-lit.gr>";

            $headers = "From: $email_from \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=\"utf8\"r\n";
            $to_email = 'service@cc-lit.gr';
            $subject = 'Αυτοματη ακύρωση RMA';
            // $message = "
            // Καλημέρα σας.<br><br>
            // Τα RMA με αριθμό <strong> ".$all_rmaonline." </strong> ακυρώθηκαν λόγω παρέλευσης 25 ημερών.";

            //Αποστολή email.
            mail($to_email, $subject, $message, $headers);
        }

        function _send_email_to_client($message, $rmaonline)
        {
            $query3="select user,codcode,date_format(date,'%d-%c-%Y')AS 'mail_date' from rma.rma_onlinerma where online=$rmaonline";
            $result3=mysql_query($query3);
            $user=mysql_result($result3, 0, "user");

            $query4="select email from rma.rma_sen_ids where login='$user'";
            $result4=mysql_query($query4);
            $mail_receiver=mysql_result($result4, 0, "email");
    
            //Δημιουργία email.
            $email_from = "CC-LIT RMA Department <service@cc-lit.gr>";
            $headers = "From: $email_from \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=\"utf8\"r\n";
            $to_email = "$mail_receiver";
            $subject = 'Αυτόματη ακύρωση RMA';
            // $message = "
            // Καλημέρα σας.<br><br>result4
            // Τα RMA με αριθμό <strong> ".$all_rmaonline." </strong> ακυρώθηκαν λόγω παρέλευσης 25 ημερών.";
    
            //Αποστολή email.
            mail($to_email, $subject, $message, $headers);
        }

        function _check_if_client_is_greek($rmaonline){
            $query="SELECT senid FROM `rma_onlinerma` where online = $rmaonline";
            $result=mysql_query($query);
            $num=mysql_numrows($result);
            
            if ($num != 0) {
                for ($i = 0; $i < $num; $i++) {
                    $senid = mysql_result($result, $i, "senid");
                }
            }

        }

        if ($num != 0) {
            for ($i = 0; $i < $num; $i++) {
                $rmaid=mysql_result($result, $i, "rmaid");
                $rmaonline=mysql_result($result, $i, "online");
                $cancel_date=date("Y-m-d");
                $userid = 'automatic_cancelation';

                //Συλλογή όλων των online rma.
                $all_rmaonline .= "$rmaonline, ";
        
                //Αλλαγή του stageid => 9 δηλαδή kind = Άκυρο με βάση το rmaid.
                $query2 = "UPDATE rmaservice set stageid=9 where rmaid=$rmaid";
                $result2=mysql_query($query2);

                //Προσθήκη νέου transaction (Κινησης) σε κάθε rma που ακυρώνεται. (testing)
                $query3 = "INSERT INTO transactions VALUES (\"\",\"$rmaid\",\"$cancel_date\",\"Ακύρωση\",\"$userid\",\"\",\"\",\"\",\"\")";
                $result3=mysql_query($query3);

                //Αποστολή email σε πελάτη.
                $message = "
                    Καλημέρα σας.<br><br>
                    Ο αριθμός RMA <strong> ".$rmaonline." </strong> ακυρώθηκε λόγω παρέλευσης 20 ημερών. ";

                 _send_email_to_client($message, $rmaonline);
            }
            
            //Αποστολή email σε Service.
            $message = "
            Καλημέρα σας.<br><br>
            Τα RMA με αριθμό <strong> ".$all_rmaonline." </strong> ακυρώθηκαν λόγω παρέλευσης 25 ημερών.";

            _send_email_to_service($message);
        } else {
            //Αποστολή email σε Service.
            $message = "
            Καλημέρα σας.<br><br>
            Δεν υπάρχουν RMA ηλικίας 25 ημερών και άνω που να μην έχουν παραληφθεί τα προϊόντα τους.";

             _send_email_to_service($message);

            throw new Exception('Δεν υπάρχουν RMA ηλικίας 25 ημερών και άνω που να μην έχουν παραληφθεί τα προϊόντα τους.');
        }
    }
    
    try {
        _automatic_cancelation();
    } catch (Exception $e) {
        echo '<strong>Caught exception:</strong> ',  $e->getMessage(), "\n";
    }


