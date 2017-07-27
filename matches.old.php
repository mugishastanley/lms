<?php
require_once 'header.php';
//require_once 'classes/ClientClass.php';
//require_once 'classes/TournamentClass.php';
spl_autoload_register(function ($class_name){
    require_once("classes/{$class_name}.php");
});

$db = getNewDb();

$match_obj = new ClientClass();
$round_obj = new RoundClass();

$matches = $match_obj->getActiveMatches();

$sql = "SELECT round_id FROM lms_rounds "
        . "WHERE tournament_id = $client_tournament_id "
        . "AND is_closed = 0";
$round_id = $db->prepare($sql)->fetchColumn();
//$sql1 = "SELECT is_closed FROM lms_rounds WHERE is_active = 1";
$sql1 = "SELECT close_time FROM lms_rounds WHERE is_active = 1";
$is_closed = $db->prepare($sql1)->fetchColumn();

$location = "window.location='$current_url'";

if ($is_closed && (strtotime($is_closed) < time())) {
    $msg = 'Entry closed. A new round & tournament will be created once the round is complete.';
    FormBuilder::displayResponseModal('roundClosed', 'Round In Progress', $msg, '');
} else {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'client_selection':
                //Display the modal with options
                $selected_match_id = $_GET['match_id'];
                $selected_team_id = $_GET['team_id'];
                $selected_match = $match_obj->getMatchDetails($selected_match_id);
                $selected_team = $match_obj->getTeam($selected_team_id);
                echo '<script type="text/javascript">$(function(){$("#clientSelection").modal("show");});</script>';
                echo '<div class="modal fade" id="clientSelection" role="dialog" data-backdrop="static" align="center" style="margin-left: 25%; margin-top: 10%; position: absolute;">
                    <div class="modal-dialog col-md-5">
                      <div class=" modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="window.location=\'' . $current_url . '\'">
                                &times;
                            </button>
                            <h3>Team Selection</h3>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" method="get" action="">
                                <table class="table-condensed" width="60%" align="center">
                                    <tr>
                                        <td colspan="2" align="center">
                                            You have selected <strong style="color: red;font-size: 17px;">' . $selected_team['title'] . '</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td colspan="2" align="center">
                                    <strong>' . $selected_match['first_team_title'] . ' vs ' . $selected_match['second_team_title'] . '</strong>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            (' . date_format(date_create($selected_match['match_time']), 'd M y H:i') . ')
                                                <input type="hidden" name="selected_match_id" value="' . $selected_match_id . '">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <input type="hidden" name="selected_team_id" value="' . $selected_team_id . '">
                                            <input type="submit" class="btn btn-primary btn-lg btn-block" name="submit_win" value="WIN">
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-primary btn-lg" name="submit_with_draw" value="WIN OR DRAW">
                                        </td>
                                    </tr>
                                    <tr>
                                    <td colspan="2" align="center">
                                    
                                    </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <div style="font-size: 11px;" align="center">
                                For one round ONLY you can select Win or Draw. 
                                This means that if you pick Team A with Win or Draw and Team A wins or draws then you are through to the next round!
                            </div>
                        </div>
                    </div>
                    </div>
                </div>';
                break;
            case 'view_stats':
                //Logic to display the modal with stats for both teams
                $home_team_id = $_GET['home_team_id'];
                $away_team_id = $_GET['away_team_id'];

                $home_team = $match_obj->getTeam($home_team_id);
                $away_team = $match_obj->getTeam($away_team_id);

                $ht_prev_selections = count($match_obj->getTeamPreviousSelections($home_team_id, $client_tournament_id));
                $at_prev_selections = count($match_obj->getTeamPreviousSelections($away_team_id, $client_tournament_id));
                $total_selections = count($round_obj->getTournamentSelections($client_tournament_id));
                if ($total_selections > 0) {
                    $perc_home = ceil(($ht_prev_selections / $total_selections) * 100);
                    $perc_away = ceil(($at_prev_selections / $total_selections) * 100);
                } else {
                    $perc_home = 0;
                    $perc_away = 0;
                }
                echo '<script type="text/javascript">$(function(){$("#statistics").modal("show");});</script>';

                echo '<div class="modal fade" id="statistics" role="dialog" data-backdrop="static" align="center" style="margin-left: 25%; margin-top: 10%; position: absolute;">
            <div class="modal-dialog col-md-5">
               <div class=" modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="window.location=\'' . $current_url . '\'">
                        &times;
                    </button>
                    <h3>Teams Statistics</h3>
                </div>
                <div class="modal-body">
                        <table class="table-condensed" width="80%" align="center">
                            <tr>
                                <td>
                                    <div class="btn btn-default btn-block" style="height: 50px;">
                                        <div class="pull-left">' . $home_team['title'] . '</div>
                                        <div class="pull-right">
                                            <img width="48" height="36" src="team_logos/' . $home_team['logo'] . '">
                                        </div>
                                    </div> 
                                </td>
                                <td>
                                       <div class="btn btn-default btn-block" style="height: 50px;">
                                       <div class="pull-left">
                                            <img width="48" height="36" src="team_logos/' . $away_team['logo'] . '">
                                        </div>
                                        <div class="pull-right">' . $away_team['title'] . '</div> 
                                    </div> 
                                </td>
                            </tr>

                            <tr>
                               <td>
                                   Selected by:
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: ' . $perc_home . '%">
                                            ' . $perc_home . '%</div>
                                    </div>
                                </td>
                                <td>
                                    Selected by:
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: ' . $perc_away . '%">
                                            ' . $perc_away . '%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                Last 5 matches
                                
                                </td>
                                <td>
                                Last 5 matches
                                
                                </td>
                            </tr>
                        </table>
                </div>
            </div>
            </div>
        </div>';
                break;
        }
    }

