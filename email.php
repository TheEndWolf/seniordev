<?php

require_once ("sqlDatabase.php");

class email{
	
 private $db;

  public $subject = "the subject is: Report";
  public $header = "buu";
  public $msg = "Confirming the competion of you report.";


	/*
	*	construct function	
	*	creates connection to a database.
	*/
	public function __construct()
	{
		 $this->db = new sqlDatabase("localhost","root","","pascal_database");
	}
	
	/**
	*	function sends email to confirm completion of evaluation
	*/	
	public function sendEmail($username){
		$userEmail= $this->db->selectStmt_ID("select userEmail from program_user where username = '". $username ."'");
		mail($userEmail, $this->subject, $this->msg, $this->header);
	}


}


?>
