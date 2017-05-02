<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 5/1/2017
 * Time: 6:55 PM
 */

require_once("sqlDatabase.php");
require_once("gettingData.php");
require_once("lib.inc.php");

session_start();

if(isset($_POST['rpt_courseName']) && isset($_POST['sections'])){
    $report = new report();
    $result = $dbconn1->showReport($_POST['rpt_courseName'],$_POST['sections']);

    echo $result;
}elseif(isset($_POST["rpt_cid"]) && isset($_POST["rpt_tid"])){
    $myData = new gettingData();
    //$result = $myData->getRptSections($_POST["rpt_cid"]);
    $result = $myData->getSections($_POST["rpt_cid"],$_POST["rpt_tid"] );

    echo $result;
}elseif(isset($_POST["rpt_pid"])){
    $myData = new gettingData();
    $result = $myData->getRptClasses($_POST["rpt_pid"]);

    echo $result;
}elseif(isset($_POST["rpt_cid"])){
    $myData = new gettingData();
    //$result = $myData->getRptSections($_POST["rpt_cid"]);
    $result = $myData->getTerms($_POST["rpt_cid"]);

    echo $result;
}


?>