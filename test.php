<?php
require_once 'header.php';
require_once 'classes/FormBuilder.php';
require_once 'classes/UserClass.php';
$user_obj = new UserClass();
$err = '';
$message = '';
$location = "window.location='$current_url'";

$start_date = '2016-02-13 18:15:00';
$date = strtotime($start_date);
$remaining = $date - time();
$remaining_days = floor($remaining/86400);
$remaining = $remaining%86400;
$remaining_hours = floor($remaining/ 3600);
$remaining = $remaining%3600;
$remaining_minutes = floor($remaining/60);
$remaining_seconds = $remaining%60;

if (isset($_POST['back_up'])){
    $user_obj->backupTables("lms", "*", "docs");
}




?>
 <div class="panel panel-default" id="content" style="//display: none;">
<div class="panel-body" style="margin-top: 5%;">
    <h1 class="bg-primary">Owor Yoakim</h1>
    <form class="form-horizontal" method="post" action="">
        <hr />
        <div class="row">
            <div class="col-xs-2">
                <input type="hidden" name="choice_id" value="">
                <button type="submit" class="btn btn-default">
                    <img width="144" height="108" src="images/owor.jpg">
                </button>
            </div>
            <div class="col-xs-10">
                <h3>Owor Yoakim</h3>
                <?php echo 'Days: '.$remaining_days.'<br/>Hours: '.$remaining_hours.'<br/>Minutes: '.$remaining_minutes.'<br/>Seconds: '.$remaining_seconds; ?>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-xs-2">
                <button type="submit" class="btn btn-default" name="back_up">BackUp Data</button>
            </div>
            <div class="col-xs-10">
                <?php 
                /*
                $time = date('Y-m-d H:i:s');
//                $date = new DateTime($time, new DateTimeZone('America/New_York'));
//                echo $date->format('Y-m-d H:i:s') . "<br/>";
//
//                $date->setTimezone(new DateTimeZone('Africa/Kampala'));
//                echo $date->format('Y-m-d H:i:s') . "\n";
//                //$date = date_create($time, timezone_open('Africa/Kampala'));
//                
//                //echo date_format($date, 'Y-m-d H:i:s') . "\n";
                $date = getTimeConverted($time);
                echo $date->format('Y-m-d H:i:s').'<br/>';
                 * 
                 */
                
                ?>
            </div>
        </div>
    </form>
</div>
<?php require_once 'footer.php'; ?>

