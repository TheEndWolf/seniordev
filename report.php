<?php

require_once ("sqlDatabase.php");

class report{
	
 private $db;
	/*
	*	construct function	
	*	creates connection to a database.
	*/
	public function __construct()
	{
	$this->db = new sqlDatabase("localhost","root","","pascal_finito");
 }

	/*
	*	function to generate report
	*	Retrieves data from database
	*/
	public function generateReport($courseName, $sectionNum){
		$sectionID = $this->db->selectStmt_ID("select section.section_id from section, course where course_name = '". $courseName ."' and section_number = ". $sectionNum);
		$result = $this->db->selectStmt_Assoc("select program.program_name, course.course_name, course.term from program, course, section where course_name = '". $courseName ."' and section_id = ". $sectionID);
	}
	
	/*
	*	function to generate report
	*	Retrieves data from database
	*/
	public function generateReport_course($courseName){
		$result = $this->db->selectStmt_Assoc("select program_name, program_objective, course_name, term, course_number, section_number, assessmentName, expected_Percent_achieved from program join course using (program_id) join course_section using (course_id) join section using(section_id) join assessment using(course_id) where course_name= ". $courseName);
	}

	/*
	*	function to get report
	*	Retrieves data from database
	*/
	public function getReport(){
		$result = $this->db->selectStmt_Assoc("select program_name, program_objective, course_name, term, course_number, section_number, assessmentName, expected_Percent_achieved from program join course using (program_id) join course_section using (course_id) join section using(section_id) join assessment using(course_id)");
	return $result;
	}

	/*
	*	function to generate course report
	*/
	public function getCourseData($courseName, $sectionNum){
		$result = $this->db->selectStmt_Arr("select program_name, course_name, term, avgGrade_expected from course join program using (program_id) join course_section using(course_id) join section using(section_id) where course_name = '".$courseName."' and section_number = ".$sectionNum);
		return $result;
	}

	/*
	*	returns the percentage of students that passed this assessment
	*/
	public function taskStreamReport($courseName, $sectionNum){
		$avg =0;
		$iNum = 0;
		
		$courseID = $this->db->selectStmt_ID("select course.course_id from course, section where course_name = '" . $courseName . "' and section_number = ". $sectionNum);
		$assessments = $this->db->selectStmt_Arr("select assessment_id from assessment where course_id = ". $courseID);
		$assessmentsCOUNT = $this->db->selectStmt_ID("select count(assessment_id) from assessment where course_id = ". $courseID);
		$count = $assessmentsCOUNT;
		echo "<table class= 'table'>";
		echo "<th> RESULTS </th>";
				for($x = 0; $x < $assessmentsCOUNT; $x++) {
					$passed=0;
					$assID = $assessments[$iNum];
					$assname = $this->db->selectStmt_ID("select assessmentName from assessment where assessment_id = ". $assID);
					$overThis = $this->db->selectStmt_ID("select over_this from assessment join course using(course_id) where assessment_id = ". $assID);
					$expectedGrade = $this->db->selectStmt_ID("select avgGrade_expected from course where course_id = ". $courseID);
					$scores = $this->db->selectStmt_Arr("select score from student join score using(student_id) join assessment using(assessment_id) join course using(course_id) join course_student using(course_id) join course_section using(course_id) join section using(section_id) where assessment_id = ".$assID);	
					$iNum++;
					$count = count($scores);
					if($count == 0){
						echo "No results!";
						return;
					}
						for ($i = 0; $i < $count; $i++) {
							$avg = $avg + $scores[$i];
							$sco = $scores[$i];
							if($sco > $expectedGrade){//$overThis
								$passed++;
							}
						}
					$result = ($passed / $count) * 100;
					echo "<tr>";
					echo "<td style= 'border: 1px solid black;'>";
					$str = $result . "% of student recieved higher than the expected average grade of " . $expectedGrade . "% on the " . $assname . "<br>";
					echo $str;
					echo "</td>";
					echo "</tr>";
				}
				//echo $str;
			echo "</table>";
	}
	
	/*
	*	imports data from csv file to mysql
	*	must have these fields in csv: report_id,program_name,program_objective,course_name,term,course_number,section,assessmentName,expected_percent_achieved,percent_students_achieved_obj
	*/
	public function uploadReport($filename){

		$sqlStmt = $this->db->queryStmt("LOAD DATA INFILE '$filename' INTO TABLE imported_reports FIELDS TERMINATED BY ','  ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 ROWS;");
			if($sqlStmt){
				echo "success";
			}else echo "error: import csv not working";
	}
	
	/*
	*	
	*/
	public function exportReport($courseName, $program, $term){
		$data = $this->db->selectStmt_AssocEXPORT("select program_name, program_objective, course_name, term, course_number, section_number, assessmentName, expected_Percent_achieved from program join course using (program_id) join course_section using (course_id) join section using(section_id) join assessment using(course_id) where course_name = '".$courseName."' and program_name = '".$program ."' and term = ".$term);
	/*	//$arrlength = count($data);
		$filename = "ExportScript.xls"; // File Name
		// Download file
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		// Write data to file
		$flag = false;
		//while ($row = mysql_fetch_assoc($data)) {
		foreach($data as $row) {
			if (!$flag) {
				// display field/column names as first row
				echo implode("\t", array_keys($row)) . "\r\n";
				$flag = true;
			}
			echo implode("\t", array_values($row)) . "\r\n";
		}*/
	}
	
	/*
	*	
	*/
	public function addClass($courseName){
		
	}
}


?>