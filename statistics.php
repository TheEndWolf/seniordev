<?php

require_once ("sqlDatabase.php");

class statistics{
	
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
	*	returs the percentage of students that passed this assessment
	*	returns the average score
	*	@param - course name, assessment name
	*/
	public function customizedStatistics_changeOverThis($courseName, $sectionNum, $changeExpectedGrade){
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
							if($sco > $changeExpectedGrade){//$overThis
								$passed++;
							}
						}
					$result = ($passed / $count) * 100;
					$str = $result . "% of student recieved higher than the expected average grade of " . $changeExpectedGrade . "% on the " . $assname . "<br>";
					echo $str;
				}
	}

	/*
	*	function to generate report
	*	Takes no parameters
	*	Retrieves data from database
	*/
	public function showStatistics(){
		$result = $this->db->selectStmt_Report("Select expectedPercentAchieved, percent_achieved_Obj from course");
	}



}


?>