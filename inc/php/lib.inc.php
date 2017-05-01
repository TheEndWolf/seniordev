<?php


session_start();
/*
 * Builders header information
 * @param - title for page Ex. "Home | Course Assessment System"
 */
function buildHeader($_title)
{
    echo "
    <html >
      <script type = \"text/javascript\" src = \"https://code.jquery.com/jquery-3.2.1.min.js\" ></script >
      <link rel = \"stylesheet\" type = \"text/css\" href = \"./inc/css/style.css\" >
      <link rel = \"stylesheet\" type = \"text/css\" href = \"./inc/css/jquery.inputfile.css\" />
      <script src = \"./inc/js/bootstrap.min.js\" ></script >
      <link href = \"./inc/css/bootstrap.min.css\" rel = \"stylesheet\" >
      <script src=\"./inc/js/ajaxFunc.js\"></script>


      <head >
      <title > {$_title} </title >
      </head ><body>";
}

/*
 * Builds footer html
 */
function buildFooter(){
    echo "<footer>
      <p>Copyright &copy; 2017 Team Pascal. All Rights Reserved.</p>
    </footer>
      <script src=\"./inc/js/tabs.js\"></script>
        </body>
        </html>";
}

/*
 * Builds nav based off role id
 */

function buildNav($_role_id){
    $serverSelf = $_SERVER['PHP_SELF'];
    if($_role_id == 1){
        echo " <ul id=\"nav\">
        <li><a href=\"index.php\" class=\"" . ($_SERVER['PHP_SELF'] == '/index.php' ? ' active' : '') . "\">Home</a></li>
        <li><a href=\"course_data2.php\" class=\"" . ($_SERVER['PHP_SELF'] == '/coursedata2.php' ? ' active' : '') . "\">Course Data</a></li>
        <li><a href=\"admin.php\" class=\"" . ($_SERVER['PHP_SELF'] == '/admin.php' ? ' active' : '') . "\">Admin</a></li>";
        if(array_key_exists('username', $_SESSION)){
            echo "<li style=\"float:right\"><a href=\"./inc/php/logout.php\">Log Out</a></li>
                    <li style=\"float:right\"><a id=\"welcome\" href=\"#welcome\">{$_SESSION['first_name']} {$_SESSION['last_name']}</a></li>";
        }
        echo "
        <li id=\"clear\"></li>
        </ul>";
    }
    if($_role_id == 3){
        echo " <ul id=\"nav\">
        <li><a href=\"index.php\" class=\"" . ($_SERVER['PHP_SELF'] == '/index.php' ? ' active' : '') . "\">Home</a></li>
        <li><a href=\"course_data2.php\" class=\"" . ($_SERVER['PHP_SELF'] == '/coursedata2.php' ? ' active' : '') . "\">Course Data</a></li>";
        if(array_key_exists('username', $_SESSION)){
            echo "<li style=\"float:right\"><a href=\"./inc/php/logout.php\">Log Out</a></li>
                    <li style=\"float:right\"><a id=\"welcome\" href=\"#welcome\">{$_SESSION['first_name']} {$_SESSION['last_name']}</a></li>";
        }
        echo "
        <li id=\"clear\"></li>
        </ul>";
    }
    if($_role_id == 5 || $_role_id == 2 || $_role_id == 4){
        echo " <ul id=\"nav\">
        <li><a href=\"index.php\" class=\"" . ($_SERVER['PHP_SELF'] == '/index.php' ? ' active' : '') . "\">Home</a></li>";
        if(array_key_exists('username', $_SESSION)){
            echo "<li style=\"float:right\"><a href=\"./inc/php/logout.php\">Log Out</a></li>
                    <li style=\"float:right\"><a id=\"welcome\" href=\"#welcome\">{$_SESSION['first_name']} {$_SESSION['last_name']}</a></li>";
        }
        echo "
        <li id=\"clear\"></li>
        </ul>";
    }
}


?>
