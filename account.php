<?php
include_once 'header.php';
spl_autoload_register(function ($class_name) {
    include_once("classes/{$class_name}.php");
});

if (!isset($_SESSION['client_id']) || !isset($_SESSION['login_name']) || !isset($_SESSION['tournament_id'])) {
    echo '<script>location.href="index.php";</script>';
} else {

    $err = '';

    $msg = '';

    $validator_obj = new Validator();

    $client_obj = new ClientClass();

    $tournament_obj = new TournamentClass();

    $client_info = $client_obj->getClient($longin_client_id);

    $tournament_info = $tournament_obj->getTournament($client_tournament_id);

    $total_registered_clients = count($client_obj->getRegisteredClients($client_tournament_id));

    $total_clients_remaining = count($client_obj->getRemainingClients($client_tournament_id));

    $registered_tournaments = $client_obj->getClientTournaments($longin_client_id);
    ?>
 <div class="panel panel-default" id="content" style="//display: none;">
    <div class="panel-body">
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
                            <li role="presentation">
                                <a href="history.php">History</a>
                            </li>
                            <li role="presentation" class="active">
                                <a href="account.php">Account</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
                <div class="row-fluid">
                    <ul class="nav nav-tabs">
                        <li class="<?php echo (isset($_POST['submit_new_password'])) ? '' : 'active'; ?>">
                            <a href="#accountInfo" data-toggle="tab">Profile</a>
                        </li>
                        <li class="<?php echo (isset($_POST['submit_new_password'])) ? 'active' : ''; ?>">
                            <a href="#changePassword" data-toggle="tab">Change Password</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in <?php echo (isset($_POST['submit_new_password'])) ? '' : 'active'; ?>" id="accountInfo">
                            <div class="row row-fluid">
                                <div class="h3">Basic Details</div>
                                <table class="table-condensed">
                                    <tr>
                                        <td><strong>Name:</strong></td>
                                        <td><?php echo $client_info['fname'] . ' ' . $client_info['lname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone:</strong></td>
                                        <td><?php echo $client_info['phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>E-mail:</strong></td>
                                        <td><?php echo $client_info['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address:</strong></td>
                                        <td><?php echo $client_info['address']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Username:</strong></td>
                                        <td><?php echo $client_info['login_name']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <hr/>
                            <div class="row-fluid">
                                <div class="h3">My Tournaments</div>
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Registered</th>
                                            <th>Remaining</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $tournament_info['title']; ?></td>
                                            <td><?php echo $total_registered_clients; ?></td>
                                            <td><?php echo $total_clients_remaining; ?></td>
                                        </tr>
                                        <?php
                                        foreach ($registered_tournaments as $registered_tournament) {
                                            if ($registered_tournament['tournament_id'] != $tournament_info['tournament_id']) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $registered_tournament['title']; ?></td>
                                                    <td><?php echo count($client_obj->getRegisteredClients($registered_tournament['tournament_id'])); ?></td>
                                                    <td><?php echo count($client_obj->getRemainingClients($registered_tournament['tournament_id'])); ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                        <div class="tab-pane fade in <?php echo (isset($_POST['submit_new_password'])) ? 'active' : ''; ?>" id="changePassword">
                            <?php
                            if (isset($_POST['submit_new_password'])) {

                                $current_pass = $client_info['login_hash'];
                                $client_id = $client_info['client_id'];

                                //Validate password
                                $pass = filter_var($_POST['current_password'], FILTER_SANITIZE_STRING);
                                $pass = md5($pass);
                                $pass1 = filter_var($_POST['password1'], FILTER_SANITIZE_STRING);
                                $pass2 = filter_var($_POST['password2'], FILTER_SANITIZE_STRING);
                                if ($pass != $current_pass) {
                                    $err .= "The Current Password does not match with the available password<br/>";
                                } elseif ($validator_obj->notMinStringLength($pass1, MIN_PASSWORD_LENGTH)) {
                                    $err .= "Minimum " . MIN_PASSWORD_LENGTH . " characters allowed for Password<br/>";
                                } elseif ($validator_obj->passwordMismatch($pass1, $pass2)) {
                                    $err .= "Passwords don't match<br/>";
                                } else {
                                    $password = md5($pass1);
                                }

                                if (!$err) {
                                    $sql = "UPDATE lms_clients SET "
                                            . "login_hash = '{$password}' "
                                            . "WHERE client_id = {$client_id}";

                                    $count = qExe($sql);
                                    if ($count > 0) {
                                        $msg .= "Password changed successfully<br/>";
                                        //Unset session variables and destroy session
                                        unset($_SESSION['client_id']);
                                        unset($_SESSION['login_name']);
                                        unset($_SESSION['tournament_id']);
                                        session_destroy();
                                        //Prompt for login again to confim password change
                                        echo '<script type="text/javascript">$(function(){$("#clientLogin").modal("show");});</script>';
                                    } else {
                                        $err .= "Error occured while trying to change password, contact administrator for help<br/>";
                                    }
                                }
                            }
                            ?>
                            <div class="h3">Change Password</div>
                            <hr/>
                            <?php if ($err) { ?>
                                <div class="alert alert-warning">
                                    <?php echo $err; ?>
                                </div>
                            <?php } ?>
                            <?php if ($msg) { ?>
                                <div class="alert alert-success">
                                    <?php echo $msg; ?>
                                </div>
                            <?php } ?>
                            <form class="form-horizontal" method="post" action="">
                                <div class="form-group">
                                    <label class="col-lg-3">Current Password</label>
                                    <div class="col-lg-4">
                                        <input type="password" class="form-control input-sm" name="current_password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3">New Password</label>
                                    <div class="col-lg-4">
                                        <input type="password" class="form-control input-sm" name="password1" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3">Confirm New Password</label>
                                    <div class="col-lg-4">
                                        <input type="password" class="form-control input-sm" name="password2" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-4 col-lg-3">
                                        <button type="submit" class="btn btn-primary btn-block" name="submit_new_password">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
require_once 'footer.php';
?>