
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


buildHeader("Data | Course Assessment System");

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
                <a href="javascript:void(0)" class="tabs active" onclick="openTab(event, 'custom_stat')">Custom Statistics</a>
                <a href="javascript:void(0)" class="tabs" onclick="openTab(event, 'generate_report')">Generate Report</a>
                <a href="javascript:void(0)" class="tabs" onclick="openTab(event, 'add_course')">Add Course</a>
            </div>


            <div id="custom_stat" class="tabcontent" style="display:block;">
                <form method="post" action="">
	<?php
		include_once("./inc/php/gettingData.php");
		include_once("./inc/php/report.php");
		$getData = new gettingData();
		$getData->getClasses();
	?>
                <p>Term
                    <input type="text" class="form-control" name="terms"/>
				</p>
                <button type="submit" class="btn btn-success" name="theSubmit">View Course Data</button>
				</br>

<?php
	/*		$programName = "";
			$courseName = "";
			$term = "";
	//include "./inc/php/report.php";
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



            <!--********************************************-->
            <!--            GENERATE REPORT                 -->
            <!--********************************************-->


            <div id="generate_report" class="tabcontent">
                <form method="post">
                    <?php
                    $getData->getRptClasses();
                    //$getData->getRptSections(1);
                    ?>

                    <?php
                    // AJAX CALL FILLS IN THE P TAG BELOW
                    ?>
                    <p id="rpt_section">

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

            <div id="add_course" class="tabcontent">
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

                    <p>Course Number
                        <input type="text" class="form-control" name="courseNUM"/></p>

                    <!-- <p>CAI
						<input type="text" class="form-control" name="cai" value= "0"/></p> -->

                    <button class="btn btn-success" name="addCourseBTN">Submit</button>
                </form>
            </div>

			<?php
		if(isset($_POST['addCourseBTN'])){ // addCourseBTN is renamed from enterDataBTN
			$program = $_POST['prog'];
			$course = $_POST['course'];
			$progObj = $_POST['progObj'];
			$term = $_POST['term'];
			$courseNum = $_POST['courseNUM'];
			$CAI = $_POST['cai'];
			$overThis = $_POST['over'];
			$expected = $_POST['exp'];

			$dbconn1 = new addCourse();
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


<?php buildFooter(); ?>
<script>
    $('#rpt_courseName').change(function() {
        var courseID = $('#rpt_courseName').val();
        console.log(courseID);
        $.ajax({
            type: "POST",
            data: {
                rpt_cid:courseID
            },
            url: "./inc/php/dataHandler.php",
            dataType: "html",
            success: function(data) {
                result=data;
                //console.log(result);
                $("#rpt_section").html(result);
            }
        });
    })
</script>

  </body>
</html>
