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


if(isset($_POST["rpt_cid"])){
    $myData = new gettingData();
    $result = $myData->getRptSections($_POST["rpt_cid"]);

    echo $result;
}


?>