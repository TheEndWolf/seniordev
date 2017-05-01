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
		$this->db = new sqlDatabase(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	}
	
	/**
	*	function places course names into select component
	*/	
	public function getClasses(){
		$getClasses= $this->db->selectStmt_Arr("SELECT course_name FROM course");
		$getClassId = $this->db->selectStmt_Arr("SELECT course_id FROM course");
		$arrCount= count($getClasses);
		$option = '<p>Class: <select name="courseNameee" class="form-control">';
		//$option .= '<option value = "''">'Classes'</option>';
			for($x = 0; $x < $arrCount; $x++) {
				$option .= '<option value = "'.$getClassId[$x].'">'.$getClasses[$x].'</option>';
			}
			$option.= '</select></p>';
		echo $option;
	}
	
	/**
	*	function places term numbers into select component
	*/	
	public function getTerms($courseId){
		$getSections= $this->db->selectStmt_Arr("SELECT section_id FROM course_section WHERE course_id = '" .$courseId. "'");
		$termInfo = 'WHERE section_id = "'.$getSections[0].'"';
		for($x = 1; $x < count($getSections); $x++)
		{
			$termInfo .= ' OR section_id = "'.$getSections[$x].'"';
		}
		$getTerms= $this->db->selectStmt_Arr("SELECT term FROM section ".$termInfo);
		$arrCount= count($getTerms);
		$option = '<p>Terms: <select name="terms" class="form-control">';
		//$option .= '<option value = "''">'Classes'</option>';
			for($x = 0; $x < $arrCount; $x++) {
				$option .= '<option value = "'.$getTerms[$x].'">'.$getTerms[$x].'</option>';
			}
			$option.= '</select></p>';
		echo $option;
	}
	
	/**
	*	function places section numbers into select component
	*/	
	public function getSections($courseId){
		/*$getClasses= $this->db->selectStmt_Arr("SELECT course_name FROM course");
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
		echo $option1;*/
	}

}


?>