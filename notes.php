<?php

require_once ("sqlDatabase.php");

class notes{
	
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
	*	function to add a program user
	*	@param - 
	*/
	public function addCourseNotes_instructor($programName, $courseName, $term, $notes){
		$courseID = $this->db->selectStmt_ID("Select course_id from course join program using(program_id) where course_name = '".$courseName."' and term = '". $term ."' and program_name = '". $programName ."'");
		$result = $this->db->queryStmt("insert into course_notes(notes, noteWrittenBy, course_id) values ('$notes', $courseID)");
		if($result){
			echo "success added notes";
		}else echo "not working adding notes";
	}
	
	/*
	*	function to add a program user
	*	@param - 
	*/
	public function addCourseNotes_adminReporter($programName, $courseName, $term, $instructorName, $notes){
		$courseID = $this->db->selectStmt_ID("Select course_id from course join program using(program_id) where course_name = '".$courseName."' and term = '". $term ."' and program_name = '". $programName ."'");
		$result = $this->db->queryStmt("insert into course_notes(notes, noteWrittenBy, course_id) values ('$notes', $courseID)");
		if($result){
			echo "success added notes";
		}else echo "not working adding notes";
	}


}


?>