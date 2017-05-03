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
	*	enterGrade function
	*	adds grades to the database when a professor enters them, then updates the course assessment
	*/
	public function enterGrade($courseInfo, $userId, $term, $grade){
		//break apart grade string
		$grades = explode(" ", $grade);
		for($x = 0; $x < count($grades); $x++)
		{
			if(!ctype_digit($grades[$x]))
			{
				return;
			}
			if(((int)$grades[$x]) < 0 || ((int)$grades[$x]) > 100)
			{
				return;
			}
		}
		$overThis = $this->db->selectStmt_Arr("SELECT over_this FROM assessment WHERE section_id = ".$courseInfo);
		$numOver = 0;
		for($x = 0; $x < count($grades); $x++)
		{
			//grades are correct integers between 0 and 100
			$letter = "A";
			if((int)$grades[$x] < 90)
			{
				$letter = "B";
			}
			if((int)$grades[$x] < 80)
			{
				$letter = "C";
			}
			if((int)$grades[$x] < 70)
			{
				$letter = "D";
			}
			if((int)$grades[$x] < 60)
			{
				$letter = "F";
			}
			$gradeId = $this->db->selectStmt_Arr("SELECT grade_id FROM grade ORDER BY grade_id DESC LIMIT 1");
			$gradeId[0]++;
			$q = $this->db->queryStmt("INSERT INTO grade(grade_id, charGrade, grade)values(".$gradeId[0].", '".$letter."', ".(int)$grades[$x].")");
			if($q){
				$q2 = $this->db->queryStmt("INSERT INTO section_grade(section_id, grade_id)values(".$courseInfo.", ".$gradeId[0].")");
				if((int)$grades[$x] > $overThis[0])
				{
					$numOver++;
				}
			}
		}
		$achieved = round(($numOver/count($grades))*100);
		$q3 = $this->db->queryStmt("UPDATE assessment SET percent_students_achieved_obj = ".$achieved.", complete = 1 WHERE section_id = ".$courseInfo);
		if($q3){
			echo "Success: Data has been entered into database";
		}else{
			echo "Error: Did not insert data";
		}
	}

}


?>
