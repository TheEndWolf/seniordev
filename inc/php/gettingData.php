<?php

require_once("sqlDatabase.php");

class gettingData{
	
 private $db;

	/*
	*	construct function	
	*	creates connection to a database.
	*/
	public function __construct()
	{
		$this->db = new sqlDatabase("localhost","pascal_web","fr1end","Pascal_Finito");
	}
	
	/**
	*	function places course names into select component
	*/	
	public function getClasses(){
		$getClasses= $this->db->selectStmt_Arr("SELECT course_name FROM course");
		$arrCount= count($getClasses);
		$option = '<p>Class: <select name="courseNameee" class="form-control">';
		//$option .= '<option value = "''">'Classes'</option>';
			for($x = 0; $x < $arrCount; $x++) {
				$option .= '<option value = "'.$getClasses[$x].'">'.$getClasses[$x].'</option>';
			}
			$option.= '</select></p>';
		echo $option;
		
		$getSection= $this->db->selectStmt_Arr("SELECT section_number FROM section");
		$arrCountsection= count($getSection);
		$option1 = '<p>Section: <select name="sectionNummm" class="form-control">';
			for($x = 0; $x < $arrCountsection; $x++) {
				$option1 .= '<option value = "'.$getSection[$x].'">'.$getSection[$x].'</option>';
			}
			$option1.= '</select></p>';
		echo $option1;
	}



}


?>