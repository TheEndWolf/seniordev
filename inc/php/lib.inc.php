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
      <p>Copyright &copy; Team Pascal. All Rights Reserved.</p>
    </footer>
      <script src=\"./inc/js/tabs.js\"></script>
        </body>
        </html>";
}
?>
