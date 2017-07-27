<?php
require_once 'header.php';
spl_autoload_register(function ($class_name) {
    require_once("classes/{$class_name}.php");
});
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$validator_obj = new Validator();
$client_obj = new ClientClass();

$err = '';
$message = '';
$label_class = "control-label col-lg-2 col-xs-4";
$input_control_class = "col-lg-4 col-xs-8";

if (isset($_POST['submit_client'])) {
    $array = array();
    //$client_id = (int) $_POST['client_id'];
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    if (checkExists('lms_clients', 'phone', $phone)) {
        $err .= "Phone already exist<br/>";
    } elseif ($validator_obj->notValidPhoneNumber($phone)) {
        $err .= "Only digits allowed for Phone<br/>";
    } else {
        $array['phone'] = $phone;
    }

    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
    if ($validator_obj->notAlphabetic($fname)) {
        $err .= "Only letters allowed First Name<br/>";
    } else {
        $array['fname'] = $fname;
    }

    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
    if ($validator_obj->notAlphabetic($lname)) {
        $err .= "Only letters allowed Last Name<br/>";
    } else {
        $array['lname'] = $lname;
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err .= "Enter a valid email<br/>";
    } elseif (checkExists('lms_clients', 'email', $email)) {
        $err .= "E-mail already exist<br/>";
    } else {
        $array['email'] = $email;
    }
    //Validate username
    $uname = filter_input(INPUT_POST, 'login_name', FILTER_SANITIZE_STRING);
    if (checkExists('lms_clients', 'login_name', $uname)) {
        $err .= "Username <b> {$uname} </b> already taken<br/>";
    } elseif ($validator_obj->notAlphabetic($uname)) {
        $err .= "Username will contain alphabetic letters only<br/>";
    } elseif ($validator_obj->notMinStringLength($uname, MIN_USERNAME_LENGTH)) {
        $err .= "Minimum " . MIN_USERNAME_LENGTH . " characters allowed for Username<br/>";
    } else {
        $array['login_name'] = $uname;
    }
    //Validate password
    $pass = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
    $pass2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);
    if ($validator_obj->notMinStringLength($pass, MIN_PASSWORD_LENGTH)) {
        $err .= "Minimum " . MIN_PASSWORD_LENGTH . " characters allowed for Password<br/>";
    } elseif ($validator_obj->passwordMismatch($pass, $pass2)) {
        $err .= "Passwords don't match<br/>";
    } else {
        $array['login_hash'] = $password = md5($pass);
    }
    $array['address'] = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

    if (!$err) { //Validation pass
        //Insert new client
        $count = $client_obj->addClient($array);
        if ($count > 0) {
            $message .= "New client added<br/>";
            echo("<script>location.href = '" . HTTP_ROOT . "matches.php';</script>");
        } else {
            $err .= "Attempt to add client failed<br/>";
        }
    }
}
?>
 <div class="panel panel-default" id="content" style="//display: none;">
<div class="panel-body">
    <div class="row">
        <div class="modal-content">
            <form class="form-horizontal" role="form" method="post" action="">
                <div class=" modal-header">
                    <h4>Create Account</h4>
                </div>
                <div class=" modal-body">
                    <?php if ($err) { ?>
                        <div class="alert alert-warning">
                            <?php echo $err; ?>
                        </div>
                    <?php } ?>
                    <?php if ($message) { ?>
                        <div class="alert alert-success">
                            <?php echo $message. "<script>setTimeout(function(){window.location.href='" . HTTP_ROOT . "matches.php'},2000);</script>"; ?>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="<?php echo $label_class; ?>">First Name</label>
                        <div class="<?php echo $input_control_class; ?>">
                            <input type="text" name="fname" class="form-control input-sm" value="<?php echo (!empty($_POST['fname'])) ? $_POST['fname'] : ''; ?>" required>
                        </div>    
                        <input type="hidden" class="form-control" name="client_id" value=""> 
                    </div>
                    <div class="form-group">
                        <label class="<?php echo $label_class; ?>">Last Name</label>
                        <div class="<?php echo $input_control_class; ?>">
                            <input type="text" name="lname" class="form-control input-sm" value="<?php echo (!empty($_POST['lname'])) ? $_POST['lname'] : ''; ?>" required>
                        </div>             
                    </div>
                    <div class="form-group">
                        <label class="<?php echo $label_class; ?>">Phone</label>
                        <div class="<?php echo $input_control_class; ?>">
                            <input type="text" name="phone" class="form-control input-sm" value="<?php echo (!empty($_POST['phone'])) ? $_POST['phone'] : ''; ?>" required placeholder="Format: 07########">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="<?php echo $label_class; ?>">E-mail</label>
                        <div class="<?php echo $input_control_class; ?>">
                            <input type="text" name="email" class="form-control input-sm" value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="<?php echo $label_class; ?>">Address</label>
                        <div class="<?php echo $input_control_class; ?>">
                            <input type="text" name="address" class="form-control input-sm" value="<?php echo (!empty($_POST['address'])) ? $_POST['address'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="<?php echo $label_class; ?>">Username</label>
                        <div class="<?php echo $input_control_class; ?>">
                            <input type="text" name="login_name" class="form-control input-sm" value="<?php echo (!empty($_POST['login_name'])) ? $_POST['login_name'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="<?php echo $label_class; ?>">Password</label>
                        <div class="<?php echo $input_control_class; ?>">
                            <input type="password" name="password1" class="form-control input-sm" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="<?php echo $label_class; ?>">Confirm Password</label>
                        <div class="<?php echo $input_control_class; ?>">
                            <input type="password" name="password2" class="form-control input-sm" required>
                        </div>
                    </div>
                </div>
                <div class=" modal-footer">
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-lg-4 col-xs-9">
                            <button type="submit" class="btn btn-primary btn-block btn-sm" name="submit_client">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>