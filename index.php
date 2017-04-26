
<?php
    require './inc/php/lib.inc.php';
	include("./inc/php/saveToDB.php");

    buildHeader("Home | Pascal");
?>
    <header>
      <div>
        <!-- <div class = "logo"> -->
          <h1 class="logo">Pascal</h1>
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
      <div id="container-login">
        <h3>System Login</h3>
        <hr>
        <form method="post">
            <p>
              <label><b>Username</b></label>
              <input type="text" name="username" placeholder="RIT Username (Do not include @rit.edu)" class="form-control log-in" />
            </p>
            <p>
              <label><b>Password</b></label>
              <input type="text" name="pass" placeholder="Password" class="form-control log-in" />
            </p>

            <button class="btn btn-success" name="login">Log in</button>

            <a href="https://start.rit.edu/ForgotUsername?source=shib">Forgot Username?</a> |
            <a href="https://start.rit.edu/ForgotPassword?source=shib">Forgot Password?</a>

        </form>
      </div>
      <div id="home-content">
        <p>content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here content here </p>
      </div>
      <div id="clear"></div>
    </div>

<?php buildFooter(); ?>

  </body>
</html>