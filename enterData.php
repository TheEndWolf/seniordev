<?php

require_once ("sqlDatabase.php");

class enterData{
	
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
	*	method for entering grades
	*	@params: program name, program objective, course name, term, course number, CAI, overThis, % expected to achieve objective 	
	*/
	public function enterData($program_name, $prog_objective, $course_name, $term, $course_num, $CAI,  $overThis, $expected_per_achieved){	
		$hasProgram = $this->db->selectStmt_ID("Select count(program_id) from program where program_name = '".$program_name."'");	
		if($hasProgram = 1){
			$q1 = $this->db->queryStmt("UPDATE program set program_objective = '". $prog_objective."' where program_id = ". $programID);	
		}else{
			$q3 = $this->db->queryStmt("INSERT into program(program_name, program_objective)values('$program_name', '$prog_objective')");		
		}		
		$programID = $this->db->selectStmt_ID("Select program_id from program where program_name = '".$program_name."'");	
		$q2 = $this->db->queryStmt("INSERT into course(course_name, term, course_number, program_id)values('$course_name', '$term', $course_num, $programID)");
		$courseID = $this->db->selectStmt_ID("Select course_id from course where course_name = '".$course_name."'");
		$q4 = $this->db->queryStmt("INSERT into assessment(course_assessment_item, over_this, expected_percent_achieved, course_id)values('$CAI', $overThis, $expected_per_achieved, $courseID)");		
				if($q1 && $q2 && $q3 && $q4){
					echo "success: inserted data";
				}else{
					echo "error: did not insert data";
				}
	}
	
	/*
	*	method for entering scores
	*	@params: program name, program objective, courese name, term, course number, section, CAI, % expected to achieve objective 	
	*/
	public function enterScore($first_name, $lastName, $course_name, $courseNum, $assessmentName, $score){	
		$studentID = $this->db->selectStmt_ID("Select student_id from student where first_name = '".$first_name."' and last_name = '". $lastName."'");
		$courseID = $this->db->selectStmt_ID("Select course_id from course where course_name = '".$course_name."' and course_number = ".$courseNum);
		$assessmentID = $this->db->selectStmt_ID("Select assessment_id from assessment where assessmentName = '".$assessmentName."' and course_id = '".$courseID."'");
		$q1 = $this->db->queryStmt("INSERT into score(score, assessment_id, student_id)values($score, $assessmentID, $studentID)");	
				if($q1){
					echo "success: inserted scores";
				}else{
					echo "error: did not insert grades";
				}
	}
	
		/*
	*	method for entering grades
	*	@params: program name, program objective, courese name, term, course number, section, CAI, % expected to achieve objective 	
	*/
	public function enterGrade($first_name, $last_name, $course_name, $sectionNum, $charGrade, $grade){	
		$studentID = $this->db->selectStmt_ID("Select student_id from student where first_name = '".$first_name."' and last_name = '". $last_name."'");
		$courseID = $this->db->selectStmt_ID("Select course_id from course join course_section using(course_id) join section using(section_id) where course_name = '".$course_name."' and section_number = ".$sectionNum);
		$q2 = $this->db->queryStmt("INSERT into grade(charGrade, grade)values($charGrade, $grade)");
		$gradeID = $this->db->insert_id;
		$q3 = $this->db->queryStmt("INSERT into grade_student(grade_id, student_id)values($gradeID, $studentID)");	
				if($q2 && $q3){
					echo "success: inserted grade";
				}else{
					echo "error: did not insert grade";
				}
	}

}


?>