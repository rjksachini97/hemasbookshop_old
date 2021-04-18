<!--<?php
	/*require_once("dbconnection.php");
	$dbobj = DB::connect();

if(isset($_GET['ischecklogin'])){
	$cus_email = $_POST['email'];
	$cus_pass = md5($_POST['pass']);
	$sql = "SELECT * FROM tbl_reg_customer WHERE cus_email='$cus_email' AND cus_pass='$cus_pass';";
	$resultlogin = $dbobj->query($sql);
	echo $resultlogin->num_rows;
	

}

elseif (isset($_POST['email'])){
	$cus_email = $_POST['email'];
	$cus_pass = md5($_POST['pass']);
	$sql = "SELECT * FROM tbl_reg_customer WHERE cus_email='$cus_email' AND cus_pass='$cus_pass';";
	$resultlogin = $dbobj->query($sql);

	if($resultlogin->num_rows == 1){
		session_start();
		$_SESSION['session_cus'] = $resultlogin->fetch_assoc();
		header("Location: ../index.php#services");
	}
	
}*/

?>  -->

<?php
	require_once("dbconnection.php");
	$dbobj = DB::connect();


if(isset($_GET['ischecklogin'])){

	$cus_email = $_POST['email'];
	$cus_pass = md5($_POST['pass']);
	$sql = "SELECT * FROM tbl_customer WHERE cus_email='$cus_email' AND cus_pass='$cus_pass';";
	$resultlogin = $dbobj->query($sql);
	echo $resultlogin->num_rows;



}else if(isset($_POST['email'])){
	$cus_email = $_POST['email'];
	$cus_pass = md5($_POST['pass']);
	$sql = "SELECT * FROM tbl_customer WHERE cus_email='$cus_email' AND cus_pass='$cus_pass';";
	$resultlogin = $dbobj->query($sql);

	if($resultlogin->num_rows == 1){
		session_start();
		$_SESSION['session_cus'] = $resultlogin->fetch_assoc();
		header("Location: ../index.php#services");
	}
}
?>