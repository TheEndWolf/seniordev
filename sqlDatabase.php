<?php

class sqlDatabase{
	//connection attribute
	private $db;

	/*
	*	construct function
	*/
	public function __construct($host, $username, $password, $databaseName){
		$this->db = mysqli_connect($host, $username, $password);
		if($this->db){
			}
		mysqli_select_db($this->db, $databaseName);
	}

	/*
	*	function: select statement
	*	returns: 1 result(one field)
	*/
	public function selectStmt_ID($query){
			return $this->getOneField(mysqli_query($this->db, $query));
	}

	/*
	*	function: select statement
	*	returns results in a html table
	*/
	public function selectStmt_Report($query){
		return $this->viewReport(mysqli_query($this->db, $query));
	}

	/*
	*	function: select statement
	*	returns an associative array
	*/
	public function selectStmt_Assoc($query){
		return $this->toAssocArray(mysqli_query($this->db, $query));
	}

	/*
	*	function select statement
	*	returns an array
	*/
	public function selectStmt_Arr($query){
		return $this->toArr(mysqli_query($this->db, $query));
	}

	/*
	*	function: query statements(update,delete,insert)
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
	*	param: sql resultset
	*	returns associative array
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
			//print_r($arr);
			return $arr;
		}
	}
	
	/*
	*	param: sql resultset
	*	returns an array
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
			//print_r($arr);
			return $arr;
		}
	}

	/*
	*	param: sql resultset
	*	returns an 1 result(1 field)
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
	*	param: result set of sql query
	*	Used with showStatistics() method
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
