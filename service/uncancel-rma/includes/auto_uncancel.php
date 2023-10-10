<?php
/**
 * @author [Ioannes Lazaridis]
 * @email [ioannis.lazaridis@cc-lit.gr]
 * @create date 2021-07-28 11:07:37
 * @modify date 2021-07-28 11:07:37
 * @desc [Uncancels the  alreay canceled RMAs.
 * The following script find the rmaids from rma's online number.
 * Then It changes the status of each. And lastly it deletes the `cancelation` transaction]
 * @notes [The following code uses deprecated functions of php 5.6]
 */

 /**
  * Show / Hide Errors
  */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 *  Mysql config file of RMA project
 */
require '../../../mysql.php';


/**
 *  Check if POST request is set
 */
if (isset($_POST['online_rma'])) {
    $rmaonline = $_POST['online_rma'];
    $rmaid_array = array();

    /**
     *  Query to find all rmaids from provided online RMA
     */
    $uncancel_query = "SELECT * FROM rmaservice,transactions WHERE rmaservice.rmaid=transactions.rmaid AND rmaservice.stageid='9' AND online=$rmaonline order by rmaservice.rmaid ";
    $uncancel_result = mysql_query($uncancel_query); 
    $uncancel_numrows = mysql_numrows($uncancel_result);    //** Get the number of results */
 
    /**
     *  If the $error variable of MySql is not empty then collect errors
     */
    if ( !empty( $error = mysql_error() ) ){ 
        $error_log .= ''. $error ."<br />\n";

    } else{
        /**
         *  If the results are not 0 then find rmaid of each result
         */
        if ($uncancel_numrows != 0) { 
            for ($i=0; $i < $uncancel_numrows; $i++) { 
                $uncancel_rmaid = mysql_result($uncancel_result, $i, "rmaid");
                /**
                 *  *******     ATTENTION       *******
                 *  ~~~ UPDATE & DELETE Queries ahead ~~~~
                 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                 */

                /**
                 *  Changes the `stageid` column from 9 => 1
                 */
                $uncancel_query2 = "UPDATE rmaservice set stageid=1 where rmaid=$uncancel_rmaid";
                $uncancel_result2=mysql_query($uncancel_query2);
        
                /**
                 *  Deletes records from `transactions` table for  each rmaid variable with kind='Ακύρωση'
                 */
                $uncancel_query3 = "DELETE FROM transactions WHERE rmaid = '.$uncancel_rmaid.' AND kind='Ακύρωση'";
                $uncancel_result3=mysql_query($uncancel_query3);

                if ( !empty( $error2 = mysql_error() ) ){
                    $error_log .= ''. $error ."<br />\n";

                } else {
                    $rmaid_array[$i] =  $uncancel_rmaid;
                    
                }
            }
            ob_end_clean();

            $reponse_array = array(
                'error_log' => $error_log,
                'rmaid_array' => $rmaid_array
            ); 
            echo json_encode($reponse_array);

        }else {
            ob_end_clean();
            $empty_response = 'Δεν υπάρχουν ακυρωμένα RMAs';
            echo ($empty_response); 
        }
    }
}



   
