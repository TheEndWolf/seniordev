<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 4/30/2017
 * Time: 11:50 PM
 */

session_start();
session_destroy();
header("Location: /");

?>