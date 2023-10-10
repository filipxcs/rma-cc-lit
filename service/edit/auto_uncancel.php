<?php
/**
 * @author [Ioannes Lazaridis]
 * @email [ioannis.lazaridis@cc-lit.gr]
 * @create date 2021-07-28 11:07:37
 * @modify date 2021-11-11 11:07:37
 * @desc [Uncancels the  already canceled RMAs. The following script receives the selected RMA ids from the uncancel.php view. Then It changes the status of each. And lastly, it deletes the `cancellation` transaction.]
 * @notes [The following code uses deprecated functions of php 5.6]
 */

 /**
  * Show / Hide Errors
  */
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

/**
 *  Mysql config file of RMA project
 */
require '../../mysql.php';

if (isset($_POST['selected_rmaids'])) {
    $rmaids_array = $_POST['selected_rmaids'];
    foreach ($rmaids_array as $key => $value) {
        $rmaid = $value;
        /** Anti-SQL injection */
        if (preg_match("/^\d+$/", $rmaid)) {
            /**
             *  *******     ATTENTION       *******
             *  ~~~ UPDATE & DELETE Queries ahead ~~~~
             * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
             */

            /**
             *  Changes the `stageid` column from 9 => 1
             */
            $update_query = mysql_query('UPDATE rmaservice set stageid=1 where rmaid='.$rmaid.'');
            $error = mysql_error();
            $error_log = '';
            
            if ( !empty( $error = mysql_error() ) ){
                $error_log .= ''. $error ."<br />\n";
            } else {
                /**
                 *  Deletes records from `transactions` table for  each rmaid variable with kind='Ακύρωση'
                 */
                $delete_query = mysql_query('DELETE FROM transactions WHERE rmaid = '.$rmaid.' AND kind="Ακύρωση"');
                $error = mysql_error();

                if ( !empty( $error = mysql_error()) ){
                    $error_log .= ''. $error ."<br />\n";
                    /** Revert 1st query back to stageid = 9 */
                    $update_query = mysql_query('UPDATE rmaservice set stageid=9 where rmaid='.$rmaid.'');
                }
            }
            $response = '';
            if ($error_log != '') {
                $response = $error_log;
            }else {
                $response[] = $rmaid;
            }
            echo json_encode($response);
        }else {
            /** Return error */
        }
    }
}   
