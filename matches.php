<?php
require_once 'header.php';

spl_autoload_register(function ($class_name) {
    require_once("classes/{$class_name}.php");
});

$match_obj = new ClientClass();
$round_obj = new RoundClass();

$matches = $match_obj->getActiveMatches();
/*
$sql = "SELECT round_id FROM lms_rounds "
        . "WHERE tournament_id = $client_tournament_id "
        . "AND is_closed = 0";

$round_id = qColumn($sql);
*/
$where = '';
if ($client_tournament_id){
   $where .= " AND tournament_id = $client_tournament_id";
}
$sql1 = "SELECT * FROM lms_rounds "
        . "WHERE  is_active = 1 "
        . "AND is_closed = 0 {$where} "
        . "ORDER BY close_time DESC LIMIT 1";
$result = qSingle($sql1);
//var_dump($result);
$is_closed = $result['is_closed'];
$close_time = $result['close_time'];
//$round_id = $result['round_id'];
$location = "window.location='$current_url'";
$date = date('Y-m-d H:i:s');
$dc = getTimeConverted($date);
$dt  = $dc->format('Y-m-d H:i:s');
//var_dump($dt);
$now_to_time = strtotime($dt);
//if ($is_closed && (strtotime($is_closed) < time())) {
if (!$result) {
    $msg = '<b>Entry closed. </b><br/>A new round & tournament will be created once the round is complete.';
    FormBuilder::displayResponseModal('roundClosed', 'Round In Progress', $msg, '');
} else {
$close_time = $result['close_time'];
$close_time_to_time = strtotime($close_time);
if($close_time_to_time > $now_to_time){
$remaining = $close_time_to_time - $now_to_time;
$remaining_days = floor($remaining / 86400);
$remaining = $remaining % 86400;
$remaining_hours = floor($remaining / 3600);
$remaining = $remaining % 3600;
$remaining_minutes = floor($remaining / 60);
$remaining_seconds = $remaining % 60;
}  else {
    $remaining_days = 0;
    $remaining_hours = 0;
    $remaining_minutes = 0;
    $remaining_seconds = 0;
}
?>
 <div class="panel panel-default" id="content" style="//display: none;">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                <div class="well">
                    <ul class="nav nav-pills nav-stacked">
                        <li role="presentation" class="active">
                            <a href="matches.php">Matches</a>
                        </li>
                        <li role="presentation">
                            <a href="results.php">Results</a>
                        </li>
                        <?php if (isset($_SESSION['client_id']) && isset($_SESSION['tournament_id'])) { ?>
                            <li role="presentation">
                                <a href="history.php">History</a>
                            </li>
                            <li role="presentation">
                                <a href="account.php">Account</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
                <div class="row-fluid">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="bg-info">
                                <td colspan="3">
                                    <div class="h4">
                                        <?php echo 'Round Closing in: ' . $remaining_days . ' days ' . $remaining_hours . ' hours ' . $remaining_minutes . ' minutes ' . $remaining_seconds . ' seconds'; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="h4">
                                        <?php echo $dt; ?>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($matches as $match) { ?>
                                <tr>
                                    <td width="13%">
                                        <?php echo date_format(date_create($match['match_time']), 'jS M H:i'); ?>
                                    </td>
                                    <td>
                                        <div class="input-group btn btn-default" <?php if ($is_closed == 0) : ?> onclick="window.location = 'process_selection.php?action=<?php echo urlencode('client_selection'); ?>&match_id=<?php echo urlencode($match['match_id']); ?>&team_id=<?php echo urlencode($match['first_team_id']); ?>';" <?php endif; ?> >
                                            <div class="pull-left">
                                                <?php echo '<strong>' . $match_obj->getTeamTitle($match['first_team_id']) . '</strong>'; ?>
                                            </div>
                                            <span class="input-group-btn">
                                                <img width="48" height="36" src="team_logos/<?php echo $match_obj->getTeamLogo($match['first_team_id']); ?>">
                                            </span>
                                        </div>
                                    </td>
                                    <td width="3%">
                                        <div class="btn btn-default btn-success" onclick="window.location = 'process_selection.php?action=<?php echo urlencode('view_stats'); ?>&home_team_id=<?php echo urlencode($match['first_team_id']); ?>&away_team_id=<?php echo urlencode($match['second_team_id']); ?>';">
                                            <?php //Stats button    ?>
                                            View Stats
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group btn btn-default" <?php if ($is_closed == 0): ?> onclick="window.location = 'process_selection.php?action=<?php echo urlencode('client_selection'); ?>&match_id=<?php echo urlencode($match['match_id']); ?>&team_id=<?php echo urlencode($match['second_team_id']); ?>';" <?php endif; ?>>
                                            <span class="input-group-btn">
                                                <img width="48" height="36" src="team_logos/<?php echo $match_obj->getTeamLogo($match['second_team_id']); ?>">
                                            </span>
                                            <div class="pull-right">
                                                <?php echo '<strong>' . $match_obj->getTeamTitle($match['second_team_id']) . '</strong>'; ?>
                                            </div>
                                    </td>
                                </tr>
                            <?php }// end loop  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php require_once 'footer.php'; ?>