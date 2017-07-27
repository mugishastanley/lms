<?php
require 'conts.php';
include_once 'classes/DatabaseClass.php';
include_once 'classes/ClientClass.php';
//spl_autoload_register(function ($class_name) {
//    require_once("classes/{$class_name}.php");
//});
$current_url = basename($_SERVER['PHP_SELF']); //Get the URL of the current page
$client_obj = new ClientClass();

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/themes/smoothness/jquery-ui.css" type="text/css" rel="stylesheet">
        <link href="assets/css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script> 
        <title>BetWay-LMS</title>
        <style>
            body {
                padding-top: 55px;
                height: auto; 
                background-image: url('<?= IMAGES_DIR ?>background.jpg'); 
                background-repeat: no-repeat; 
                background-size: 100%;
            }
        </style>
    </head>
    <body>
        <nav class="navbar  navbar-default navbar-fixed-top" role="navigation" style="background-color: #EE8C00; margin-top: 0;">
            <div class="container" style="background-color: #EE8C00;">
                <div class="navbar-header" style="padding: 1%;">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">BetWay-LMS</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav nav-tabs">
                        <li <?php echo ($current_url == 'index.php') ? 'class="active"' : ''; ?> style="padding: 1%;">
                            <a href="index.php" style="color: black;">
                                <?php echo FormBuilder::addImage(IMAGES_DIR . 'home.png', '30', '30'); ?>
                                &nbsp; Home
                            </a>
                        </li>
                        <li <?php echo ($current_url == 'matches.php') ? 'class="active"' : ''; ?> style="padding: 1%;">
                            <a href="matches.php" style="color: black;">
                                <?php echo FormBuilder::addImage(IMAGES_DIR . 'trophy.png', '30', '30'); ?>
                                &nbsp;Matches
                            </a>
                        </li>
                        <li <?php echo ($current_url == 'results.php') ? 'class="active"' : ''; ?> style="padding: 1%;">
                            <a href="results.php" style="color: black;">
                                <?php echo FormBuilder::addImage(IMAGES_DIR . 'ball.png', '30', '30'); ?>
                                Results
                            </a>
                        </li>
                        <li <?php echo ($current_url == 'how_to_play.php') ? 'class="active"' : ''; ?> style="padding: 1%;">
                            <a href="how_to_play.php" style="color: black;">
                                <?php echo FormBuilder::addImage(IMAGES_DIR . 'rules1.png', '30', '30'); ?>
                                Rules
                            </a>
                        </li>

                        <?php if (isset($_SESSION['client_id']) && isset($_SESSION['tournament_id'])) { ?>
                            <li <?php echo ($current_url == 'account.php') ? 'class="pull-right active"' : 'class="pull-right"'; ?> style="padding: 1%;">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: black;">
                                    <?php echo FormBuilder::addImage(IMAGES_DIR . 'account.png', '30', '30'); ?>
                                    &nbsp;<?php echo 'Account'; //Supposed to be the name of the client             ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="account.php" style="color: black;">
                                            <?php echo FormBuilder::addImage(IMAGES_DIR . 'dashboard.png', '30', '30'); ?>
                                            &nbsp;<?php echo 'Profile'; //Supposed to be the name of the client             ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="logout.php" class="">
                                            <?php echo FormBuilder::addImage(IMAGES_DIR . 'login.png', '30', '30'); ?>&nbsp;
                                            Logout
                                        </a> 
                                    </li>
                                </ul>
                            </li>

                        <?php } else { ?>  
                            <li class="pull-right" style="padding: 1%;">
                                <button type="button" class="btn btn-info" onclick="window.location = 'signup.php';">
                                    <i class=" glyphicon glyphicon-user"></i>
                                    Sign up
                                </button>
                            </li>
                            <li class="pull-right" style="padding: 1%;">
                                <button data-toggle="modal" data-target="#clientLogin" style="color: black;">
                                    <?php echo FormBuilder::addImage(IMAGES_DIR . 'login.png', '30', '30'); ?>
                                    Login
                                </button>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="modal fade" id="clientLogin" role="dialog" tabindex="-1" data-backdrop="static" align="center" style="margin-top: 10%; position: absolute;">
            <div class="modal-dialog">
                <div class=" modal-content">
                    <form class="form-horizontal" role="form" method="post" action="">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="//window.location='<?php //echo $current_url;        ?>';">
                                &times;
                            </button>
                            <h3><?php echo FormBuilder::addImage(IMAGES_DIR . 'login.png', '30', '30'); ?> &nbsp;Client Login</h3>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group col-lg-6">
                                    <span class="input-group-addon">Username</span>
                                    <input class="form-control input-lg" type="text" name="login_name" id="login_name" placeholder="Enter Username" required> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group col-lg-6">
                                    <span class="input-group-addon">Password</span>
                                    <input class="form-control input-lg" type="password" name="login_hash" id="login_hash" placeholder="Enter Password" required> 
                                </div>
                            </div>
                            <div class="row">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="col-xs-offset-3 col-lg-6" align="center">
                                <button type="submit" class="btn btn-primary btn-block" name="login_submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container" style="margin-top: 1.5%;">
                <?php
                //pageLoadDelay();
                if (isset($_POST['login_submit'])) {
                    //If login button is clicked
                    $login_name = filter_input(INPUT_POST, 'login_name', FILTER_SANITIZE_STRING);
                    $login_hash = filter_input(INPUT_POST, 'login_hash', FILTER_SANITIZE_STRING);
                    
                    $login_hash = md5($login_hash);
                    //Check if serial and card number combination exist
                    $sql = "SELECT * FROM lms_clients "
                            . "WHERE login_name = '{$login_name}' "
                            . "AND login_hash = '{$login_hash}' "
                            . "AND is_active = 1";
                            
                    $client = qSingle($sql);
                    
                    //var_dump($client);
                    //Get all tournaments attached to this card if its a valid card
                    if (!empty($client)) {
                     //Client found
                        $client_id = $client['client_id'];
                        //Set session variable
                        $_SESSION['client_id'] = $client_id;
                        $_SESSION['login_name'] = $client['login_name'];
                        //Get tournaments for this client
                        $tournaments = $client_obj->getClientTournaments($client_id);
                        //If there are tournaments for this client, 
                        //display a modal with dropdown of the tournaments to select from
                        if (count($tournaments) > 0) {
                            echo '<script type="text/javascript">$(function(){$("#clientTournamentSelection").modal("show");});</script>';
                            $modal = '<div class="modal fade" id="clientTournamentSelection" role="dialog" align="center" style="margin-top: 10%; position: absolute;">
                                        <div class="modal-dialog"> 
                                           <div class=" modal-content">
                                            <form class="form-horizontal" role="form" method="post" action="">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="window.location=\'' . $current_url . '\';">
                                                        &times;
                                                    </button>
                                                    <h4>Choose Tournament</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                            <label class="col-lg-2">Tournament</label>
                                                            <div class="col-lg-6">
                                                                <select class="form-control" name="tournament_id" required>
                                                                    <option value="">Select...</option>';
                                                        foreach ($tournaments as $tournament) {
                                                            $modal .= '<option value="' . $tournament['tournament_id'] . '">' . $tournament['title'] . '</option>';
                                                        }
                                                        $modal .= '</select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="form-group">
                                                            <div class="col-xs-offset-3 col-lg-4">
                                                                <button type="submit" class="btn btn-primary btn-block" name="login_submit_tounament">Continue</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>';
                            echo $modal;
                        } else { //Otherwise, the client has no tournaments
                            //Clear session variables first
                            $_SESSION['client_id'] = '';
                            $_SESSION['login_name'] = '';
                            
                            echo '<script type="text/javascript">$(function(){$("#clientLoginNoTournament").modal("show");});</script>';
                            echo '<div class="modal fade" id="clientLoginNoTournament" role="dialog" align="center" style="margin-top: 10%; position: absolute;">
                                <div class="modal-dialog"> 
                                <div class=" modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h4>Error</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4>You are not registered to any tournaments, contact administrator for help</h4>
                                    </div>
                                </div>
                                </div>
                            </div>';
                        }
                    //Otherwise, no client matches the supplied 
                    //username and password combination
                    } else {
                        $signup_link = "window.location='signup.php'";
                        echo '<script type="text/javascript">$(function(){$("#clientLoginFailure").modal("show");});</script>';
                        echo '<div class="modal fade" id="clientLoginFailure" role="dialog" align="center" style="margin-top: 10%; position: absolute;">
                                <div class="modal-dialog">                                
                                <div class=" modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h4>Error</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4>You either do not have an account yet <br/>or <br/><strong>Invalid Username or Password entered</strong>,<br/>please try again or <button class="btn-link" onclick="'.$signup_link.'">signup</button> for a new account</h4>
                                    </div>
                                </div>
                                </div>
                            </div>';
                    }
                }
                
//If tournament selected and submitted
if (isset($_POST['login_submit_tounament'])) {
    $client_selected_tournament_id = $_POST['tournament_id'];
    //Set Session variable for tournament
    $_SESSION['tournament_id'] = $client_selected_tournament_id;
    //echo("<script>location.href = '" . $current_url . "';</script>");
    echo("<script>location.href = 'history.php';</script>");
}

$longin_client_id = isset($_SESSION['client_id']) ? $_SESSION['client_id'] : '';
//$longin_card_id = isset($_SESSION['card_id']) ? $_SESSION['card_id'] : '';
$client_tournament_id = isset($_SESSION['tournament_id']) ? $_SESSION['tournament_id'] : '';

?>
  