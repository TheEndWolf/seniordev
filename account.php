<?php

require_once ("sqlDatabase.php");

class account{

 private $db;

	/*
	*	construct function
	*	creates connection to a database.
	*/
	public function __construct()
	{
		 $this->db = new sqlDatabase("localhost","root","","pascal_database");
	}

	/*
	*	Function to create new accounts
	*/
	public function createAccount($username, $pass, $email, $role){
		$checkUserName= $this->db->selectStmt_Arr("select username from program_user");
		$count = count($checkUserName);
		for ($i=0; $i < $count; $i++) {
			if($username == $checkUserName[$i]){
				die("Username already exists!");
			}
		}
		$RoleID = $this->db->selectStmt_ID("select role_id from role where role_name = '". $role ."'");
		$createAccount = $this->db->queryStmt("INSERT into program_user(username, user_password, userEmail, role_id)values('$username', '$pass', '$email', $RoleID)");
		if($createAccount){
			echo "created new account successfully";
		}else echo "did not create new account";
	}

	/**
	*	function to login in
	*	checks username and password
	*/
	public function login($username, $password){
		$verifyUser = $this->db->selectStmt_ID("select username from program_user where username = '". $username ."' and password = '".$password."'");
		if($verifyUser = 1){
			echo "Logged in successfully";
		}
	}


}


?>
