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


buildHeader("Settings | Course Assessment System");
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

<div id="content">
    <div class="tabPg">
        <a href="javascript:void(0)" class="tabs active" onclick="openTab(event, 'change_password')">Change Password</a>
    </div>

    <!--********************************************-->
    <!--              CHANGE PASSWORD               -->
    <!--********************************************-->

    <div id="change_password" class="tabcontent">

        <?php

        /*
   * Change Password
   */
        if (isset($_POST['chane_passwordSelectBtn'])) {
            if ((strcmp($_POST['change_confirmPassword'], $_POST['change_password']) == 0)) {

                if (!empty($_POST["change_password"])) {
                    $change_password = sanitize($_POST["change_password"]);
                }

                try {
                    $dbh = new PDO(DBC, DBUser, DBPassword);

                    $stmt = $dbh->prepare("UPDATE program_user SET user_password = :password WHERE user_id = :uid");
                    $stmt->bindParam(":password", $change_password, PDO::PARAM_STR);
                    $stmt->bindParam(":uid", $_SESSION['user_id'], PDO::PARAM_INT);
                    $stmt->execute();

                    $_SESSION['PasswordChanged'] = "<h2>Password Changed</h2>";

                } catch (PDOEXception $e) {
                    echo $e->getMessage();
                }
            }
        }


        if (isset($_SESSION['PasswordChanged'])) {
            echo "<h2>Password Changed</h2>";
            unset($_SESSION['PasswordChanged']);
        }


        unset($_SESSION['PasswordChanged']);

        try {
            $dbh = new PDO(DBC, DBUser, DBPassword);
            $sqlStatement = "SELECT * FROM program_user WHERE user_id = :uid";
            $stmt = $dbh->prepare($sqlStatement);
            $stmt->bindParam(":uid", $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


        ?>


        <form method="post" action="settings.php">

            <label for="change_password">Password
                <input name="change_password" type="text" class="form-control" id="change_password"/>
            </label>

            <label for="change_confirmPassword">Confirm Password
                <input name="change_confirmPassword" type="text" class="form-control" id="change_confirmPassword"/>
            </label>

            <br/>
            <button class="btn btn-success" name="chane_passwordSelectBtn" id="editAccId">Change Password</button>
        </form>
        <div style="clear: both;"></div>
    </div>
    <script>
        document.getElementById('edit_role').value = document.getElementById('role-sel-val').value;
        document.getElementById('item-to-edit').value = document.getElementById('current-edit').value;
    </script>


</div>


<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="inc/js/jquery.inputfile.js"></script>
<script>
    $(document).ready(function () {
        openTab(event, 'change_password');
        $('.tabPg').find('a').first().addClass('active');
    });
</script>

<?php buildFooter(); ?>

</body>
</html>
