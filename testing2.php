<?php

require_once ("sqlDatabase.php");
//include_once ("flags.php");
include_once ("report.php");
include_once ("account.php");
//include_once ("enterData.php");
include_once ("statistics.php");
include_once ("email.php");
//include_once ("notes.php");
//include_once ("gettingData.php");
include_once ("printingResultTable.php");

//----------------------------------------Testing----------------------------------------------------------------------------

//-----------------FLAG SCRIPT---------------------
	//$f = new flag();
	//$f->setTaskStream_Flag2();
	//$f->setCustom_Flag("database connectivity");
	//$f->removeFlag("client", 123);

//-----------------REPORT SCRIPT---------------------works
	//$r = new report();
	//$r->generateReport("client", 123);
	//$r->uploadReport("C:/Users/User/Desktop/prevReports1.csv");
	//$r->getCourseData("server", 123);
	//$r->taskStreamReport("server", 123);
	//$r->getReport();
	//$r->exportReport("server","IT","1");
	
//-----------------STATISTCIS SCRIPT---------------------works
	//$stat = new statistics();
	//$stat->showStatistics();
	//$stat->customizedStatistics_changeOverThis("database connectivity", "123", 65);	
	
//-----------------ACCOUNT SCRIPT---------------------works
	$account = new account();
	//$account->createAccount("sime", "simepass", "sime44@gmail.com", "Instructor");	
	$account->login("sime", "simepass");
	
//-----------------ENTER DATA SCRIPT---------------------works
	//$dat = new enterData();
	//$dat->enterScore("niksa", "simic", "database connectivity", 490, 'php1', 65);	
	//$dat->enterGrade("niksa", "simic", "database connectivity", 490, 'B', 84);
	//$dat->enterReportData("Tourism", "60 percent is the objective to get", "becoming a vodic", "02", 700, "final tourism test", 59, 99);//$program_name, $prog_objective, $course_name, $term, $course_num, $CAI,  $overThis, $expected_per_achieved
	//$dat->enterReportData("IT", "60 percent is the objective to get", "blueJ", "02", 331, "midterm test", 59, 99);

	//-----------------EMAIL SCRIPT---------------------
	//$email = new email();
	//$email->sendEmail("niksa.simic8@gmail.com");	
	
		
//-----------------NOTES SCRIPT---------------------works
	//$notes = new notes();
	//$notes->addCourseNotes_instructor("IT", "client", 2, "kike", "This is th e first note it is for the client course");
	//$notes->addCourseNotes_instructor("IB", "marketing", 2, "kike","This is th e first note it is for the marketing course");
	
//--------------------------GETTING DATA--------------------------------------------------	
	//$getData = new gettingData();
	//$getData->getClasses();
	
//--------------------------printing DATA--------------------------------------------------	
	//$data = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
	//$data = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43","ivan"=>"45", "adam"=>"16", "anthony"=>"23", "bill"=>"56", "frane"=>"44");
	//$print = new printingResultTable();
	//getTable1($data);



?>