<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 4/30/2017
 * Time: 1:21 PM
 */
define ("DBC",'mysql:dbname=pascal_final_db;host=127.0.0.1');
define ("DBUser",'pascal_web');
define ("DBPassword",'fr1end');
try {
    $dbh = new PDO(DBC, DBUser, DBPassword);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

session_start();

if (isset($_SESSION['loggedIn'])) {
    header("Location: /");
    //header("Location: /~speedyman11/srdev2/");
}
$_GET['REFERER'] = $_SERVER['HTTP_REFERER'];
if (isset($_POST['username']) & isset($_POST['pass'])) {

    $sqlStatement = "SELECT username,user_password,role_id,first_name,last_name FROM program_user WHERE username = :user";
    $stmt = $dbh->prepare($sqlStatement);
    $stmt->bindParam(":user", $_POST['username'], PDO::PARAM_STR);
    $stmt->execute() or die(print_r($stmt->errorInfo(), true));
    $stmt->rowCount();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($stmt->rowCount() == 1) {

        $passtocomp = $_POST['username'] . $_POST['pass'];
        $passtocomp = sha1($passtocomp);
        if ($result['0']->user_password == $_POST['pass']) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['role_id'] = $result['0']->role_id;
            $_SESSION['first_name'] = $result['0']->first_name;
            $_SESSION['last_name'] = $result['0']->last_name;

            $expire = time() + 60 * 10;//10 minutes from now
            //Deployment
            $path = "/";
            $domain = "team-pascal.ist.rit.edu";
            //Testing
//            $path = "/~speedyman11/srdev2/";
//            $domain = "172.110.20.237";
            $secure = false;
            $value = date("F j, Y g:i a");
            $value = mt_rand() . mt_rand() . mt_rand();
            // make sure nothing is output from script even a blank line, before the php tags
            setcookie("loggedIn", $value, $expire, $path, $domain, $secure);

            header("Location: /");
           // header("Location: /~speedyman11/srdev2/");




        }else {
            $_SESSION['invalidLogin'] = "<h3 style='color:red;'>Invalid Login</h3>";
            header("Location: /");
            //header("Location: /~speedyman11/srdev2/");
        }
    } else {
        $_SESSION['invalidLogin'] = "<h3 style='color:red;'>Invalid Login</h3>";
        header("Location: /");
        //header("Location: /~speedyman11/srdev2/");
    }


}
header("Location: /");
//header("Location: /~speedyman11/srdev2/");

?>