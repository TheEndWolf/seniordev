<?php


class sqlDatabase{
	//attribute
	private $db;

	/*
	*	function for select statements to the database
	*	@param: select query(sql)
	*/
	public function __construct($host, $username, $password, $databaseName){
		$this->db = mysqli_connect($host, $username, $password);
		if($this->db){
			}
		mysqli_select_db($this->db, $databaseName);
	}

	/*
	*	function for select statements to the database
	*	@param: select query(sql)
	*	returns one field result;
	*/
	public function selectStmt_ID($query){
			return $this->getOneField(mysqli_query($this->db, $query));
	}

		/*
	*	function for select statements to the database
	*	@param: select query(sql)
	*	returns in a html table
	*/
	public function selectStmt_Report($query){
		return $this->viewReport(mysqli_query($this->db, $query));
	}

		/*
	*	function for select statements to the database
	*	@param: select query(sql)
	*	returns an associative array
	*/
	public function selectStmt_Assoc($query){
		return $this->toAssocArray(mysqli_query($this->db, $query));
	}

	/*
	*	function for select statements to the database
	*	@param: select query(sql)
	*	returns in an normal array(1 dimensional)
	*/
	public function selectStmt_Arr($query){
		return $this->toArr(mysqli_query($this->db, $query));
	}

	/*
	*	function for query statements to the database(update,delete,insert)
	*	@param: query(sql)
	*/
	public function queryStmt($query){
	 	return mysqli_query($this->db, $query);
	}

	/*
	*	function to close the database connection
	*/
	public function __destruct(){
		mysqli_close($this->db);
	}

//-----------------------------------------------------VIEW/OUTPUT METHODS---------------------------------------
	/*
	*	function to change resultset into array
	*	@param: result set of sql query
	*/
	public function toAssocArray($res){
		$arr = array();
		$st;
		if($res){
			while($row = mysqli_fetch_assoc($res)){
				$temp = array();
				foreach ($row as $key => $val) {
					 $temp[$key] = $val;    
				}
				array_push($arr, $temp);
			}
			print_r($arr);
			return $arr;
		}
	}

		/*
	*	@param - ResultSet from sql(array) 
	*	returns an normal array(one dimansional)
	*/
	public function toArr($res){
		$arr = array();
		$st = "";
		if($res){
			while($row = mysqli_fetch_row($res)){	
			foreach ($row as $r) {
					    	$st = $r;
					    	array_push($arr, $st);
					    }		    
			}
			print_r($arr);
			return $arr;
		}
	}

	/*
	*	@param - ResultSet from sql(array) 
	*	returns just one row = 'id'
	*	Used with enterGrades function() in enteringGrades.php
	*/
	public function getOneField($res){
		$arr = array();
		$field = "";
		if($res){
			while($row = mysqli_fetch_row($res)){	
			foreach ($row as $r) {
					    	//echo $r;
					    	$field = $r;
					    	//array_push($arr, $field);
					    }		    
			}
			//echo $field;
		return $field;
		}
	}


	/*
	*	function to output resultset in html
	*	@param: result set of sql query
	*	 Used to get report1
	*/
	public function viewReport($res){
		$arr = array();
		$st;
		echo "<table style='border-collapse: collapse; background-color: #fefbd8; border: 2px solid black'> ";
		echo "<tr style='border: 2px solid black; background-color: #80ced6; height: 50px'><th style='border: 2px solid black; width: 150'>% expected</th><th style='border: 2px solid black; width: 150'>% achieved</th><th style='border: 2px solid black; width: 150'>Result</th></tr>";
		while($row = mysqli_fetch_row($res)){
			$classResult = $this->classResult($row[0], $row[1]);
   				echo "<tr style='border: 2px solid black'><td style='height: 30px; text-align: center; width: 10px'>$row[0]</td><td td style='height: 30px; border: 2px solid black; text-align: center; width: 10px'>$row[1]</td><td style='height: 30px; border: 2px solid black; text-align: center; width: 10px'>$classResult</td></tr>";			
		}
		echo "</table> ";
	}


	/*
	*	function to compare variables: expected_percent_achieved, percent_Students_achieved_Obj
	*	returns result(string)
	*/
	public function classresult($expected, $achieved){
		$result;
		if($expected > $achieved){
			$result = "Did not meet";
		}else if($expected < $achieved){
			$result = "exceded";
		}else{
			$result = "met";
		} 

		return $result;
	}

}

?>