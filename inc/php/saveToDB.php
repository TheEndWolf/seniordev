<?php

session_start();


/*
---------------------php file-----------------------

   // include 'sqlDatabase.php';
    include 'account.php';
	include "report.php";

	$class = $_POST['courseNameee'];
	$section = $_POST['sectionNummm'];

	echo $class;

	$dbconn = new report();
	$dbconn->getCourseData($class, $section);

	*/

//---------------------php file----------------------------

    include "report.php";
	include "account.php";
	include "addCourse.php"; // Renamed from enterData.php
	include "statistics.php";
	include "printingResultTable.php";

	$classy = "";
	$section ="";
	$username ="";
	$programName = "";
	$courseName = "";
	$term = "";
	$expected = "";
	$res="";
    $numOfCourses = array();

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
			if($data[3] == null){
			$expected = 0;
			}else $expected = $data[3];
		}
		//var_dump($data);
	}

	//course_data2.php
	if(isset($_POST['theSubmit1'])){
		$classy = $_POST['courseNameee'];
		$section = $_POST['sectionNummm'];
		$dbconn = new report();
		$data = $dbconn->getCourseData($classy, $section);
		if(count($data) < 1){
			echo "No results";
		}
		//var_dump( $data );
	}
		//admin.php
/*	else if(isset($_POST['createAcc'])){
			//$name = $_POST['username'];
			//$mail = $_POST['mail'];
			//$pass = $_POST['password'];
			//$role = $_POST['role'];
			//echo $role . "|" . $name . "|" . $pass;
			//$dbconn1 = new account();
			//$dbconn1->createAccount($name, $pass, $mail, $role);
	}*/
	//admin.php
	else if(isset($_POST['taskStreamBTN'])){
		//	$course = $_POST['class_taskstream'];
			//$section = $_POST['section_taskstream'];
			//$dbconn1 = new report();
			//$dbconn1->taskStreamReport($course, $section);
	}
	//admin.php
	/*
	else if(isset($_POST['uploadSubmit'])){
			$file = $_POST['upload'];
			$dbconn1 = new report();
			$dbconn1->uploadReport($file);
	}*/

	//course_data2.php
/*	else if(isset($_POST['addCourseBTN'])){
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
	}*/
	//course_data2.php
	else if(isset($_POST['addClass'])){
			$numOfCoursesCOUNT = count($numOfCourses);
			$i = $numOfCoursesCOUNT + 1;
			$numOfCourses[$i] = $_POST['class'];
			echo "add class: ".$numOfCourses[$i];
	}
	//generate report for certain course
	else if(isset($_POST['generateReport_Course'])){
		$rep = new report();
		$numOfCoursesCOUNT = sizeof($numOfCourses);
		echo "count: ".$numOfCoursesCOUNT;
		for($x = 0; $x < $numOfCoursesCOUNT; $x++) {
			echo $numOfCourses[$x];
			//$rep->generateReport_course($numOfCourses[$x]);
		}
	}
	//course_data2.php
	/*
	else if(isset($_POST['generateReport'])){
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
	}*/
	//course_data2.php
	else if(isset($_POST['stats'])){
			$dbconn1 = new statistics();
			$dbconn1->showStatistics();
	}
	//course_data2.php
/*	else if(isset($_POST['statistics'])){
		$classy = $_POST['course'];
		$section = $_POST['sectionNummm'];
		$changeOverThis = $_POST['changeOverThis'];
			$dbconn1 = new statistics();
			$dbconn1->customizedStatistics_changeOverThis($classy, $section, $changeOverThis);
	}*/
	//
	else if(isset($_POST['export'])){
		$course = $_POST['course'];
		$program = $_POST['program'];
		$term = $_POST['term'];
			$dbconn1 = new report();
			$dbconn1->exportReport($course, $program, $term);
	}
		//
	else if(isset($_POST['login'])){
		$username = $_POST['username'];
		$pass = $_POST['pass'];
			$dbconn1 = new account();
			$dbconn1->login($username, $pass);
	}






?>
