<?php
require './inc/php/lib.inc.php';
include("./inc/php/saveToDB.php");

session_start();

if (!array_key_exists('loggedIn', $_COOKIE)) {
    session_destroy();
} else {
    $expire = time() + 60 * 10;//10 minutes from now
    $path = "/";
    $domain = "team-pascal.ist.rit.edu";
    $secure = false;
    $value = date("F j, Y g:i a");
    $value = mt_rand() . mt_rand() . mt_rand();
    setcookie("loggedIn", $value, $expire, $path, $domain, $secure);
}

buildHeader("Home | Course Assessment System");
?>
<header>
    <div>
        <h1 class="logo">Course Assessment System</h1>
    </div>
</header>

<?php
if (array_key_exists('role_id', $_SESSION)) {
    buildNav($_SESSION['role_id']);
} else {
    buildNav(5);
}
?>

<?php
	if (isset($_POST['gradesBTN'])) {
		$courseInfo = $_POST['courseID'];
        $grades = $_POST['grades'];
        $dbconn1 = new addCourse();
        $dbconn1->enterGrade($courseInfo, $_SESSION['user_id'], $currentTerm, $grades);
    }
?>

<div id="content">
    <?php
    if (isset($_SESSION['loggedIn'])) {
        $getData = new gettingData();
		$getData->displayCourseAssessment($_SESSION['user_id'], $currentTerm);
        $getData->getViews($_SESSION['role_id']);
        echo "<div id=\"home-content\"></div>";
    } else {
        echo "
      <div id=\"container-login\">
        <h3>System Login</h3>
        <hr>";
        if (array_key_exists('invalidLogin', $_SESSION)) {
            echo $_SESSION['invalidLogin'] . "</hr>";
        }
        echo "
     <form method=\"post\" action='./inc/php/login.php'>
            <p>
              <label><b>Username</b></label>
              <input type=\"text\" name=\"username\" placeholder=\"Username\" class=\"form-control log-in\" />
            </p>
            <p>
              <label><b>Password</b></label>
              <input type=\"password\" name=\"pass\" placeholder=\"Password\" class=\"form-control log-in\" />
            </p>


            <input class=\"btn btn-success\" type=\"submit\" name=\"login\" value=\"Login\">

             </form>
      </div>";
    }
    ?>
    <div id="clear"></div>
</div>

<?php buildFooter(); ?>

</body>
</html>
