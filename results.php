<?php
require_once 'header.php';

spl_autoload_register(function ($class_name) {
    require_once("classes/{$class_name}.php");
});

$match_obj = new MatchClass();

$page = isset($_GET['page']) ? $_GET['page'] : 1; //Get the Current Page
$per_page = 10;
$page_url = "results.php?";
$num_rows = count($match_obj->getStartedMatches());

$pagination = new Pagination($page, $per_page, $num_rows);
$limit = $pagination->per_page;
$offset = $pagination->offset();

$matches = $match_obj->getStartedMatches($limit, $offset);
//ksort($matches);
?>
 <div class="panel panel-default" id="content" style="//display: none;">
<div class="panel-body" id="content">
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
            <div class="well">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation">
                        <a href="matches.php">Matches</a>
                    </li>
                    <li role="presentation" class="active">
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
                <table class="table table-condensed table-responsive">
                    <thead>
                        <tr class="bg-danger">
                            <td colspan="3">
                                Results
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(is_array($matches)){
                        foreach ($matches as $match) { 
                            ?>
                            <tr>
                                <td>
                                    <div class="input-group btn btn-default">
                                        <div class="pull-left">
                                            <?php echo $match['first_team_title']; ?>
                                        </div>
                                        <span class="input-group-btn">
                                            <img width="48" height="36" src="team_logos/<?php echo $match['first_team_logo']; ?>">
                                        </span>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div>
                                        <div align="center" style="//height: 15px;">
                                            <strong>
                                                <?php echo $match['first_team_score'] . ' - ' . $match['second_team_score']; ?>
                                            </strong>
                                        </div>
                                        <br /> 
                                        <div align="center">
                                            <?php echo date_format(date_create($match['match_time']), 'd M y H:i'); ?> 
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group btn btn-default">
                                        <span class="input-group-btn">
                                            <img width="48" height="36" src="team_logos/<?php echo $match['second_team_logo']; ?>">
                                        </span>
                                        <div class="pull-right">
                                            <?php echo $match['second_team_title']; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } }// end loop   ?>
                    </tbody>
                    <tfoot>
                        <tr class="">
                            <td colspan="3" align="center">
                                <?php echo $pagination->buildPagination($page_url); ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

    <?php require_once 'footer.php'; ?>
