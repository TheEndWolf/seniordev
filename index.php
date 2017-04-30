
<?php
    require './inc/php/lib.inc.php';
	include("./inc/php/saveToDB.php");

    session_start();

    print_r($_SESSION);
    if(!array_key_exists('loggedIn', $_COOKIE)){
        session_destroy();
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

    buildHeader("Home | Pascal");
?>
    <header>
      <div>
        <!-- <div class = "logo"> -->
          <h1 class="logo">Course Assessment System</h1>
        <!-- </div> -->
        <ul id="nav">
            <!-- <li><a calss="logo" href="index.html">Pascal</a></li> -->
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="course_data2.php">Course Data</a>
            </li>
            <li><a href="admin.php">Admin</a>
            </li>
            <li style="float:right"><a href="#log">Log Out</a></li>
            <li style="float:right"><a id="welcome" href="#welcome"><?php echo $username?></a></li>
            <li id="clear"></li>
        </ul>
      </div>
    </header>

    <div id="content">
        <?php
        if(isset($_SESSION['loggedIn'])){

        }else {
            echo "
      <div id=\"container-login\">
        <h3>System Login</h3>
        <hr>
     <form method=\"post\" action='./inc/php/login.php'>
            <p>
              <label><b>Username</b></label>
              <input type=\"text\" name=\"username\" placeholder=\"RIT Username (Do not include @rit.edu)\" class=\"form-control log-in\" />
            </p>
            <p>
              <label><b>Password</b></label>
              <input type=\"text\" name=\"pass\" placeholder=\"Password\" class=\"form-control log-in\" />
            </p>


            <input type=\"submit\" name=\"login\" value=\"Login\">

            <a href=\"https://start.rit.edu/ForgotUsername?source=shib\">Forgot Username?</a> |
            <a href=\"https://start.rit.edu/ForgotPassword?source=shib\">Forgot Password?</a>

             </form>
      </div>";
          }
          //<button class=\"btn btn-success\" name=\"login\">Log in</button>
          ?>
      <div id="home-content">
        <p>content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here </p>
      </div>
      <div id="clear"></div>
    </div>

<?php buildFooter(); ?>

  </body>
</html>
