
<?php
require './inc/php/lib.inc.php';
include("./inc/php/saveToDB.php");

session_start();

if(!array_key_exists('loggedIn', $_COOKIE)){
    session_destroy();
    //header("Location: /");
}else{
    $expire = time() + 60 * 10;//10 minutes from now
    //Deployment
    $path = "/";
    $domain = "team-pascal.ist.rit.edu";
    //Testing
//        $path = "/~speedyman11/srdev2/";
//        $domain = "172.110.20.237";
    $secure = false;
    $value = date("F j, Y g:i a");
    $value = mt_rand() . mt_rand() . mt_rand();
    setcookie("loggedIn", $value, $expire, $path, $domain, $secure);



}


buildHeader("Admin | Course Assessment System");
?>
    <header>
      <div>
        <h1 class="logo">Course Assessment System</h1>
      </div>
    </header>


    <?php
    if(array_key_exists('role_id',$_SESSION)){
        buildNav($_SESSION['role_id']);
    }else{
        buildNav(5);
    }
    ?>

    <div id="content">
            <div class="tabPg">
                <a href="javascript:void(0)" class="tabs active" onclick="openTab(event, 'create_account')">Create New Account</a>
                <a href="javascript:void(0)" class="tabs" onclick="openTab(event, 'edit_account')">Edit Account</a>
            </div>


            <!--********************************************-->
            <!--               CREATE ACCOUNT               -->
            <!--********************************************-->

            <div id="create_account" class="tabcontent">
                <form method="post" action="">
                    <label for="name">Username
                    <input name="create_username" type="text" class="form-control" id="name" <?php if(isset($_POST["create_username"])) echo "value=\"{$_POST["create_username"]}\""; ?>/>
                    </label>

                    <label for="password">Password
                        <input name="create_password" type="text" class="form-control" id="password"  <?php if(isset($_POST["create_password"])) echo "value=\"{$_POST["create_password"]}\""; ?>/>
                    </label>

                    <label for="confirmPassword">Confirm Password
                        <input name="create_confirmPassword" type="text" class="form-control" id="confirmPassword" />
                    </label>

                    <label for="firstName">First Name
                        <input name="create_firstName" type="text" class="form-control" id="firstName" <?php if(isset($_POST["create_firstName"])) echo "value=\"{$_POST["create_firstName"]}\""; ?>/>
                    </label>

                    <label for="lastName">Last Name
                        <input name="create_lastName" type="text" class="form-control" id="lastName"  <?php if(isset($_POST["create_lastName"])) echo "value=\"{$_POST["create_lastName"]}\""; ?>/>
                    </label>

                    <label for="mail">Email
                    <input name="create_mail" type="text" class="form-control" id="mail"  <?php if(isset($_POST["create_mail"])) echo "value=\"{$_POST["create_mail"]}\""; ?>/>
                    </label>

                    <label for="confirmMail">Confirm Email
                        <input name="create_confirmMail" type="text" class="form-control" id="confirmMail" />
                    </label>



                    <label for="create_role">Role
                        <select name="create_role" class="form-control" id="create_role"  <?php if(isset($_POST["create_role"])) echo "value=\"{$_POST["create_role"]}\""; ?>>
                            <option value="5">Professor</option>
                            <option value="2">Course Coordinator</option>
                            <option value="4">Program Coordinator</option>
                            <option value="3">Assessment Coordinator</option>
                            <option value="1">Administrator</option>
                        </select>
                    </label>
                    <br/>
                    <button class="btn btn-success" name="createAcc" id="createId">Create Account</button>
                </form>
            </div>

			<div>
	</div>



            <!--********************************************-->
            <!--                EDIT ACCOUNT                -->
            <!--********************************************-->

            <div id="edit_account" class="tabcontent">

                <?php

                editItemDiv();

                if(isset($_POST['edit_accountSelectBtn'])){
                    try {
                        $dbh = new PDO(DBC, DBUser, DBPassword);
                        $sqlStatement = "SELECT * FROM program_user WHERE user_id = :uid";
                        $stmt = $dbh->prepare($sqlStatement);
                        $stmt->bindParam(":uid",$_POST['edit-select'],PDO::PARAM_INT);
                        $stmt->execute();

//        $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                        $result = $stmt->fetch();

                        //print_r($result);

                    } catch (PDOException $e) {
                        echo 'Connection failed: ' . $e->getMessage();
                    }
                }




                ?>


                <form method="post" action="">
                    <input type="hidden" id="current-edit" name="edit-uid" <?php if(isset($result["user_id"])) echo "value=\"{$result["user_id"]}\""; ?>/>
                    <label for="editname">Username
                        <input name="edit_username" type="text" class="form-control" id="editname" <?php if(isset($result["username"])) echo "value=\"{$result["username"]}\""; ?>/>
                    </label>

                    <label for="editpassword">Password
                        <input name="edit_password" type="text" class="form-control" id="editpassword"  <?php if(isset($result["user_password"])) echo "value=\"{$result["user_password"]}\""; ?>/>
                    </label>

                    <label for="editconfirmPassword">Confirm Password
                        <input name="edit_confirmPassword" type="text" class="form-control" id="editconfirmPassword" />
                    </label>

                    <label for="editfirstName">First Name
                        <input name="edit_firstName" type="text" class="form-control" id="editfirstName" <?php if(isset($result["first_name"])) echo "value=\"{$result["first_name"]}\""; ?>/>
                    </label>

                    <label for="editlastName">Last Name
                        <input name="edit_lastName" type="text" class="form-control" id="editlastName"  <?php if(isset($result["last_name"])) echo "value=\"{$result["last_name"]}\""; ?>/>
                    </label>

                    <label for="editmail">Email
                        <input name="edit_mail" type="text" class="form-control" id="editmail"  <?php if(isset($result["userEmail"])) echo "value=\"{$result["userEmail"]}\""; ?>/>
                    </label>

                    <label for="editconfirmMail">Confirm Email
                        <input name="edit_confirmMail" type="text" class="form-control" id="editconfirmMail" />
                    </label>



                    <label for="edit_role">Role
                        <input type="hidden" id="role-sel-val" <?php if(isset($result["role_id"])) echo "value=\"{$result["role_id"]}\""; ?>/>
                        <select name="edit_role" class="form-control" id="edit_role">
                            <option value="5">Professor</option>
                            <option value="2">Course Coordinator</option>
                            <option value="4">Program Coordinator</option>
                            <option value="3">Assessment Coordinator</option>
                            <option value="1">Administrator</option>
                        </select>
                    </label>
                    <div style="clear: both;"></div>
                    <br/>
                    <button class="btn btn-success" name="editAcc" id="editAccId">Edit Account</button>
                </form>
            </div>
        <script>
            document.getElementById('edit_role').value = document.getElementById('role-sel-val').value;
            document.getElementById('item-to-edit').value = document.getElementById('current-edit').value;
        </script>

		<?php
			echo "<div>";
			if(isset($_POST['taskStreamBTN'])){
				$course = $_POST['class_taskstream'];
				$section = $_POST['section_taskstream'];
				$dbconn1 = new report();
				$dbconn1->taskStreamReport($course, $section);
			}
			echo "</div>";

            /*
             * CREATE ACCOUNT
             *
             */
			if(isset($_POST['createAcc'])){
                $name = $_POST['create_username'];
                $mail = $_POST['create_mail'];
                $pass = $_POST['create_password'];
                $role = $_POST['create_role'];
                $fname = $_POST['create_firstName'];
                $lname = $_POST['create_lastName'];
			echo $role . "|" . $name . "|" . $pass;
                if ((strcmp($mail, $_POST['create_confirmMail']) == 0) && (strcmp($pass, $_POST['create_confirmPassword']) == 0) ) {
                    $dbconn1 = new account();
                    $dbconn1->createAccount($name, $pass, $mail, $role, $fname, $lname);
                }
			}

            /*
             * EDIT ACCOUNT
             *
             */
            if(isset($_POST['editAcc'])){
                if ((strcmp($_POST['edit_mail'], $_POST['edit_confirmMail']) == 0) && (strcmp($_POST['edit_password'], $_POST['edit_confirmPassword']) == 0) ) {
                    //$dbconn1 = new account();
                    //$dbconn1->createAccount($name, $pass, $mail, $role, $fname, $lname);

                    if (!empty($_POST["edit_username"])) {
                        $username = sanitize($_POST["edit_username"]);
                    }
                    if (!empty($_POST["edit_password"])) {
                        $password = sanitize($_POST["edit_password"]);
                    }
                    if (!empty($_POST["edit_firstName"])) {
                        $first_name = sanitize($_POST["edit_firstName"]);
                    }
                    // sanitize the data and Make sure price is a number
                    if (!empty($_POST["edit_lastName"])) {
                        $last_name = sanitize($_POST["edit_lastName"]);
                    }
                    // sanitize the data and Make sure quantity is a number
                    if (!empty($_POST["edit_mail"])) {
                        $userEmail = sanitize($_POST["edit_mail"]);
                    }
                    // sanitize the data and Make sure quantity is a number
                    if (!empty($_POST["edit_role"])) {
                        $userRole = sanitize($_POST["edit_role"]);
                    }

                    echo $_POST["edit-uid"]."|".$username."|".$password."|".$first_name."|".$last_name."|".$userEmail."|".$userRole."|";

                    try{
                        $dbh = new PDO(DBC, DBUser, DBPassword);

                        $stmt = $dbh->prepare("UPDATE program_user SET
                            username = :username,
                            user_password = :password,
                            first_name = :firstName,
                            last_name = :lastName,
                            userEmail = :userEmail,
                            role_id = :userRole WHERE user_id = :uid");
                        $stmt->bindParam(":username",$username,PDO::PARAM_STR);
                        $stmt->bindParam(":password",$password,PDO::PARAM_STR);
                        $stmt->bindParam(":firstName",$first_name,PDO::PARAM_STR);
                        $stmt->bindParam(":lastName",$last_name,PDO::PARAM_STR);
                        $stmt->bindParam(":userEmail",$userEmail,PDO::PARAM_STR);
                        $stmt->bindParam(":userRole",$userRole,PDO::PARAM_INT);
                        $stmt->bindParam(":uid",$_POST["edit-uid"],PDO::PARAM_INT);
                        $stmt->execute();
                        echo "Executing Update";
                        //$_POST['itemedited'] = $trackName . " has successfully been updated.";
//        $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                    }catch(PDOEXception $e){
                        echo $e->getMessage();
                    }
                    echo "editing?";
                }
            }

			if(isset($_POST['uploadSubmit'])){
			$file = $_POST['upload'];
			$dbconn1 = new report();
			$dbconn1->uploadReport($file);
			}
			?>

        </div>


        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="inc/js/jquery.inputfile.js"></script>
        <script>
            $( document ).ready(function() {
                openTab(event, 'create_account');
                $('.tabPg').find('a').first().addClass('active');
            });
//
//            $('input[type="file"]').inputfile({
//                uploadText: '<span class="glyphicon glyphicon-upload"></span> Select a file',
//                removeText: '<span class="glyphicon glyphicon-trash"></span>',
//                restoreText: '<span class="glyphicon glyphicon-remove"></span>',
//
//                uploadButtonClass: 'btn btn-success',
//                removeButtonClass: 'btn btn-default'
//            });



        </script>

<?php buildFooter(); ?>

  </body>
</html>
