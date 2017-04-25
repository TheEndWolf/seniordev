<!DOCTYPE html>
<html>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
<!--  JQuery plugin for file upload taken from: 
    http://www.jqueryscript.net/form/Styling-Your-File-Input-with-jQuery-Inputfile-Plugin-Bootstrap.html -->
  <link rel="stylesheet" type="text/css" href="uploader/jquery.inputfile.css"/>
  <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <!--<script src="javascript/ajaxFunc.js"></script>-->
  <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
  <head>
  <title>Home | Pascal</title>
  </head>
  <body>
<?php
	include("saveToDb.php");
?>
    <header>
      <div>
        <!-- <div class = "logo"> -->
          <h1 class="logo">Pascal</h1>
        <!-- </div> -->
        <ul id="nav">
            <!-- <li><a calss="logo" href="index.html">Pascal</a></li> -->
            <li><a href="index.php">Home</a></li>
            <li><a href="course_data2.php">Course Data</a>
<!--                <ul>
                    <li><a href="custom_stat.html">Custom Statistics</a></li>
                    <li><a href="generate_report.html">Generate Report</a></li>
                    <li><a href="enter_data.html">Enter Data</a></li>
        	</ul>-->
            </li>
            <li><a href="admin.php">Admin</a>
<!--                <ul>
                    <li><a href="upload_report.html">Upload Report</a></li>
                    <li><a href="create_account.html">Create New Account</a></li>
                    <li><a href="task_stream.html">Task Stream</a></li>
                </ul>-->
            </li>
            <li style="float:right"><a href="#log">Log Out</a></li>
            <li style="float:right"><a id="welcome" href="#welcome">Welcome, John Smith</a></li>
            <li id="clear"></li>
        </ul>
      </div>
    </header>

    <div id="content">
            <div class="tabPg">
                <a href="javascript:void(0)" class="tabs active" onclick="openTab(event, 'upload_report')">Upload Report</a>
                <a href="javascript:void(0)" class="tabs" onclick="openTab(event, 'create_account')">Create New Account</a>
                <a href="javascript:void(0)" class="tabs" onclick="openTab(event, 'task_stream')">Task Stream</a>
            </div>
            
            <div id="upload_report" class="tabcontent" style="display:block;">
                <form name="uploadForm" method="post">
                    <p>
                        <input type="file" name ="upload" accept=".xls,.xlsx"/>
						<button class="btn btn-success" name="uploadSubmit">upload</button>
                        *Note: Only .xls files are supported.
                    </p>
                </form>
            </div>
		
            
            <div id="create_account" class="tabcontent">
                <form method="post" action="">
                    <p>Username
                        <input name="username" type="text" class="form-control" id="name" /></p>
                    
                    <p>Email
                        <input name="mail" type="text" class="form-control" id="mail" /></p>
                    
                    <p>Confirm Email
                        <input name="confirmMail" type="text" class="form-control" id="confirmMail" /></p>
                    
                    <p>Password
                        <input name="password" type="text" class="form-control" id="password" /></p>
                    
                    <p>Confirm Password
                        <input name="confirmPassword" type="text" class="form-control" id="confirmPassword" /></p>
                    
                    <p>Role
                        <select name="role" class="form-control" id="role">
                        <option value="Instructor">Instructor</option>
                        <option value="Reporter">Reporter</option>
                        <option value="Admin">Admin</option>
                    </select></p>
                    
                    <button class="btn btn-success" name="createAcc" id="createId">Create Account</button>
                </form>
            </div>
			
			<div>
	</div>
            
            <div id="task_stream" class="tabcontent">
                <form method="post" action="">
                    <p>Class
                    <select name="class_taskstream" id="class_taskstream" class="form-control">
                        <option value="server">server</option>
                        <option value="c2">Class 2</option>
                    </select></p>
                    
                    <p>Section
                    <select name="section_taskstream" id="section_taskstream" class="form-control">
                        <option value="1">123</option>
                        <option value="s2">Section 2</option>
                    </select></p>
                    
                    <button class="btn btn-success" name="taskStreamBTN" id="taskStream">Generate Report</button>
                    
                </form>
            </div>			
		
		<?php
			echo "<div>";
			if(isset($_POST['taskStreamBTN'])){
				$course = $_POST['class_taskstream'];
				$section = $_POST['section_taskstream'];		
				$dbconn1 = new report();
				$dbconn1->taskStreamReport($course, $section);
			}
			echo "</div>";
		
			if(isset($_POST['createAcc'])){
			$name = $_POST['username'];
			$mail = $_POST['mail'];	
			$pass = $_POST['password'];
			$role = $_POST['role'];	
			echo $role . "|" . $name . "|" . $pass;
			$dbconn1 = new account();
			$dbconn1->createAccount($name, $pass, $mail, $role);		
			}
			if(isset($_POST['uploadSubmit'])){
			$file = $_POST['upload'];
			$dbconn1 = new report();
			$dbconn1->uploadReport($file);
			}
			?>
			
        </div>

		
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="uploader/jquery.inputfile.js"></script>
        <script>
            $('input[type="file"]').inputfile({
                uploadText: '<span class="glyphicon glyphicon-upload"></span> Select a file',
                removeText: '<span class="glyphicon glyphicon-trash"></span>',
                restoreText: '<span class="glyphicon glyphicon-remove"></span>',

                uploadButtonClass: 'btn btn-success',
                removeButtonClass: 'btn btn-default'
            });
        </script>
      <script src="tabs.js"></script>
  </body>
</html>