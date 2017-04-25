<!DOCTYPE html>
<html>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
   <script src="javascript/ajaxFunc.js"></script>
  <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
 
  
  <head>
  <title>Home | Pascal</title>
  </head>
  <body>
  	 <?php
		include_once("saveToDb.php");
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
                <a href="javascript:void(0)" class="tabs active" onclick="openTab(event, 'custom_stat')">Custom Statistics</a>
                <a href="javascript:void(0)" class="tabs" onclick="openTab(event, 'generate_report')">Generate Report</a>
                <a href="javascript:void(0)" class="tabs" onclick="openTab(event, 'enter_data')">Enter Data</a>
            </div>
			
            
            <div id="custom_stat" class="tabcontent" style="display:block;">
                <form method="post" action="">
	<?php 
		include_once("gettingData.php");
		include_once("report.php");
		$getData = new gettingData();
		$getData->getClasses();
	?>
              <!--     <p>Class 
                    <select name="courseNameee" class="form-control"> 
                        <option value="server">server 1</option>
                        <option value="marketing">marketing</option>
                        <option value="database connectivity">DB conn</option>
                        <option value="four">Class 4</option>
                    </select></p> 

                    
                    <p>Section
                    <select name="sectionNummm" class="form-control">
                        <option value="123"> 1</option>
                        <option value="sec2">Section 2</option>
                        <option value="sec3">Section 3</option>
                        <option value="sec4">Section 4</option>
                    </select></p>
                    -->
                    <button type="submit" class="btn btn-success" name="theSubmit">View Course Data</button>
					</br>
					
