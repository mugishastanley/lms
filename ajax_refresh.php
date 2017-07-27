<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'classes/MatchClass.php';

$match_obj = new MatchClass();

$keyword = '%'.$_POST['keyword'].'%';
$list = $match_obj->getCountries();
foreach ($list as $rs) {
	// put in bold the written text
	$title = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['title']);
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['title']).'\')" value="'.$rs['country_id'].'">'.$title.'</li>';
}
