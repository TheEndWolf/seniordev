<?php

require_once("sqlDatabase.php");

class addCourse{ // Renamed from enterData

 private $db;

	/*
	*	construct function
	*	creates connection to a database.
	*/
	public function __construct()
	{
		// $this->db = new sqlDatabase("localhost","root","","pascal_database");
		$this->db = new sqlDatabase(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	}
	
	/*
	*	addCourse function
	*	adds a course to the DB when someone chooses to add one via the course data part of the application
	*/
	public function addCourse($program, $course_name, $course_num, $coordinator, $notes){
		$q = $this->db->queryStmt("INSERT INTO course(course_name, course_number, course_coOrdinator, program_id)values('".$course_name."', ".$course_num.", ".$coordinator.", ".$program.")");
		if($q){
			$courseId = $this->db->selectStmt_ID("Select course_id from course where course_name = '".$course_name."' AND course_number = ".$course_num." AND course_coOrdinator = ".$coordinator." AND program_id = ".$program);
			$q2 = $this->db->queryStmt("INSERT into course_Notes(notes, course_id)values('".$notes."', ".$courseId.")");
			if($q2){
				echo "Success: Data has been entered into database";
			}
		}else{
			echo "Error: Did not insert data";
		}
	}
	
	/*
	*	addSection function
	*	adds a section of a course to the DB when someone chooses to add one via the course data part of the application
	*/
	public function addSection($course, $term, $sectionNum, $program_obj, $notes, $cai, $professor, $over_this, $expected, $assessment_due){
		$date = date("Y-m-d H:i:s");
		$q = $this->db->queryStmt("INSERT INTO section(section_number, term, notes, date_created, user_id)values(".$sectionNum.", '".$term."', '".$notes."', '".$date."', ".$professor.")");
		if($q){
			$section = $this->db->selectStmt_ID("SELECT section_id FROM section WHERE section_number = ".$sectionNum." AND term = '".$term."' AND date_created = '".$date."' AND user_id = ".$professor);
			$q2 = $this->db->queryStmt("INSERT INTO course_section(course_id, section_id)values(".$course.", ".$section.")");
			$q3 = $this->db->queryStmt("INSERT INTO assessment(date_data_recieved, course_assessment_item, expected_percent_achieved, over_this, deadline, section_id)values('".$date."', '".$cai."', ".$expected.", ".$over_this.", '".$assessment_due."', ".$section.")");
			echo "INSERT INTO assessment(date_data_recieved, course_assessment_item, expected_percent_achieved, over_this, deadline, section_id)values('".$date."', '".$cai."', ".$expected.", ".$over_this.", '".$assessment_due."', ".$section.")";
			if($q3){
				echo "Success: Data has been entered into database";
			}
		}
		else{
			echo "Error: Did not insert data";
		}
	}
	
	/*
	*	addProgram function
	*	adds a program to the DB when someone chooses to add one via the course data part of the application
	*/
	public function addProgram($name, $objective, $coordinator){
		$q = $this->db->queryStmt("INSERT into program(program_name, program_objective, program_CoOrdinator)values('".$name."', '".$objective."', ".$coordinator.")");
		if($q){
			echo "Success: Data has been entered into database";
		}else{
			echo "Error: Did not insert data";
		}
	}
	
	/*
	*	method for entering report data
	*
	*/
	public function enterReportData($program_name, $prog_objective, $course_name, $term, $course_num, $overThis, $expected_per_achieved){
		$programID = $this->db->selectStmt_ID("Select program_id from program where program_name = '".$program_name."'");
		$hasProgram = $this->db->selectStmt_ID("Select count(program_id) from program where program_name = '".$program_name."'");
		if($hasProgram == 1){
			$q1 = $this->db->queryStmt("UPDATE program set program_objective = '". $prog_objective."' where program_id = ". $programID);
		}else{
			$q3 = $this->db->queryStmt("INSERT into program(program_name, program_objective)values('$program_name', '$prog_objective')");
			$programID = $this->db->selectStmt_ID("Select program_id from program where program_name = '".$program_name."'");
		}
		$hasCourse = $this->db->selectStmt_ID("Select count(course_id) from course where course_name = '".$course_name."' and course_number = ". $course_num . " and term = ".$term);
		if($hasCourse == 1){
			$courseID = $this->db->selectStmt_ID("Select course_id from course where course_name = '".$course_name."'");
			$q11 = $this->db->queryStmt("UPDATE course set course_name = '". $course_name."', course_number = ". $course_num .", term = ". $term ." where course_id = ". $courseID);
		}else{
		$q2 = $this->db->queryStmt("INSERT into course(course_name, term, course_number, program_id)values('$course_name', $term, $course_num, $programID)");
		$courseID = $this->db->selectStmt_ID("Select course_id from course where course_name = '".$course_name."'");
		}
				$q4 = $this->db->queryStmt("INSERT into assessment(course_assessment_item, over_this, expected_percent_achieved, course_id)values($overThis, $expected_per_achieved, $courseID)");
				if($q4){
					echo "Success: Data has been entered into database";
				}else{
					echo "Error: Did not insert data";
				}
	}

	/*
	*	method for entering grades
	*
	*/
	public function enterGrade($first_name, $last_name, $course_name, $sectionNum, $charGrade, $grade){
		$studentID = $this->db->selectStmt_ID("Select student_id from student where first_name = '".$first_name."' and last_name = '". $last_name."'");
		$courseID = $this->db->selectStmt_ID("Select course_id from course join course_section using(course_id) join section using(section_id) where course_name = '".$course_name."' and section_number = ".$sectionNum);
		$q2 = $this->db->queryStmt("INSERT into grade(charGrade, grade)values('$charGrade', $grade)");
		$gradeID = $this->db->selectStmt_ID("select grade_id from grade order by grade_id DESC LIMIT 1");
		$q3 = $this->db->queryStmt("INSERT into grade_student(grade_id, student_id)values($gradeID, $studentID)");
				if($q2 && $q3){
					echo "success: inserted grade";
				}else{
					echo "error: did not insert grade";
				}

	}

}


?>
