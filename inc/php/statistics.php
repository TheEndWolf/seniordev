<?php

require_once("sqlDatabase.php");

class statistics{
	
 private $db;

	/*
	*	construct function	
	*	creates connection to a database.
	*/
	public function __construct()
	{
		$this->db = new sqlDatabase(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	}
	
	/*
	*	returns the the average grade and percentage of students that passed this assessment
	 * //TODO: Update Queries for the new database
	*/
	public function customizedStatistics_changeOverThis($courseID, $sectionID, $changeExpectedGrade, $percStudent){
		$iNum = 0;
		$db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
		mysqli_select_db($db, DB_DATABASE);

		$result = $db->query("select assessment_id from assessment where course_id = ". $courseID);
		$assessments = mysqli_fetch_assoc($result);
		$assessmentsCOUNT = $db->query("select count(grade_id) from section_grade where section_id = ". $sectionID);
		$rowcount=mysqli_num_rows($assessmentsCOUNT);
		$assessmentsCOUNT = $rowcount;

				for($x = 0; $x < $assessmentsCOUNT; $x++) {
					$passed=0;
					$assID = $assessments[$iNum];
					$assname = $this->db->selectStmt_ID("select assessmentName from assessment where assessment_id = ". $assID);
					$overThis = $this->db->selectStmt_ID("select over_this from assessment join course using(course_id) where assessment_id = ". $assID);
					$result = $db->query("select score from student join score using(student_id) join assessment using(assessment_id) join course using(course_id) join course_student using(course_id) join course_section using(course_id) join section using(section_id) where assessment_id = ". $assID);
					$scores = mysqli_fetch_assoc($result);
					$iNum++;
					$count = count($scores);
					if($count !== 0){
						for ($i = 0; $i < $count; $i++) {
							echo "i:".$i;
							$sco = $scores[$i];
							if($sco > $changeExpectedGrade){
								$passed++;
							}
						}
						$result = ($passed / $count) * 100;
						$str = $result . "% of student recieved higher than the expected average grade of " . $changeExpectedGrade . "% on the " . $assname . "<br>";
						echo $str;
					}else{
						echo "";
						echo "no results <br>";
					}
				}
	}

	/*
	*	function to generate statistics
	*	Retrieves data from database, compares expected Percent Achieved with percent achieved
	*/
	public function showStatistics(){
		$result = $this->db->selectStmt_Report("Select expected_percent_achieved, percent_students_achieved_obj from assessment");
	}



}


?>