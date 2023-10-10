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






/**
 * Query to Get Rmas that exeed 60 days since their creation and still have stageid='1' (not received the product)
 * and they are made by international clients.
 */
$international_rmas_query="SELECT * FROM rmaservice 
LEFT JOIN transactions ON rmaservice.rmaid = transactions.rmaid 
LEFT JOIN rma_onlinerma ON rmaservice.online = rma_onlinerma.online 
LEFT JOIN rma_sen_ids ON  rmaonline.user = rma_sen_ids.login
WHERE rmaservice.stageid='1' 
AND rma_onlinerma.afm REGEXP '^([0-9]+[A-Za-z]+[0-9]*)|([A-Za-z]+[0-9]+[A-Za-z]*)$' 
AND transactions.date<DATE_ADD(curdate(), INTERVAL -1 DAY) 
GROUP BY rmaservice.rmaid";

// SELECT * FROM rmaservice 
// LEFT JOIN transactions ON rmaservice.rmaid = transactions.rmaid 
// LEFT JOIN rma_onlinerma ON rmaservice.online = rma_onlinerma.online 
// LEFT JOIN rma_sen_ids ON  rma_onlinerma.user = rma_sen_ids.login
// WHERE rmaservice.stageid='1' 
// AND rma_sen_ids.tracode LIKE '98%' 
// AND transactions.date<DATE_ADD(curdate(), INTERVAL -1 DAY) 
// GROUP BY rmaservice.rmaid

/**
 * Query to Get Rmas that exeed 25 days since their creation and still have stageid='1' (not received the product)
 * and they are made by greek only clients.
 */
$greek_rmas_query="SELECT * FROM rmaservice 
LEFT JOIN transactions ON rmaservice.rmaid=transactions.rmaid 
LEFT JOIN rma_onlinerma ON rmaservice.online=rma_onlinerma.online 
WHERE rmaservice.stageid='1' 
AND rma_onlinerma.afm not like '%[^0-9]%' 
AND transactions.date<DATE_ADD(curdate(), INTERVAL -1 DAY) 
GROUP BY rmaservice.rmaid";

/**
 * Query to update the stageid => 9 (kind = Άκυρο) using the rmaid.
 */
$update_stageid_query = "UPDATE rmaservice set stageid=9 where rmaid=$rmaid";

/**
 * Query to insert a new transaction every time the script cancels rmaids.
 */
$insert_new_transation_query = "INSERT INTO transactions 
VALUES (\"\",\"$rmaid\",\"$cancel_date\",\"Ακύρωση\",\"$userid\",\"\",\"\",\"\",\"\")";



/**
 * Function to get and cancel the rmas in the database using the appropriate query.
 */


function cancelRmas(){
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
}
}