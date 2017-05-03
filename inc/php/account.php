<?php

require_once("sqlDatabase.php");

class account{
	
 private $db;

	/*
	*	construct function	
	*	creates connection to a database.
	*/
	public function __construct()
	{
		$this->db = new sqlDatabase(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	}
	
	/*
	*	Function to create new accounts
	*/
	public function createAccount($username, $pass, $email, $role, $fname, $lname){
		$checkUserName= $this->db->selectStmt_Arr("select username from program_user");
		$count = count($checkUserName);
		for ($i=0; $i < $count; $i++) { 
			if($username == $checkUserName[$i]){
				echo "Username already exists!";
				return;
			}
		}
		//$RoleID = $this->db->selectStmt_ID("select role_id from role where role_name = '". $role ."'");
		$createAccount = $this->db->queryStmt("INSERT into program_user(username, user_password, userEmail, role_id,first_name,last_name)values({$username}, {$pass}, {$email}, {$role}, {$fname}, {$lname})");
		if($createAccount){
			echo "Created new account successfully";
			$_POST = array();
		}else {
			echo "Error creating new account";
		}

	}

	/**
	*	function to login in
	*	checks username and password
	*/
	public function login($username, $password){
		$verifyUser = $this->db->selectStmt_ID("select username from program_user where username = '". $username ."' and user_password = '".$password."'");
		if($verifyUser){
			echo "Logged in successfully";
		}else echo "not working";
	}


}


?>