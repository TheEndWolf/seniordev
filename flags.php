<?php

require_once ("sqlDatabase.php");

class flag{
	
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
	*	function that places a custom flag on a certain course
	*	param - course name
	*/
	public function setCustom_Flag($courseName){
		$result = $this->db->queryStmt("update course set flag_taskStream = 7 where course_name = '".$courseName."'");
	}

	/*
	*	function that places a task stream flag on an assessment
	*	param - course name
	*/
	public function setTaskStream_Flag(){
		$nullArray = array();
		$i = 0;
		$assessmentsArr= $this->db->selectStmt_Assoc("select assessment_id, course_id, expected_percent_achieved, percent_students_achieved_obj from assessment");
		foreach ($assessmentsArr as $key => $val) {
			if($val['percent_students_achieved_obj'] == 0){
				//$nullArray[$i] = $val['course_id'];
				$nullArray[$i] = $val['assessment_id']; 
				$i++;
			}
		}
		//return $nullArray;
		foreach ($nullArray as $assessID) {
			//$q1 = $this->db->queryStmt("UPDATE course set taskStream_flag = 1 where course_id = '".$assessID."'");
			$q1 = $this->db->queryStmt("UPDATE assessment set taskStream_flag = 1 where assessment_id = '".$assessID."'");
			if($q1){
				echo "success...flag set!!";
			}
		}

	}

	/*
	*	function that removes taskStream flag
	*	params - course name, section number
	*/
	public function removeFlag($courseName, $section_num){
		$courseID = $this->db->selectStmt_ID("Select course_id from course join course_section using(course_id) join section using(section_id) where course_name = '".$courseName."' and section_number = ".$section_num);
		echo $courseID;
		$result = $this->db->queryStmt("update course set flag_taskStream = 0 where course_id = ".$courseID);
		if($result){
			echo "flag removed successfully";
		}
	}

}


?>