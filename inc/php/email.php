<?php

require_once("sqlDatabase.php");

class email{
	
 private $db;

 // public $subject = "the subject is: Report";
//  public $header = "buu";
 // public $msg = "Confirming the competion of you report.";


	/*
	*	construct function	
	*	creates connection to a database.
	*/
	public function __construct()
	{
		// $this->db = new sqlDatabase("localhost","root","","pascal_database");
		$this->db = new sqlDatabase("localhost","pascal_web","fr1end","Pascal_Finito");
	}
	
	/**
	*	function sends email to confirm completion of evaluation
	*/	
	public function sendEmail($username){
	 $subject = "the subject is: Report";
	 $header = "buu";
	 $msg = "Confirming the competion of you report.";
	 
		$userEmail= $this->db->selectStmt_ID("select userEmail from program_user where username = '". $username ."'");
		//mail($userEmail, $subject, $msg, $header);
		if(mail($userEmail, $subject, $msg, $header)){
			echo "Email was sent successfully";
		}else echo "Email not sent";
	}


}


?>