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
		$getClassId= $this->db->selectStmt_Arr("SELECT course_id FROM course");
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
	 *	Gets program list for Course Data -> Statistics
	 */
	public function getStatPrograms(){
		try {
			$dbh = new PDO(DBC, DBUser, DBPassword);
			$sqlStatement = "SELECT program_id,program_name FROM program";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$option = 'Program: <select id="stat_programName" name="stat_programName" class="form-control">';
			$option .=  "<option value=\"0\">--- Select A Program ---</option>";
			foreach($result as $program){
				$option .=  "<option value=\"{$program->program_id}\">" . $program->program_name . "</option>";
			}
			$option.= '</select>';

			//print_r($result);

		} catch (PDOException $e) {		}
		echo $option;
	}

	/**
	 *	Gets program list for Course Data -> Generate Report Section
	 */
	public function getRptPrograms(){
		try {
			$dbh = new PDO(DBC, DBUser, DBPassword);
			$sqlStatement = "SELECT program_id,program_name FROM program";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$option = 'Program: <select id="rpt_programName" name="rpt_programName" class="form-control">';
			$option .=  "<option value=\"0\">--- Select A Program ---</option>";
			foreach($result as $program){
				$option .=  "<option value=\"{$program->program_id}\">" . $program->program_name . "</option>";
			}
			$option.= '</select>';

			//print_r($result);

		} catch (PDOException $e) {		}
		echo $option;
	}

	/**
	 *	Gets class list for Course Data -> Generate Report Section
	 */
	public function getRptClasses($_programid){
		try {
			$dbh = new PDO(DBC, DBUser, DBPassword);
			$sqlStatement = "SELECT course_id,course_name FROM course where program_id = {$_programid}";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$option = 'Class: <select id="rpt_courseName" name="rpt_courseName" class="form-control">';
			$option .=  "<option value=\"1\">--- Select A Course ---</option>";
			foreach($result as $course){
				$option .=  "<option value=\"{$course->course_id}\">" . $course->course_name . "</option>";
			}
			$option.= '</select>';

			//print_r($result);

		} catch (PDOException $e) {		}
		echo $option;
	}

	/**
	 *	Gets class list for Course Data -> Statistics
	 */
	public function getStatClasses($_programid){
		try {
			$dbh = new PDO(DBC, DBUser, DBPassword);
			$sqlStatement = "SELECT course_id,course_name FROM course where program_id = {$_programid}";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$option = 'Class: <select id="stat_courseName" name="stat_courseName" class="form-control">';
			$option .=  "<option value=\"1\">--- Select A Course ---</option>";
			foreach($result as $course){
				$option .=  "<option value=\"{$course->course_id}\">" . $course->course_name . "</option>";
			}
			$option.= '</select>';

			//print_r($result);

		} catch (PDOException $e) {		}
		echo $option;
	}




	/**
	 *	Gets class list for Course Data -> Generate Report Section
	 */
	public function getRptSections($_course_id, $term){
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
		$getTerms= $this->db->selectStmt_Arr("SELECT DISTINCT term FROM section ".$termInfo);
		$arrCount= count($getTerms);
		$option = '<p>Terms: <select id="rpt_terms" name="terms" class="form-control">';
		$option .=  "<option value=\"1\">--- Select A Term ---</option>";
		//$option .= '<option value = "''">'Classes'</option>';
		for($x = 0; $x < $arrCount; $x++) {
			$option .= '<option value = "'.$getTerms[$x].'">'.$getTerms[$x].'</option>';
		}
		$option.= '</select></p>';
		echo $option;
	}

	/**
	 *	function places term numbers into select component for Course Data->Statistics
	 */
	public function getStatTerms($courseId){
		$getSections= $this->db->selectStmt_Arr("SELECT section_id FROM course_section WHERE course_id = '" .$courseId. "'");
		$termInfo = 'WHERE section_id = "'.$getSections[0].'"';
		for($x = 1; $x < count($getSections); $x++)
		{
			$termInfo .= ' OR section_id = "'.$getSections[$x].'"';
		}
		$getTerms= $this->db->selectStmt_Arr("SELECT DISTINCT term FROM section ".$termInfo);
		$arrCount= count($getTerms);
		$option = '<p>Terms: <select id="stat_terms" name="stat_terms" class="form-control">';
		$option .=  "<option value=\"1\">--- Select A Term ---</option>";
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
		$arrCount= count($getSections);
		$option = 'Sections: <select name="sections" id="rpt_courseSections" class="form-control">';
		$option .=  "<option value=\"1\">--- Select A Section ---</option>";
		//$option .= '<option value = "''">'Classes'</option>';
		for($x = 0; $x < $arrCount; $x++) {
			$option .= '<option value = "'.$getSections[$x].'">'.$getSections[$x].'</option>';
		}
		$option.= '</select>';
		echo $option;
	}

	/**
	 *	CourseData->Statistics
	 */
	public function getStatSections($courseId, $term){
		$getSectionId= $this->db->selectStmt_Arr("SELECT section_id FROM course_section WHERE course_id = '" .$courseId. "'");
		$sectionInfo = 'section_id = "'.$getSectionId[0].'"';
		for($x = 1; $x < count($getSectionId); $x++)
		{
			$sectionInfo .= ' OR section_id = "'.$getSectionId[$x].'"';
		}

		$getSections= $this->db->selectStmt_Arr('SELECT section_number FROM section WHERE ' .$sectionInfo. 'AND term = "'.$term.'"');
		$arrCount= count($getSections);
		$option = 'Sections: <select name="stat_sections" id="stat_courseSections" class="form-control">';
		$option .=  "<option value=\"1\">--- Select A Section ---</option>";
		//$option .= '<option value = "''">'Classes'</option>';
		for($x = 0; $x < $arrCount; $x++) {
			$option .= '<option value = "'.$getSections[$x].'">'.$getSections[$x].'</option>';
		}
		$option.= '</select>';
		echo $option;
	}

	/**
	 *	Gets program list for Course Data -> Generate Report Section
	 */
	public function getCoursePrograms(){
		try {
			$dbh = new PDO(DBC, DBUser, DBPassword);
			$sqlStatement = "SELECT program_id,program_name FROM program";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$option = 'Program: <select id="course_program" name="course_program" class="form-control">';
			$option .=  "<option value=\"0\">--- Select A Program ---</option>";
			foreach($result as $program){
				$option .=  "<option value=\"{$program->program_id}\">" . $program->program_name . "</option>";
			}
			$option.= '</select>';

			//print_r($result);

		} catch (PDOException $e) {		}
		echo $option;
	}
	
	/**
	 *	Gets list of people in system for adding as coordinators or professors to a course, section, or program
	 */
	public function getUsers($id, $name){
		try {
			$dbh = new PDO(DBC, DBUser, DBPassword);
			$sqlStatement = "SELECT user_id,first_name,last_name FROM program_user";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$option = '<select id="'.$id.'" name="'.$name.'" class="form-control">';
			$option .=  "<option value=\"0\">--- Select A User ---</option>";
			foreach($result as $user){
				$option .=  "<option value=\"{$user->user_id}\">" . $user->first_name . " " . $user->last_name . "</option>";
			}
			$option.= '</select>';

			//print_r($result);

		} catch (PDOException $e) {		}
		echo $option;
	}
	
	/**
	 *	Gets list of courses in system
	 */
	public function getCourses($id, $name){
		try {
			$dbh = new PDO(DBC, DBUser, DBPassword);
			$sqlStatement = "SELECT course_id,course_name FROM course";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			$option = '<select id="'.$id.'" name="'.$name.'" class="form-control">';
			$option .=  "<option value=\"0\">--- Select A Course ---</option>";
			foreach($result as $course){
				$option .=  "<option value=\"{$course->course_id}\">" . $course->course_name . "</option>";
			}
			$option.= '</select>';

			//print_r($result);

		} catch (PDOException $e) {		}
		echo $option;
	}



	function getViews($_roleID){
		try {
			$dbh = new PDO(DBC, DBUser, DBPassword);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
		$role = $_roleID;

		// Assessment Coordinator
		//
		//
		if ($role == 3) {

			$sqlStatement = "SELECT program_id, program_CoOrdinator from program where program_CoOrdinator = {$_SESSION['user_id']}";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$programID =$result[0]['program_id'];
			echo "Program ID: {$programID}";

			$sqlStatement = "SELECT course_id, course_name, course_number, flag, course_coOrdinator, program_id from course where program_id = {$programID}";
			$stmt = $dbh->prepare($sqlStatement);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			echo "<pre>";
			print_r($result);
			echo "</pre>";



			$sqlStatement2 = "select section_id from section_grade join section using(section_id) join program_user using(user_id) where user_id = :userid";
			$stmt2 = $dbh->prepare($sqlStatement2);
			$stmt2->bindParam(":userid", $_SESSION['user_id'], PDO::PARAM_STR);
			$stmt2->execute() or die(print_r($stmt2->errorInfo(), true));
			$count = $stmt2->rowCount();
			$courses = $stmt2->fetchAll(PDO::FETCH_ASSOC);

			foreach ($courses as $c) {

				$sectionID = $c['section_id'];
				$sqlStatement = "select count(section_id), course_name from assessment join section using(section_id) join program_user using(user_id) join course_section using(section_id) join course using(course_id) where user_id = :userid and section_id=" . $sectionID;
				$stmt = $dbh->prepare($sqlStatement);
				$stmt->bindParam(":userid", $_SESSION['user_id'], PDO::PARAM_STR);
				$stmt->execute() or die(print_r($stmt->errorInfo(), true));
				$gradesEntered = $stmt->rowCount();
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

				echo "<div id='viewContent'>";
				echo "<h2>SECTIONS</h2>";
				echo "<div id=\"view_section\">";
				foreach ($result as $key) {
					$countArr = $key['count(section_id)'];
					echo "<div id=\"sectionInfo\">;
				<hr>
			<h3>Course: " . $key['course_name'] . "</h3>
							<p>grades entered: </br>" . $countArr . "</p>";
				}


				$sqlStatement1 = "select expected_percent_achieved, percent_students_achieved_obj from assessment join section using(section_id) join program_user using(user_id) where user_id = :userID and section_id =" . $sectionID;
				$passed = '';
				$stmt1 = $dbh->prepare($sqlStatement1);
				$stmt1->bindParam(":userID", $_SESSION['user_id'], PDO::PARAM_STR);
				$stmt1->execute() or die(print_r($stmt1->errorInfo(), true));
				$stmt1->rowCount();

				$res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				foreach ($res as $key) {

					if (($key['percent_students_achieved_obj']) > ($key['expected_percent_achieved'])) {
						$passed = "yes";
						echo "<p>Hit Goal %: </br>" . $passed . "</p>
							  </div>";
					} else {
						$passed = "no";
						echo "<p>Hit Goal %: </br>" . $passed . "</p></div>";
					}
				}

				//foreach from 160
				echo " </div>";
				echo "</div>";
			}//foreach courses
		}
	}






}


?>