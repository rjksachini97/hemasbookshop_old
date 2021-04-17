<?php
require_once("dbconnection.php");

if(isset($_GET["type"])){
	$type = $_GET["type"];
	$type(); 
}

function getEmployeeCount(){
	$dbobj = DB::connect();
	$table = "tbl_employee";

	$sql = "SELECT count(*) FROM $table WHERE emp_status=1;";

	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : " .$dbobj->error);
		exit;
	}
	$rec = $result->fetch_array();
	echo($rec[0]);
	$dbobj->close();
}

function getEmployeeList(){
	$dbobj = DB::connect();
	$table = "tbl_employee";

	$sql = "SELECT emp_id,emp_name FROM $table WHERE emp_status=1;";

	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : " .$dbobj->error);
		exit;
	}
	while($rec = $result->fetch_assoc()){
		echo('<a class="dropdown-item notifi" href="#" title="'.$rec["emp_id"].'">'.$rec["emp_name"].'</a>');
	}
	$dbobj->close();
}

function getUserName(){
	$dbobj = DB::connect();
	$table = "tbl_users";

	$sql = "SELECT usr_name from $table WHERE usr_status=1;";

	$result = $dbobj->query($sql);
}

?>
