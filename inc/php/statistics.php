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


	public function viewStatistics($_courseID, $_sectionID, $_expGradePct, $_expStudentPct){
		try {
			$dbh = new PDO(DBC, DBUser, DBPassword);
			$sqlStatement = "SELECT count(grade_id) FROM section_grade where section_id = {$_sectionID}";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$numGrades = $stmt->fetchAll();
			$numGrades = $numGrades[0][0];
			//echo $numGrades;

			$sqlStatement = "SELECT g.grade as grade FROM `section_grade` sg join grade g using (grade_id) where section_id={$_sectionID}";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$grades = $stmt->fetchAll(PDO::FETCH_ASSOC);
			//print_r($grades);

			$numAbovePct = 0;
			foreach($grades as $grade){
				//echo $grade['grade'];
				if($grade['grade'] > $_expGradePct){
					$numAbovePct++;
				}else{

				}

			}

			$percStudentAchieved = ($numAbovePct/$numGrades)*100;
			if($percStudentAchieved>=$_expStudentPct){
				echo $percStudentAchieved . "% of students recieved higher than the expected average grade of " . $_expGradePct . "% on the assignment<br>";
				echo "{$_expStudentPct}% of students were expected to meet this goal";
			}else{
				echo "The target was not met<br> only {$percStudentAchieved}% of students recieved higher than the expected average grade of {$_expGradePct}% on the assignment<br>";
				echo "{$_expStudentPct}% of students were expected to meet this goal";
			}



//			return array(
//				"gradeRequired" => $_expGradePct,
//				"percStudentsReq" => $_expStudentPct,
//				"percWithThese" => $numAbovePct/$numGrades
//
//			);

//			$option = 'Class: <select id="stat_courseName" name="stat_courseName" class="form-control">';
//			$option .=  "<option value=\"1\">--- Select A Course ---</option>";
//			foreach($result as $course){
//				$option .=  "<option value=\"{$course->course_id}\">" . $course->course_name . "</option>";
//			}
//			$option.= '</select>';

			//print_r($result);

		} catch (PDOException $e) {		}
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