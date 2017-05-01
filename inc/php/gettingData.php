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
		$getClasses= $this->db->selectStmt_Arr("SELECT course_id,course_name FROM course");
		$arrCount= count($getClasses);
		$option = '<p>Class: <select name="courseNameee" class="form-control">';
		//$option .= '<option value = "''">'Classes'</option>';
		for($x = 0; $x < $arrCount; $x++) {
			$option .= '<option value = "'.$getClasses[$x].'">'.$getClasses[$x].'</option>';
		}
		$option.= '</select></p>';
		echo $option;
	}

	/**
	 *	Gets class list for Course Data -> Generate Report Section
	 */
	public function getRptClasses(){
		try {
			$dbh = new PDO(DBC, DBUser, DBPassword);
			$sqlStatement = "SELECT course_id,course_name FROM course";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$option = '<p>Class: <select id="rpt_courseName" name="rpt_courseName" class="form-control">';
			$option .=  "<option value=\"1\">--- Select A Course ---</option>";
			foreach($result as $course){
				$option .=  "<option value=\"{$course->course_id}\">" . $course->course_name . "</option>";
			}
			$option.= '</select></p>';

			//print_r($result);

		} catch (PDOException $e) {		}
		echo $option;
	}




	/**
	 *	Gets class list for Course Data -> Generate Report Section
	 */
	public function getRptSections($_course_id){
		try {
			$dbh = new PDO(DBC, DBUser, DBPassword);
			$sqlStatement = "SELECT course_id,section_id FROM course_section where course_id = {$_course_id}";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$option = 'Section: <select id="rpt_sections" name="rpt_sections" class="form-control">';
			foreach($result as $course){
				$option .=  "<option value=\"{$course->section_id}\">" . $course->section_id . "</option>";
			}
			$option.= '</select>';

			//print_r($result);

		} catch (PDOException $e) {		}
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
	public function getSections($courseId, $term){
		$getSectionId= $this->db->selectStmt_Arr("SELECT section_id FROM course_section WHERE course_id = '" .$courseId. "'");
		$sectionInfo = 'section_id = "'.$getSectionId[0].'"';
		for($x = 1; $x < count($getSectionId); $x++)
		{
			$sectionInfo .= ' OR section_id = "'.$getSectionId[$x].'"';
		}
		
		$getSections= $this->db->selectStmt_Arr('SELECT section_number FROM section WHERE ' .$sectionInfo. 'AND term = "'.$term.'"');
		$arrCount= count($getClasses);
		$option = '<p>Class: <select name="sections" class="form-control">';
		//$option .= '<option value = "''">'Classes'</option>';
			for($x = 0; $x < $arrCount; $x++) {
				$option .= '<option value = "'.$getSections[$x].'">'.$getSections[$x].'</option>';
			}
			$option.= '</select></p>';
		echo $option;
	}

}


?>