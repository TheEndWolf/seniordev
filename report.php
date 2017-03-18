<?php

require_once ("sqlDatabase.php");

class report{
	
 private $db;
	/*
	*	construct function	
	*	Is called as soon as a instance of this class is made.
	*	creates connection to a database.
	*/
	public function __construct()
	{
		 $this->db = new sqlDatabase("localhost","root","","pascal_final");
	}

	/*
	*	function to generate report
	*	Takes no parameters
	*	Retrieves data from database
	*/
	public function generateReport($courseName, $secNum){
		$sectionID = $this->db->selectStmt_ID("select section.section_id from section, course where course_name = '". $courseName ."' and sectionNum = ". $sectionNum);
		$result = $this->db->selectStmt_Assoc("select program_name, course_name, term from program, course where course_name = '". $courseName ."' and section_id = ". $sectionID);
	}

	/*
	*	function to generate report
	*	Takes no parameters
	*	Retrieves data from database
	*/
	public function getReport(){
		$result = $this->db->selectStmt_Assoc("select program.program_name, program.program_objective, course.course_name, course.term, course.course_number, section.section_number, assessment.assessmentName, assessment.expected_Percent_achieved
from program, course, course_section, section, assessment");
	}

	/*
	*	function to generate course report
	*	@param - course name
	*	Retrieves data from database, course name, assessment name, assessment notes, expected % of students that achieved the objective, expected % of students to achieve the objective
	*/
	public function getCourseData($courseName, $sectionNum){
		$result = $this->db->selectStmt_Assoc("select program_name, course_name, term, avgGrade_expected, from course join program using (program_id) join course_section using(course_id) join section using(section_id) where course_name = '".$courseName."' and section_number = ".$sectionNum);
	}

	/*
	*	returs the percentage of students that passed this assessment
	*	returns the average score
	*	@param - course name, assessment name
	*/
	public function taskStreamReport($courseName, $sectionNum){
		$avg =0;
		$passed=0;
		$iNum = 0;
		
		$courseID = $this->db->selectStmt_ID("select course_id from course, section where course_name = '" . $courseName . " and section_number = '". $sectionNum ."'");
		$assessments = $this->db->selectStmt_ID("select assessment_id from assessment where course_id = ". $courseID);
		$assessmentsCOUNT = $this->db->selectStmt_ID("select count(assessment_id) from assessment where course_id = ". $courseID);

				for($x = 0; $x < $assessmentsCOUNT; $x++) {
					$assID = assessments[$iNum];
					$assname = $this->db->selectStmt_ID("select assessmentName from assessment where assessment_id = ". $assID);
					$overThis = $this->db->selectStmt_ID("select over_this from assessment join course using(course_id) where assessment_id = ". $assID)
					$scores = $this->db->selectStmt_Arr("select score from student join score using(student_id) join assessment using(assessment_id) join course using(course_id) join course_student using(course_id) join course_section using(course_id) join section using(sectio_id) where assessment_id = ".$assID."'");	
					$iNum++;
					$count = count($scores);
					if($count == 0){
						echo "No results!";
						return;
					}
						for ($i = 0; $i < $count; $i++) {
							$avg = $avg + $scores[$i];
							$sco = $scores[$i];
							if($sco > $overThis){//$overThis
								$passed++;
							}
						}
					$result = ($passed / $count) * 100;
					$str = $result . "% of student recieved higher than the expected average grade of " . $overThis . "% on the " . $assname . "<br>";
					echo $str;
				}
	}
	
	/*
	*	imports data from csv file to mysql
	*	@param - file name and table name in db
	*	must have these fields in csv: report_id,program_name,program_objective,course_name,term,course_number,section,assessmentName,expected_percent_achieved,percent_students_achieved_obj
	*/
	public function uploadReport($filename){

		$sqlStmt = $this->db->queryStmt("LOAD DATA INFILE '$filename' INTO TABLE Report FIELDS TERMINATED BY ','  ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 ROWS;");
			if($sqlStmt){
				echo "success";
			}else echo "error: import csv not working";
	}
}


?>