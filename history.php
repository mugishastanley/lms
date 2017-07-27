<?php
include_once 'header.php';
spl_autoload_register(function ($class_name) {
    include_once("classes/{$class_name}.php");
});
if (!isset($_SESSION['client_id']) || !isset($_SESSION['login_name']) || !isset($_SESSION['tournament_id'])) {
    echo '<script>location.href="index.php";</script>';
} else {
    $tournament_obj = new TournamentClass();
    $client_obj = new ClientClass();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$query = "SELECT lms_client_selections.*, "
        . "lms_rounds.title as round, "
        . "lms_teams.title as team "
        . "FROM lms_client_selections "
        . "LEFT JOIN lms_rounds ON(lms_client_selections.round_id = lms_rounds.round_id) "
        . "LEFT JOIN lms_teams ON(lms_client_selections.team_id = lms_teams.team_id) "
        . "WHERE lms_client_selections.client_id = {$longin_client_id} "
        . "AND lms_client_selections.tournament_id = {$client_tournament_id} "
        . "ORDER BY lms_client_selections.date_created DESC";
 
 /*
$query = "SELECT * FROM client_history "
        . "WHERE client_id = {$longin_client_id} "
        . "AND tournament_id = {$client_tournament_id}";
 * 
 */       
$selections = qArray($query);

$tournament = $tournament_obj->getTournament($client_tournament_id);
?>
<div class="panel-body" style="background-color: whitesmoke;" id="content">
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
            <div class="well">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation">
                        <a href="matches.php">Matches</a>
                    </li>
                    <li role="presentation">
                        <a href="results.php">Results</a>
                    </li>
                    <?php if (isset($_SESSION['client_id']) && isset($_SESSION['tournament_id'])) { ?>
                    <li role="presentation"  class="active">
                        <a href="history.php">History</a>
                    </li>
                    
                    <li role="presentation">
                        <a href="account.php">Account</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-8 col-md-9 col-sm-8 col-xs-8">
            <table class="tabel table-condensed table-bordered table-striped table-hover" width="100%">
                <thead>
                    <tr class="bg-info">
                        <th colspan="4">Previous Selections [<?php echo $tournament['title']; ?>]</th>
                    </tr>
                    <tr class="bg-warning">
                        <th>Round</th>
                        <th>Team Selected</th>
                        <th>Win/Draw</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($selections as $value) { 
                        switch ($value['is_win']) {
                                    case '1':
                                        $color = "#98FB98";
                                        $status = 'Won';
                                        break;
                                    case '0':
                                        $color = "#FA8072";
                                        $status = 'Lost';
                                        break;
                                    case 'NULL':
                                    default :
                                        $color = "";
                                        $status = 'Pending';
                                        break;
                                }
                        ?>
                        <tr style=" background-color: 	<?php echo $color; ?>;">
                            <td align="center">
                                <?php echo $value['round']; ?>
                            </td>
                            <td align="center">
                                <?php echo $value['team']; ?>
                            </td>
                            <td align="center">
                                <?php echo ($value['with_draw'] == 1) ? 'Yes' : 'No'; ?>
                            </td>
                            <td align="center">
                                <?php echo $status; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
            <?php $avail_teams = $client_obj->getClientOpenTeams($longin_client_id, $client_tournament_id); ?>
            <table class="tabel table-condensed table-bordered table-striped table-hover" width="100%">
                <thead>
                    <tr class="bg-info">
                        <th>Available Teams [<?php echo $tournament['title']; ?>]</th>
                    </tr>          
                </thead>
                <tbody>
                    <?php foreach ($avail_teams as $value) { 
                        ?>
                        <tr>
                            <td>
                                <?php echo $value['title']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
}
include_once 'footer.php'; 

?>