<?php
include_once 'classes/DatabaseClass.php';
spl_autoload_register(function ($class_name) {
    require_once("classes/{$class_name}.php");
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$client_obj = new ClientClass();

//Checks every 5 mins and deactivates if match has started
$date = date('Y-m-d H:i:s');
$date_to_zone = getTimeConverted($date);
$d = $date_to_zone->format('Y-m-d');
$t = $date_to_zone->format('H:i:s');
$dt = $date_to_zone->format('Y-m-d H:i:s');
//echo $t;


//Auto select for clients who have not made a selection in each round that they are enabled to play
//Check for clients and their tournaments and rounds that are about to close
        $sql1 = "SELECT r.close_time, r.round_id, ct.client_id, "
                . "ct.tournament_id FROM lms_rounds r "
                . "LEFT JOIN lms_card_tournaments ct ON(r.tournament_id = ct.tournament_id) "
                . "WHERE TIMESTAMPDIFF(MINUTE, '{$dt}',  r.close_time) <= 5 "
                . "AND r.is_active = 1 "
                . "AND r.is_closed = 0 "
                . "AND ct.is_active = 1 "
                . "ORDER BY ct.tournament_id";
        //var_dump($sql1);
        $results = qArray($sql1);
        //var_dump($results);
        $count = 0;
        if (count($results) > 0) {
            foreach ($results as $result) {
                $client_id = $result['client_id'];
                $round_id = $result['round_id'];
                $tournament_id = $result['tournament_id'];
                
                $ft = $client_obj->getFirstTeamOpenForClient($tournament_id, $client_id);
                //var_dump($ft);

                //for each client, tournament and round combination, check if client has 
                //made or not made a selection in that round
                $num_rows_affected = $client_obj->autoSelectForClient($client_id, $tournament_id, $round_id);
                $count = $count + $num_rows_affected;
            }
             echo "Task-1 Complete, $count selections submitted<br/>";
            //$message = "$count selections submitted";
            //FormBuilder::displayResponseModal('clientAutoSelectionSubmitMsg', 'Auto Selection', $message, '');
        }else{
            echo "Task-1 Failed, $count selections submitted<br/>";
            //$message = "No selections submitted";
            //FormBuilder::displayResponseModal('clientAutoSelectionSubmitMsg', 'Auto Selection', $message, $location);
        }
        
        
        //Close matches that have started
$sql1 = "UPDATE lms_matches SET has_started = 1 "
        . "WHERE DATE(match_time) = '{$d}' AND TIME(match_time) < '{$t}' "
        . "AND is_active = 1 "
        . "AND status = 0 "
        . "AND has_started = 0";
$count1 = qExe($sql1);

if($count1 > 0){
    //$db->commit();
    echo 'Task-2 Complete<br/>';
}
 else {
    //$db->rollBack();
    echo 'Task-2 Failed<br/>';
}

//Close rounds whose first matche have started
// Checks every 5 mins and closes round if first match has started
$sql2 = "UPDATE lms_rounds SET "
        . "is_closed = 1 "
        . "WHERE DATE(close_time) = '{$d}' AND TIME(close_time) < '{$t}' "
        . "AND is_closed = 0 "
        . "AND is_active = 1";
$count2 = qExe($sql2);

if($count2 > 0){
    //$db->commit();
    echo 'Task-3 Complete<br/>';
}
 else {
    //$db->rollBack();
    echo 'Task-3 Failed<br/>';
}

//$db = null;
?>