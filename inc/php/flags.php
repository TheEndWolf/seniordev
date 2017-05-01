<?php

require_once("sqlDatabase.php");

class flag{
	
 private $db;

	/*
	*	construct function	
	*	creates connection to a database.
	*/
	public function __construct()
	{
		 //$this->db = new sqlDatabase("localhost","root","","pascal_database");
		$this->db = new sqlDatabase(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	}
	
	/*
	*	function that places a custom flag on a certain course
	*/
	public function setCustom_Flag($courseName){
		$result = $this->db->queryStmt("update course set custom_flag = 1 where course_name = '".$courseName."'");
	}
	
	/*
	*	function that places a task stream flag on an assessment
	*	param - course name
	*/
	public function setTaskStream_Flag(){
		$nullArray = array();
		$i = 0;
		$assessmentsArr= $this->db->selectStmt_Assoc("select course_id, program_name, program_objective, course_name, term, course_number, course_assessment_item, over_this, expected_percent_achieved from program join course using (program_id) join course_section using (course_id) join section using(section_id) join assessment using(course_id)");
		foreach ($assessmentsArr as $key => $val) {
			if($val['course_id'] == '' || $val['program_name'] == '' || $val['program_objective'] == '' || $val['course_name'] == '' || $val['term'] == '' || $val['course_number'] == '' || $val['course_assessment_item'] == '' || $val['over_this'] == '' || $val['expected_percent_achieved']){
				$courseID = $val['course_id'];
				$q1 = $this->db->queryStmt("UPDATE course set taskStreamFlag = 1 where course_id = '".$courseID."'");
			}
		}
	}

	/*
	*	function that removes taskStream flag
	*/
	public function removeFlag($courseName, $section_num){
		$courseID = $this->db->selectStmt_ID("Select course_id from course join course_section using(course_id) join section using(section_id) where course_name = '".$courseName."' and section_number = ".$section_num);
		$result = $this->db->queryStmt("update course set flag_taskStream = 0 where course_id = ".$courseID);
		if($result){
			echo "flag removed successfully";
		}
	}

}


?>