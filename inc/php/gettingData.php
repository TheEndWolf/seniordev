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



	function getViews($_roleID)
    {
        $currentTerm = 2165;
        try {
            $dbh = new PDO(DBC, DBUser, DBPassword);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $role = $_roleID;

        // Assessment Coordinator or Admin
        if ($role == 3 || $role == 1) {
			echo "<h3>The courses that are being taught this semester:</h3>";
            $sqlStatement = "SELECT program_id, program_CoOrdinator,program_name from program";
            $stmt = $dbh->prepare($sqlStatement);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);



            foreach ($result as $programResult) {
                $programID = $programResult['program_id'];
                $programName = $programResult['program_name'];
                $programNameID = str_replace(' ','_',$programName);
//                echo "Program ID: {$programID}";
//                echo "Program Name: {$programName}";




                $sqlStatement = "SELECT course_id, course_name, course_number, flag, course_coOrdinator, program_id,term, a.*,s.section_number,s.user_id as uid from course join course_section using(course_id) join assessment a using(section_id) join section s using(section_id) where program_id = {$programID} and term = " . $currentTerm . " order by course_number asc, assessment_id asc,s.section_number asc";
                $stmt = $dbh->prepare($sqlStatement);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//			echo "<pre>";
//			print_r($result);
//			echo "</pre>";


                echo "<a href=\"#{$programNameID}{$programID}\" data-toggle=\"collapse\"><h3>{$programName}</h3></a>";
                echo "<div id=\"{$programNameID}{$programID}\" class=\"collapse\">";
                foreach ($result as $courseAssessment) {
                    $compeleted = "";
                    $compBool = false;
                    $passed = "";

                    $sqlStatement = "SELECT first_name,last_name from program_user where user_id = {$courseAssessment['uid']}";
                    $stmt = $dbh->prepare($sqlStatement);
                    $stmt->execute();
                    $person = $stmt->fetch(PDO::FETCH_ASSOC);
                    //print_r($person);


                    if ($courseAssessment['complete'] == 0) {
                        $compeleted = "<span style='color:red'>NO</span>";
                        $compBool = false;
                    } else {
                        $compeleted = "<span style='color:green'>YES</span>";
                        $compBool = true;
                    }

                    if (($courseAssessment['percent_students_achieved_obj']) > ($courseAssessment['expected_percent_achieved'])) {
                        $passed = "<span style='color:green'>YES</span>";
                    } else {
                        $passed = "<span style='color:red'>NO</span>";
                    }
                    echo "<div class=\"courseBoxes\">
						<h4>{$courseAssessment['course_name']}</h4>
						<hr>
						<p>
							Course Assessment Item: {$courseAssessment['course_assessment_item']} <br/>
							Term: {$courseAssessment['term']} <br/>
							Course Number: {$courseAssessment['course_number']} <br/>
							Section: {$courseAssessment['section_number']} <br/>
							Professor: {$person['first_name']} {$person['last_name']} <br/>
							Complete: {$compeleted} <br/>";
                    if ($compBool) {
                        echo "Reached Goal of {$courseAssessment['expected_percent_achieved']}%: {$passed} <br/>";
                    } else {
                        echo "Deadline of: {$courseAssessment['deadline']}";
                    }
                    echo "
						</p>
					  </div>";

                }
                echo "</div><div style='clear:both;'></div>";
            }

            echo "<div style='clear:both;'></div>";

        }

        //Program Coordinator
        //
        if ($role == 4) {
            $sqlStatement = "SELECT program_id, program_CoOrdinator,program_name from program where program_CoOrdinator = {$_SESSION['user_id']}";
            $stmt = $dbh->prepare($sqlStatement);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


            $programID = $result[0]['program_id'];
            $programName = $result[0]['program_name'];


            $sqlStatement = "SELECT course_id, course_name, course_number, flag, course_coOrdinator, program_id,term, a.*,s.section_number,s.user_id as uid from course join course_section using(course_id) join assessment a using(section_id) join section s using(section_id) where program_id = {$programID} and term = " . $currentTerm . " order by course_number asc, assessment_id asc,s.section_number asc";
            $stmt = $dbh->prepare($sqlStatement);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//			echo "<pre>";
//			print_r($result);
//			echo "</pre>";


            echo "<a href=\"#{$programName}{$programID}\" data-toggle=\"collapse\"><h3>{$programName}</h3></a>";
            echo "<div id=\"{$programName}{$programID}\" class=\"collapse\">";
            foreach ($result as $courseAssessment) {
                $compeleted = "";
                $compBool = false;
                $passed = "";

                $sqlStatement = "SELECT first_name,last_name from program_user where user_id = {$courseAssessment['uid']}";
                $stmt = $dbh->prepare($sqlStatement);
                $stmt->execute();
                $person = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($courseAssessment['complete'] == 0) {
                    $compeleted = "NO";
                    $compBool = false;
                } else {
                    $compeleted = "yes";
                    $compBool = true;
                }

                if (($courseAssessment['percent_students_achieved_obj']) > ($courseAssessment['expected_percent_achieved'])) {
                    $passed = "YES";
                } else {
                    $passed = "NO";
                }
                echo "<div class=\"courseBoxes\">
						<h4>{$courseAssessment['course_name']}</h4>
						<hr>
						<p>
							Item: {$courseAssessment['course_assessment_item']} <br/>
							Term: {$courseAssessment['term']} <br/>
							Course Number: {$courseAssessment['course_number']} <br/>
							Section: {$courseAssessment['section_number']} <br/>
							Professor: {$person['first_name']} {$person['last_name']} <br/>
							Complete: {$compeleted} <br/>";
                if ($compBool) {
                    echo "Reached Goal of {$courseAssessment['expected_percent_achieved']}%: {$passed} <br/>";
                } else {
                    echo "Deadline of: {$courseAssessment['deadline']}";
                }
                echo "
						</p>
					  </div>";

            }
            echo "</div><div style='clear:both;'></div>";


            echo "<div style='clear:both;'></div>";

        }

        //Course Coordinator
        //
        if ($role == 2) {
            $sqlStatement = "SELECT course_id, course_CoOrdinator,course_name from course where course_CoOrdinator = {$_SESSION['user_id']}";
            $stmt = $dbh->prepare($sqlStatement);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


            $courseID = $result[0]['course_id'];
            $courseName = $result[0]['course_name'];
            $courseNameID = str_replace(' ','_',$courseName);


            $sqlStatement = "SELECT course_id, course_name, course_number, flag, course_coOrdinator, program_id,term, a.*,s.section_number,s.user_id as uid from course join course_section using(course_id) join assessment a using(section_id) join section s using(section_id) where course_id = {$courseID} and term = " . $currentTerm . " order by course_number asc, assessment_id asc,s.section_number asc";
            $stmt = $dbh->prepare($sqlStatement);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//			echo "<pre>";
//			print_r($result);
//			echo "</pre>";


            echo "<a href=\"#{$courseNameID}{$courseID}\" data-toggle=\"collapse\"><h3>{$courseName}</h3></a>";
            echo "<div id=\"{$courseNameID}{$courseID}\" class=\"collapse\">";
            foreach ($result as $courseAssessment) {
                $compeleted = "";
                $compBool = false;
                $passed = "";

                $sqlStatement = "SELECT first_name,last_name from program_user where user_id = {$courseAssessment['uid']}";
                $stmt = $dbh->prepare($sqlStatement);
                $stmt->execute();
                $person = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($courseAssessment['complete'] == 0) {
                    $compeleted = "NO";
                    $compBool = false;
                } else {
                    $compeleted = "yes";
                    $compBool = true;
                }

                if (($courseAssessment['percent_students_achieved_obj']) > ($courseAssessment['expected_percent_achieved'])) {
                    $passed = "YES";
                } else {
                    $passed = "NO";
                }
                echo "<div class=\"courseBoxes\">
						<h4>{$courseAssessment['course_name']}</h4>
						<hr>
						<p>
							Item: {$courseAssessment['course_assessment_item']} <br/>
							Term: {$courseAssessment['term']} <br/>
							Course Number: {$courseAssessment['course_number']} <br/>
							Section: {$courseAssessment['section_number']} <br/>
							Professor: {$person['first_name']} {$person['last_name']} <br/>
							Complete: {$compeleted} <br/>";
                if ($compBool) {
                    echo "Reached Goal of {$courseAssessment['expected_percent_achieved']}%: {$passed} <br/>";
                } else {
                    echo "Deadline of: {$courseAssessment['deadline']}";
                }
                echo "
						</p>
					  </div>";

            }
            echo "</div><div style='clear:both;'></div>";


            echo "<div style='clear:both;'></div>";

        }
    }
	

	/**
	 *	displayCourseAssessment method
	 *  Displays all course assessments that are assigned to a certain user to fill out, usually for professors
	 */
	function displayCourseAssessment($userId, $term)
	{
		echo "<h3>The courses that you are teaching this semester:</h3>";
		$getSections= $this->db->selectStmt_Arr("SELECT section_id FROM section WHERE user_id = ".$userId." AND term = '".$term."'");
		$arrCount= count($getSections);
		for($x = 0; $x < $arrCount; $x++) {
			$getCourseId = $this->db->selectStmt_Arr("SELECT course_id FROM course_section WHERE section_id = ".$getSections[$x]);
			$getSectionNumber = $this->db->selectStmt_Arr("SELECT section_number FROM section WHERE section_id = ".$getSections[$x]);
			$getCourseName = $this->db->selectStmt_Arr("SELECT course_name FROM course WHERE course_id = ".$getCourseId[0]);
			$getCourseNumber = $this->db->selectStmt_Arr("SELECT course_number FROM course WHERE course_id = ".$getCourseId[0]);
			$getAssessment = $this->db->selectStmt_Arr("SELECT complete FROM assessment WHERE section_id = ".$getSections[$x]);
			if($getAssessment[0] == 0)
			{
				//Assessment has not been completed, enter grades
				echo "<div class='entergrades'><p><strong>Course:</strong> ".$getCourseName[0]."</p><p><strong>Course Number-Section:</strong> ".$getCourseNumber[0]."-0".$getSectionNumber[0]."</p><p><strong>Grades Entered:</strong> <span style='color:red'>No</span></p>";
				echo "<button class='btn btn-success' data-toggle='collapse' data-target='#enter".$getSections[$x]."'>Enter Grades</button>";
				echo "<div id='enter".$getSections[$x]."' class='collapse'>";
				echo "<form method='post'><p>Section ID:<input type='text' class='form-control' name='courseID' value='".$getSections[$x]."' readonly/></p><p>Please put a space after each grade:</p><textarea class='form-control' name='grades' rows='4'></textarea><button class='btn btn-success' name='gradesBTN'>Submit Grades</button></form>";
				echo "</div></div>";
			}
			else
			{
				//Assessment has previously been completed
				echo "<div class='entergrades'><p><strong>Course:</strong> ".$getCourseName[0]."</p><p><strong>Course Number-Section:</strong> ".$getCourseNumber[0]."-0".$getSectionNumber[0]."</p><p><strong>Grades Entered:</strong> <span style='color:green'>Yes</span></p></div>";
			}
		}
        echo "<div style='clear:both;'></div>";
		echo "<hr>";
	}
}


?>