//If client selects Win option
    if (isset($_GET['submit_win'])) {
        $selected_match_id = $_GET['selected_match_id'];
        $selected_team_id = $_GET['selected_team_id'];
        //Check if client is not logged in
        if (!$longin_client_id && !$longin_card_id && !$client_tournament_id) {
            FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', 'Your  are not logged in, Please login!', $location);
        } else {
            //Client is logged in
            //Check if client has Already made a selection in this round
            $selections = $match_obj->getClientSelections($longin_client_id, $client_tournament_id, $round_id);
            if (count($selections) > 0) { 
//Already made a selection in this round 
                FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', 'Your  have already made a selection in this round', $location);
            } else {
                /*Not made a selection in this round yet
                 * Check if Cleint has already selected this team 
                 * In previous selections in this tournament
                 * 
                 */
                if (count($client_played_teams) > 0) {
                    FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', 'Your  have already selected this team in this tournament', $location);
                } else {
                    //Not selected this team in this tournament yet
                    //Save client selection
                    $array = array();
                    //Save selection
                    $array['date_created'] = date('Y-m-d H:i:s');
                    $array['client_id'] = $longin_client_id;
                    $array['tournament_id'] = $client_tournament_id;
                    $array['round_id'] = $round_id;
                    $array['match_id'] = $selected_match_id;
                    $array['team_id'] = $selected_team_id;
                    $array['with_draw'] = 0;
                    $row_count = $match_obj->addClientSelection($array);
                    //If selection submitted successfully
                    if ($row_count > 0) {
                        FormBuilder::displayResponseModal('clientSelectionSubmitSuccess', 'Success', 'Your  have sucessfully submited your selection', $location);
                        //Error occured while submitting selection
                    } else {
                        FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', 'An error has occur, try again', $location);
                    }
                }
            }
        }
    }
    
    //If client selects Win or Draw option
    if (isset($_GET['submit_with_draw'])) {
        $selected_match_id = $_GET['selected_match_id'];
        $selected_team_id = $_GET['selected_team_id'];
        //Check if client is not logged in
        if (!$longin_client_id && !$longin_card_id && !$client_tournament_id) {
            FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', 'Your  are not logged in, Please login first', $location);
        } else {
            //Client is logged in
            //Check for duplicate selections
            $selections = $match_obj->getClientSelections($longin_client_id, $client_tournament_id, $round_id);
            if (count($selections) > 0) {
                //Already made a selection in this round 
                FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', 'Your  have already made a selection in this round', $location);
            } else {
                $client_played_teams = $match_obj->getClientSelections($longin_client_id, $client_tournament_id, '', $selected_team_id);
                if (count($client_played_teams) > 0) {
                    FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', 'Your  have already selected this team in this tournament', $location);
                } else {
                    //Not selected this team in this tournament yet
                    //Check if client has ever selected Win or Draw in this tournament
                    $with_draw_status = $db->fetchArrayRows("SELECT * FROM lms_client_selections WHERE client_id = $longin_client_id AND tournament_id = $client_tournament_id AND with_draw = 1");

                    if (count($with_draw_status) > 0) {
                        //Client has ever selected Win or Draw option
                        FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', 'Your  have already selected <b>Win or Draw</b> in this tournament', $location);
                    } else {
                        //Client has never selected Win or Draw option in this tournament
                        $array = array();
                        //Save selection
                        $array['date_created'] = date('Y-m-d H:i:s');
                        $array['client_id'] = $longin_client_id;
                        $array['tournament_id'] = $client_tournament_id;
                        $array['round_id'] = $round_id;
                        $array['match_id'] = $selected_match_id;
                        $array['team_id'] = $selected_team_id;
                        $array['with_draw'] = 1;
                        $row_count = $match_obj->addClientSelection($array);
                        //If selection submitted successfully
                        if ($row_count > 0) { //If selection submitted successfully
                            FormBuilder::displayResponseModal('clientSelectionSubmitSuccess', 'Success', 'Your  have sucessfully submited your selection', $location);
                        } else { //Error occured while submitting selection
                            FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', 'An error has occur, try again', $location);
                        }
                    }
                }
            }
        }
    }
}
?>
<div class="panel-body" style="background-color: whitesmoke;" id="content">
    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered table-responsive" style="border: 1px solid #D0D0D0;">
                <thead>
                    <tr class="bg-info">
                        <td colspan="4">
                            <?php
                            $start_date = '2016-02-13 18:15:00';
                            $date = strtotime($start_date);
                            $remaining = $date - time();
                            $remaining_days = floor($remaining/86400);
                            $remaining = $remaining % 86400;
                            $remaining_hours = floor($remaining/3600);
                            $remaining = $remaining % 3600;
                            $remaining_minutes = floor($remaining/60);
                            $remaining_seconds = $remaining % 60;
                            ?>
                            <div class="h1">
                               <?php echo '<Round Closing in: '.$remaining_days.' days '.$remaining_hours.'hours '.$remaining_minutes.'minutes '.$remaining_seconds.'seconds'; ?>
                            </div>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matches as $match) { ?>

                        <tr>
                            <td width="17%">
                                <?php echo date_format(date_create($match['match_time']), 'd M y H:i'); ?>
                            </td>
                            <td>
                                <div class="btn btn-default btn-block" style="height: 50px;" <?php if ($is_closed != 1) : ?> onclick="window.location = 'matches.php?action=<?php echo urlencode('client_selection'); ?>&match_id=<?php echo urlencode($match['match_id']); ?>&team_id=<?php echo urlencode($match['first_team_id']); ?>';" <?php endif; ?> >
                                    <div class="pull-left">
                                        <?php echo '<strong>' . $match_obj->getTeamTitle($match['first_team_id']) . '</strong>'; ?>
                                    </div>
                                    <div class="pull-right">
                                        <img width="48" height="36" src="team_logos/<?php echo $match_obj->getTeamLogo($match['first_team_id']); ?>">
                                    </div>
                                </div>
                            </td>
                            <td width="3%">
                                <div class="btn btn-default" onclick="window.location = 'matches.php?action=<?php echo urlencode('view_stats'); ?>&home_team_id=<?php echo urlencode($match['first_team_id']); ?>&away_team_id=<?php echo urlencode($match['second_team_id']); ?>';">
                                    <?php //Stats button   ?>
                                    View Stats
                                </div>
                            </td>
                            <td>
                                <div class="btn btn-default btn-block" style="height: 50px;" <?php if ($is_closed != 1) { ?> onclick="window.location = 'matches.php?action=<?php echo urlencode('client_selection'); ?>&match_id=<?php echo urlencode($match['match_id']); ?>&team_id=<?php echo urlencode($match['second_team_id']); ?>';" <?php } ?>>
                                    <div class="pull-left">
                                        <img width="48" height="36" src="team_logos/<?php echo $match_obj->getTeamLogo($match['second_team_id']); ?>">
                                    </div
                                    <div class="pull-right">
                                        <?php echo '<strong>' . $match_obj->getTeamTitle($match['second_team_id']) . '</strong>'; ?>
                                    </div>
                            </td>
                        </tr>
                    <?php }// end loop ?>
                </tbody>

            </table>
        </div>
        <div class="col-md-4">
            <?php
            $query = "SELECT lms_client_selections.*, "
                    . "lms_rounds.title as round, "
                    . "lms_teams.title as team "
                    . "FROM lms_client_selections "
                    . "LEFT JOIN lms_rounds ON(lms_client_selections.round_id = lms_rounds.round_id) "
                    . "LEFT JOIN lms_teams ON(lms_client_selections.team_id = lms_teams.team_id) "
                    . "WHERE lms_client_selections.client_id = {$longin_client_id} "
                    . "AND lms_client_selections.tournament_id = {$client_tournament_id} "
                    . "ORDER BY lms_client_selections.date_created DESC";

            $client_prev_selections = $db->prepare($query)->fetchAll();
            ?>
            <table class="tabel table-bordered table-striped" width="100%">
                <thead>
                    <tr class="bg-info">
                        <th colspan="4">Previous Selections</th>
                    </tr>
                    <tr class="bg-info">
                        <th>Round</th>
                        <th>Team Selected</th>
                        <th>Win/Draw</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($client_prev_selections as $client_prev_selection) { ?>

                        <tr>
                            <td align="center">
                                <?php echo $client_prev_selection['round']; ?>
                            </td>
                            <td align="center">
                                <?php echo $client_prev_selection['team']; ?>
                            </td>
                            <td align="center">
                                <?php echo ($client_prev_selection['with_draw'] == 1) ? 'Yes' : 'No'; ?>
                            </td>
                            <td align="center">
                                <?php
                                switch ($client_prev_selection['is_win']) {
                                    case 1:
                                        echo 'Won';
                                        break;
                                    case 2:
                                        echo 'Lost';
                                        break;
                                    case 3:
                                        echo 'Suspended';
                                        break;
                                    default:
                                        echo 'Pending';
                                        break;
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>