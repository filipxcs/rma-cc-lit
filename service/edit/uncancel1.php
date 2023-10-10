<?php
/**
 * @author [Ioannes Lazaridi]
 * @email [ioannis.lazaridis@cc-lit.gr]
 * @create date 2021-11-11 13:07:37
 * @modify date 2021-11-11 13:07:37
 * @desc [This is a response file. It receives the RMA id from the uncancel.php view to find the online RMA and retrieves all the associate rma ids with the provided one.]
 */

require '../../mysql.php';


if (isset($_POST['rmaid'])) {
    $rmaid = $_POST['rmaid'];
    $query_get_online_rma = "SELECT * FROM rmaservice where rmaid = $rmaid AND stageid = 9 ";
    $results_get_online_rma= mysql_query($query_get_online_rma);
    $get_online_rma = mysql_fetch_assoc($results_get_online_rma);
    $online_rma_uncancel = $get_online_rma['online'];

    $query_get_all_rmaids = "SELECT * FROM rmaservice where online = $online_rma_uncancel AND stageid = 9";
    $results_get_all_rmaids = mysql_query($query_get_all_rmaids);

    while($result_array = mysql_fetch_assoc($results_get_all_rmaids)){
            $reponse_array[] = array(
                'rma_id' => $result_array['rmaid'],
                'online' => $result_array['online'],
                'leename' => $result_array['leename'],
                'codcode' => $result_array['codcode'],
                'sn' => $result_array['sn'],
            ); 
    }
    echo json_encode($reponse_array);
}