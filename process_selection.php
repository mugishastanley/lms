<?php
include_once 'header.php';
spl_autoload_register(function ($class_name) {
    include_once("classes/{$class_name}.php");
});
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$client_obj = new ClientClass();
$round_obj = new RoundClass();

$message = '';
$location = "window.location='matches.php'";

if (isset($_GET['action']) && $_GET['action'] == 'view_stats') {
//Logic to display the modal with stats for both teams
    $home_team_id = ($_GET['home_team_id']) ? $_GET['home_team_id'] : 0;
    $away_team_id = ($_GET['away_team_id']) ? $_GET['away_team_id'] : 0;

    $symbol_draw = '<div class="pull-left" style="border-radius: 50%; width: 9%; padding: 1%; text-align: center;color: #fff; background-color: #ffc73d;">D</div>';
    $symbol_win = '<div class="pull-left" style="border-radius: 50%; width: 9%; padding: 1%; text-align: center;color: #fff; background-color: #00ff80;">W</div>';
    $symbol_loss = '<div class="pull-left" style="border-radius: 50%; width: 9%; padding: 1%; text-align: center;color: #fff; background-color: #ff0000;">L</div>';

    if ($home_team_id && $away_team_id) {
        $home_team = $client_obj->getTeam($home_team_id);
        $away_team = $client_obj->getTeam($away_team_id);
        $sql1 = "SELECT match_id from lms_matches "
                . "WHERE (first_team_id = $home_team_id "
                . "OR second_team_id = $home_team_id) "
                . "AND first_team_score IS NOT NULL "
                . "AND second_team_score IS NOT NULL "
                . "ORDER BY match_time DESC LIMIT 5";
        $prev_matches_ht = qArray($sql1);
        //sort($prev_matches_ht);
//var_dump($prev_matches_ht);

        $sql2 = "SELECT match_id from lms_matches "
                . "WHERE (first_team_id = $away_team_id "
                . "OR second_team_id = $away_team_id) "
                . "AND first_team_score IS NOT NULL "
                . "AND second_team_score IS NOT NULL "
                . "ORDER BY match_time DESC LIMIT 5";
        $prev_matches_at = qArray($sql2);
        //sort($prev_matches_at);

        $ht_prev_selections = count($client_obj->getTeamPreviousSelections($home_team_id));
        $at_prev_selections = count($client_obj->getTeamPreviousSelections($away_team_id));
        $total_selections = count($round_obj->getTournamentSelections());
//var_dump($total_selections);
//var_dump($ht_prev_selections);
//var_dump($at_prev_selections);
        if ($total_selections > 0) {
            $perc_home = ceil(($ht_prev_selections / $total_selections) * 100);
            $perc_away = ceil(($at_prev_selections / $total_selections) * 100);
        } else {
            $perc_home = 0;
            $perc_away = 0;
        }
        ?>
        <div class="panel panel-default" id="content">
            <div class="panel-body" style="font-size: 17px;">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="h3" style="color: blue">
                            Match Statistics
                            <div class="pull-right">
                                <button type="button" class="btn btn-default" onclick="window.location = 'matches.php'">BackToMatches</button>
                            </div>
                        </div>
                        
                        <hr/>
                        <div class="row">
                            <div class="col-lg-4 col-xs-6">
                                <div class="input-group btn btn-default btn-lg">
                                    <div class="pull-left"><?php echo $home_team['title']; ?></div>
                                    <span class="input-group-btn">
                                        <img width="48" height="36" src="team_logos/<?php echo $home_team['logo']; ?>">
                                    </span>
                                </div> 
                            </div>
                            <div class="col-lg-4 col-xs-6">
                                <div class=" input-group btn btn-default btn-lg">
                                    <span class="input-group-btn">
                                        <img width="48" height="36" src="team_logos/<?php echo $away_team['logo']; ?>">
                                    </span>
                                    <div class="pull-right"><?php echo $away_team['title']; ?></div>
                                </div> 
                            </div>
                        </div>
                        &nbsp;
                        <div class="row">
                            <div class="col-lg-4 col-xs-6">
                                Selected by:
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo$perc_home; ?>%">
                                        <?php echo $perc_home; ?>%</div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-6">
                                Selected by:
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $perc_away; ?>%">
                                        <?php echo $perc_away; ?>%</div>
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="row">
                            <div class="col-lg-4 col-xs-6">
                                <?php
                                echo '<p>Last (' . count($prev_matches_ht) . ') matches</p>';
                                foreach ($prev_matches_ht as $value_ht) {
                                    $match_winner = $client_obj->getMatchWinner($value_ht['match_id']);
                                    if ($match_winner == $home_team_id) {
                                        echo $symbol_win;
                                    } elseif ($match_winner == 0) {
                                        echo $symbol_draw;
                                    } else {
                                        echo $symbol_loss;
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-lg-4 col-xs-6">
                                <?php
                                echo '<p>Last (' . count($prev_matches_at) . ') matches</p>';
                                foreach ($prev_matches_at as $value_at) {
                                    $match_winner = $client_obj->getMatchWinner($value_at['match_id']);
                                    if ($match_winner == $away_team_id) {
                                        echo $symbol_win;
                                    } elseif ($match_winner == 0) {
                                        echo $symbol_draw;
                                    } else {
                                        echo $symbol_loss;
                                    }
                                }
                                ?>

                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
<!--                                <div class="h5">Premier League - Table Standings</div>-->
<!--                                <iframe width="390" height="520" frameborder="0" scrolling="no" src="http://fcstats.com/get-table,1,en.php"></iframe>-->
<!--                                <iframe width="230" height="520" frameborder="0" scrolling="no" src="http://fcstats.com/get-table-mini,1,en.php"></iframe>-->
<iframe src="http://www.tablesleague.com/iframe?width=520&height=650&font_name=Tahoma&position=1&font_size=12&games=1&wins=1&draws=1&lost=1&goals=1&goals_against=1&gd=1&points=1&next=1&form=1&font_size=12&font_color=000000&bg_color=FFFFFF&header_font_color=FFFFFF&header_bg_color=1fb9e4&bg_col=1fb9e4&font_color_col=FFFFFF&highlight=e3e3e3&hover=fff6bf&league=l_145" width="520" height=650 frameborder="0" scrolling="no"></iframe>
                                    <!--<iframe src="http://www.btfstats.com/widgets/leagues-table.php?name=England%3APremier+League&type=1" width="100%" height="900px" scrolling="no" frameBorder="0" ></iframe>-->
                            </div>
                        </div>
                        <hr/>
                     <!--   <div class="row">
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-default" onclick="window.location = 'matches.php'">BackToMatches</button>
                            </div>
                        </div>
                        -->
                    </div>
                    <?php
                } else {
                    echo('<script>location.href = "matches.php";</script>');
                }
                ?>
            </div>
        </div> 

        <?php
    } elseif (!isset($_SESSION['client_id']) || !isset($_SESSION['login_name']) || !isset($_SESSION['tournament_id'])) {
        echo '<script>location.href="matches.php";</script>';
    } else {
        ?>
        <div class="panel panel-default" id="content">
            <div class="panel-body" id="content" style="font-size: 17px;">
                <div class="row">
                    <?php
                    if (isset($_GET['action']) && $_GET['action'] == 'client_selection') {
                        $date = date('Y-m-d H:i:s');
                        $date_to_zone = getTimeConverted($date);
                        $dt = $date_to_zone->format('Y-m-d H:i:s');
                        $sql1 = "SELECT * FROM lms_rounds "
                                . "WHERE tournament_id = {$client_tournament_id} "
                                . "AND is_active = 1 "
                                . "AND is_closed = 0";

                        $round = qSingle($sql1);
                        //var_dump($round);
                        $round_id = $round['round_id'];
                        if (!empty($round) && $round['close_time'] < date('Y-m-d H:i:s')) {
                            //First game has started, Round closed
                            $msg = '<b>Entry closed. </b><br/>A new round & tournament will be created once the round is complete.';
                            FormBuilder::displayResponseModal('roundClosed', 'Round In Progress', $msg, $location);
                        } else {
                            $selected_match_id = ($_GET['match_id']) ? $_GET['match_id'] : 0;
                            $selected_team_id = ($_GET['team_id']) ? $_GET['team_id'] : 0;

                            if ($selected_match_id && $selected_team_id) {
                                $selected_match = $client_obj->getMatchDetails($selected_match_id);
                                $selected_team = $client_obj->getTeam($selected_team_id);
                                $cs_sql = "SELECT team_id FROM lms_client_selections "
                                        . "WHERE client_id = {$longin_client_id} "
                                        . "AND tournament_id = {$client_tournament_id}";
                                $count_selections = count(qArray($cs_sql));
                                //Check if client is not logged in
                                if (!$longin_client_id && !$client_tournament_id) {
                                    $message = "Your  are not logged in, Please login!";
                                    //FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', $message, $location);
                                    echo '<script type="text/javascript">$(function(){$("#clientLogin").modal("show");});</script>';
                                } elseif ($selected_match['has_started'] == 1) {
                                    //Match already started
                                    $message = "The match has already started";
                                    FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', $message, '');
                                } elseif ($client_obj->hasPlayedTeamInTournament($client_tournament_id, $longin_client_id, $selected_team_id) && $count_selections <= 20) {
                                    //Team already played
                                    $message = "You have already played this team in this tournament";
                                    FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', $message, '');
                                } elseif ($client_obj->hasMadeSelectionInRound($round_id, $client_tournament_id, $longin_client_id)) {
                                    //Already made a selection in this round 
                                    $message = "Your  have already made a selection in this round";
                                    FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', $message, $location);
                                } else {
                                    $array = array();
                                    $array['date_created'] = $dt;
                                    $array['client_id'] = $longin_client_id;
                                    $array['tournament_id'] = $client_tournament_id;
                                    $array['round_id'] = $round['round_id'];
                                    $array['is_auto'] = 0;
                                    if (isset($_POST['submit_win'])) {
                                        //If client selects Win option
                                        $selected_match_id = $_POST['selected_match_id'];
                                        $selected_team_id = $_POST['selected_team_id'];
                                        $array['match_id'] = $selected_match_id;
                                        $array['team_id'] = $selected_team_id;
                                        $array['with_draw'] = 0;
                                        //Save selection      
                                        $row_count = $client_obj->addClientSelection($array);
                                        //If selection submitted successfully
                                        if ($row_count > 0) {
                                            $message = "Your  have sucessfully submited your selection";
                                            FormBuilder::displayResponseModal('clientSelectionSubmitSuccess', 'Success', $message, $location);
                                            //Error occured while submitting selection
                                        } else {
                                            $message = "An error has occur, try again";
                                            FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', $message, $location);
                                        }
                                    } elseif (isset($_POST['submit_with_draw'])) {
                                        //If client selects Win or Draw option
                                        //Check if client has ever selected Win or Draw in this tournament
                                        $sql = "SELECT * FROM lms_client_selections "
                                                . "WHERE client_id = $longin_client_id "
                                                . "AND tournament_id = $client_tournament_id "
                                                . "AND with_draw = 1";

                                        $with_draw_status = qArray($sql);
                                        if (count($with_draw_status) > 0) {
                                            $message = "Your  have already selected <b>Win with Draw</b> in this tournament";
                                            //Client has ever selected Win or Draw option
                                            FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', $message, $location);
                                        } else {
                                            $selected_match_id = $_POST['selected_match_id'];
                                            $selected_team_id = $_POST['selected_team_id'];
                                            $array['match_id'] = $selected_match_id;
                                            $array['team_id'] = $selected_team_id;
                                            $array['with_draw'] = 1;
                                            //Save selection      
                                            $row_count = $client_obj->addClientSelection($array);
                                            //If selection submitted successfully
                                            if ($row_count > 0) {
                                                $message = "Your  have sucessfully submited your selection";
                                                FormBuilder::displayResponseModal('clientSelectionSubmitSuccess', 'Success', $message, $location);
                                                //Error occured while submitting selection
                                            } else {
                                                $message = "An error has occur, try again";
                                                FormBuilder::displayResponseModal('clientSelectionSubmitError', 'Error', $message, $location);
                                            }
                                        }
                                    }
                                }
                           
                        ?>
                        <div class="col-xs-12" style="font-size: 24px;">
                            <div class="h3" style="color: blue">
                                Team Selection
                            </div>
                            <hr/>
                            <?php if ($message): ?>
                                <div class="alert alert-warning">
                                    <?php echo $message; ?>
                                </div>
                            <?php endif; ?>
                            <div class="row-fluid">
                                <form class="form-horizontal" role="form" method="post" action="">
                                    <div class="form-group">
                                        <div class="col-lg-8" align="center">
                                            You have selected <strong style="color: red;"><?php echo $selected_team['title']; ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-8" align="center">
                                            <strong><?php echo $selected_match['first_team_title'] . ' vs ' . $selected_match['second_team_title']; ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-8" align="center">
                                            <?php echo '(' . date_format(date_create($selected_match['match_time']), 'jS M Y H:i') . ')'; ?>
                                            <input type="hidden" name="selected_match_id" value="<?php echo $selected_match_id; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-2">
                                            <button type="button" class="btn btn-default" onclick="window.location = 'matches.php<?php //echo $current_url;                   ?>'">BackToMatches</button>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="hidden" name="selected_team_id" value="<?php echo $selected_team_id; ?>">
                                            <input type="submit" class="btn btn-success btn-block" name="submit_win" value="WIN">
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="submit" class="btn btn-primary btn-block" name="submit_with_draw" value="WIN or DRAW">
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="form-group">
                                        <div class="col-xs-offset-1 col-lg-7">
                                            <div align="center">
                                                For one round ONLY you can select Win or Draw. 
                                                This means that if you pick Team A with Win or Draw and Team A wins or draws then you are through to the next round!
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                         }
                        }
                    }else {
                        echo('<script>location.href = "matches.php";</script>');
                    }
                }
                ?>
            </div>
        </div>         
        <?php require_once 'footer.php'; ?>