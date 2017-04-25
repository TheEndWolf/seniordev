<?php

require_once ("sqlDatabase.php");

class notes{
	
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
	*	function to add a program user
	*	
	*/
	public function addCourseNotes_instructor($programName, $courseName, $term, $writtenBy, $notes){
		$courseID = $this->db->selectStmt_ID("Select course_id from course join program using(program_id) where course_name = '".$courseName."' and term = '". $term ."' and program_name = '". $programName ."'");
		$result = $this->db->queryStmt("insert into course_notes(notes, noteWrittenBy, course_id) values ('$notes', '$writtenBy', $courseID)");
		if($result){
			echo "success added notes";
		}else echo "not working adding notes";
	}
	
	/*
	*	function to add a program user
	*	
	*/
	public function addCourseNotes_adminReporter($programName, $courseName, $term,  $writtenBy, $instructorName, $notes){
		$courseID = $this->db->selectStmt_ID("Select course_id from course join program using(program_id) where course_name = '".$courseName."' and term = '". $term ."' and program_name = '". $programName ."'");
		$result = $this->db->queryStmt("insert into course_notes(notes, noteWrittenBy, course_id) values ('$notes',  $writtenBy, $courseID)");
		if($result){
			echo "success added notes";
		}else echo "not working adding notes";
	}


}


?>