<?php				
	/*		$programName = "";
			$courseName = "";
			$term = "";
	//include "report.php";	
	if(isset($_POST['theSubmit'])){
		$class = $_POST['courseNameee'];
		$section = $_POST['sectionNummm'];		
		$dbconn = new report();
		$data = $dbconn->getCourseData($class, $section);
		if(count($data) < 1){
			echo "No results";
		}else{
			$programName = $data[0];
			$courseName = $data[1];
			$term = $data[2];
		}
		//var_dump($data);
	}*/
	?>				

				
	
                    <p><b><br>Class Information:</b></p>
                    <p>Program Name
                    <select name="program" class="form-control">
                        <option value="<?php echo $programName?>"><?php echo $programName?></option>
                    </select></p>
                    
                    <p>Course Name
                    <select name="course" class="form-control">
                        <option value="<?php echo $courseName?>"><?php echo $courseName?></option>
                    </select></p>
                    
                    <p>Term
                    <select name="term" class="form-control">
                        <option value="<?php echo $term?>"><?php echo $term?></option>
                    </select></p>
                    
                    <p>Over This
                    <input type="text" class="form-control" name="changeOverThis" value="0"/></p>
                    
                    <p>Expected
                    <input type="text" class="form-control" name="<?php echo $expected?>" value="<?php echo $expected?>" /></p>
                    
                    <button class="btn btn-success" name="statistics">Show Statistic</button>
                </form>
            </div>
				
            <div id="generate_report" class="tabcontent">
                <form method="post">
                    <p>Class 
                        <select name="class" class="form-control"> 
                            <option value="server">server</option>
                            <option value="law101">Law</option>
                            <option value="managment">managment</option>
                            <option value="four">Class 4</option>
                        </select>
                    </p> 

                    <p>Section
                        <select name="section" class="form-control">
                            <option value="1">Section 1</option>
                            <option value="2">Section 2</option>
                            <option value="3">Section 3</option>
                            <option value="4">Section 4</option>
                        </select>
                    </p>

                    <button class="btn btn-success" name="addClass">Add a Class</button>
                    <button class="btn btn-success" name="generateReport">Generate Report</button>
					
		<p>
			<?php 
			//$res="";
	/*		if(isset($_POST['generateReport'])){	
			$dbconn1 = new report();
			$res = $dbconn1->getReport();
			//var_dump($res);
			if(count($res) < 1){
			echo "No results";
			}
				echo "<table class='table'>";
				echo "<tr><th>Program name<th><th>Program objective<th><th>Course name<th><th>Term<th><th>course_number<th><th>section_number<th><th>assessmentName<th><th>expected_Percent_achieved<th><tr>";
				foreach($res as $key => $val)
				{
					echo "<tr><td>". $val['program_name']. "<td><td>". $val['program_objective']. "<td><td>". $val['course_name']. "<td><td>". $val['term']. "<td><td>". $val['course_number']. "<td><td>". $val['section_number']. "<td><td>". $val['assessmentName']. "<td><td>". $val['expected_Percent_achieved']. "<td><tr>";
				}
				echo "</table>";
			}*/
			?>
		</p>

                    <p><b><br>Class Information:</b></p>
                    <p>Program Name
                        <select name="program" class="form-control">
                            <option value="IT">Program 1</option>
                            <option value="p2">Program 2</option>
                        </select>
                    </p>

                    <p>Course Name
                        <select name="course" class="form-control">
                            <option value="server">Course 1</option>
                            <option value="c2">Course 2</option>
                        </select>
                    </p>

                    <p>Term
                        <select name="term" class="form-control">
                            <option value="1">Term 1</option>
                            <option value="t2">Term 2</option>
                        </select>
                    </p>

                    <button class="btn btn-success" name="export">Export</button>
                </form>
            </div>
            
            <div id="enter_data" class="tabcontent">
                <form method="post">
                    <p>Program Name
                        <input type="text" name="prog" class="form-control" /></p>

                    <p>Course Name
                        <input type="text" name="course" class="form-control" /></p>

                    <p>Program Objectives<br>
                            <textarea class="form-control" name="progObj" rows="4"></textarea></p>

                    <p>Term
                        <input type="text" class="form-control" name="term" /></p>

                    <p>Over This %
                        <input type="text" class="form-control" name="over" value= "0"/></p>

                    <p>Expected %
                        <input type="text" class="form-control" name="exp" value= "0"/></p>

                    <p>course number
                        <input type="text" class="form-control" name="courseNUM"/></p>

                    <p>CAI
						<input type="text" class="form-control" name="cai" value= "0"/></p>

                    <button class="btn btn-success" name="enterDataBTN">Submit</button>
                </form>
            </div>
			
			<?php				
		if(isset($_POST['enterDataBTN'])){
			$program = $_POST['prog'];
			$course = $_POST['course'];
			$progObj = $_POST['progObj'];
			$term = $_POST['term'];
			$courseNum = $_POST['courseNUM'];
			$CAI = $_POST['cai'];
			$overThis = $_POST['over'];
			$expected = $_POST['exp'];
			
			$dbconn1 = new enterData();
			$dbconn1->enterReportData($program, $progObj, $course, $term, $courseNum, $CAI, $overThis, $expected);
	}
			
			if(isset($_POST['statistics'])){	
		$classy = $_POST['course'];
		$section = $_POST['sectionNummm'];	
		$changeOverThis = $_POST['changeOverThis'];
			$dbconn1 = new statistics();
			$dbconn1->customizedStatistics_changeOverThis($classy, $section, $changeOverThis);
	}
	
			if(isset($_POST['generateReport'])){	
			$dbconn1 = new report();
			$res = $dbconn1->getReport();
			if(count($res) < 1){
			echo "No results";
			}
				echo "<table class='table'>";
				echo "<tr><th>Program name<th><th>Program objective<th><th>Course name<th><th>Term<th><th>course_number<th><th>section_number<th><th>assessmentName<th><th>expected_Percent_achieved<th><tr>";
				foreach($res as $key => $val)
				{
					echo "<tr><td>". $val['program_name']. "<td><td>". $val['program_objective']. "<td><td>". $val['course_name']. "<td><td>". $val['term']. "<td><td>". $val['course_number']. "<td><td>". $val['section_number']. "<td><td>". $val['assessmentName']. "<td><td>". $val['expected_Percent_achieved']. "<td><tr>";
				}
				echo "</table>";
			//getTable($res);
	}

	?>
			
        </div>

      <script src="tabs.js"></script>
    <footer>
      <p>Copyright &copy; Team Pascal. All RIghts Reserved.</p>
    </footer>

  </body>
</html>