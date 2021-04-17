<?php
require_once("dbconnection.php"); 

if(isset($_GET["type"])){ 
	$type = $_GET["type"];
	$type();
}

function getNewOrderId(){  
  $dbobj = DB::connect();
  $sql = "SELECT sample_id FROM tbl_sample_data ORDER BY sample_id DESC LIMIT 1;";
  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

  $dbobj->close();
  
}

/*function getNPDetails(){
  $sampleid = $_POST["sampleid"];
  $qty = $_POST["qty"];
  $dbobj = DB::connect();

  $sql = "SELECT newsp_id,newsp_name,newsp_price FROM tbl_newspaper;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("0,SQL Error : ".$dbobj->error);
    exit;
  }

  $output = array();
  while($rec=$result->fetch_assoc()){
    $line = array(
    
      $line[0] = $rec["newsp_name"];
      $line[1] = $qty;
      $line[2] = $rec["newsp_price"];
      $output[] = $line;
      break;
 );   
    
  }
  echo(json_encode($output));
  $dbobj->close();
}*/

function getNewspaperCategories(){
  $dbobj = DB::connect(); 
  $sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper WHERE newsp_id NOT IN (SELECT newsa_id FROM tbl_newspaper_booking) AND newsp_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["newsp_id"]."'>".$rec["newsp_name"]."</option>");
    }
  }
  $dbobj->close(); 
}



function getNPSave(){
  //$id = $_GET[""];
  $name = $_POST["txt_npname"];
  $qty = $_POST["txt_npqty"];

   $dbobj = DB::connect();

  $sql = "INSERT INTO tbl_sample_data (newsp_id,sample_qty) VALUES (?,?);";

      $stmt = $dbobj->prepare($sql);
      $stmt->bind_param("si",$name,$qty);

        if(!$stmt->execute()){
        echo("0,SQL Error : ".$stmt->error);
        }
        else{

        echo("1,Successfully Reserved!");
        }

        $stmt->close();
        $dbobj->close();
                
}

function viewSave(){
  //echo("viewEmp");
  // DB table to use
  $table = 'tbl_sample_data';
 
  // Table's primary key
  //$primaryKey = 'sample_id';

  $columns = array(
      array( 'db' => 'newsp_id', 'dt' => 0 ),
      array( 'db' => 'sample_qty',  'dt' => 1 ) 
  );

  // SQL server connection information
  require_once("config.php");
  $host = Config::$host;
  $user = Config::$db_uname;
  $pass = Config::$db_pass;
  $db = Config::$dbname;

  $sql_details = array(
      'user' => $user,
      'pass' => $pass,
      'db'   => $db,
      'host' => $host
  );

  require('ssp.class.php');
  
  echo json_encode(
    SSP::complex($_POST, $sql_details, $table, $primaryKey,$columns, null,"sample_status=1" )
  );
}
/*

// update Save
function updateEmp(){
  $emp_id = $_POST["txteid"];
  $emp_title = $_POST["cmbtitle"];
  $emp_name = $_POST["txtname"];
  $emp_dob = $_POST["dtpdob"];
  $emp_gender = $_POST["optgen"];
  $emp_address = $_POST["txtaddress"];
  $emp_tel = $_POST["txttel"];
  $emp_email = $_POST["txtemail"];
  $emp_nic = $_POST["txtnic"];
  $emp_doj = $_POST["dtpdoj"];


  $dbobj = DB::connect();

  $sql = "UPDATE tbl_employee SET emp_title=?, emp_name=?, emp_dob=?, emp_gender=?, emp_address=?, emp_mobile=?, emp_email=?, emp_nic=?, emp_doj=? WHERE emp_id=?";

  /*$sql = "UPDATE tbl_employee SET emp_title='$emp_title', emp_name='$emp_name', emp_dob='$emp_dob', emp_gender='$emp_gender', emp_address='$emp_address', emp_mobile='$emp_tel', emp_email='$emp_email', emp_nic='$emp_nic',emp_doj='$emp_doj' WHERE emp_id='$emp_id'";*/

  /*$sql = "INSERT INTO tbl_employee(emp_id,emp_title,emp_name,emp_dob,emp_gender,emp_address,emp_mobile,emp_email, emp_nic,emp_doj) VALUES(?,?,?,?,?,?,?,?,?,?);";*/

 /*

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("ississssss",$emp_title,$emp_name,$emp_dob,$emp_gender,$emp_address,$emp_tel,$emp_email,$emp_nic,$emp_doj,$emp_id);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Updated!");
  }
  $stmt->close();
  $dbobj->close();
}
*/
function deleteSave(){
  $sampleid = $_POST["sampleid"];
  
  $dbobj = DB::connect();
  $sql = "UPDATE tbl_sample_data SET sample_status=0  WHERE sample_id=?";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("s",$sampleid);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    /*$sql_new = "UPDATE tbl_users SET usr_status=0 WHERE usr_name=(SELECT emp_email from tbl_employee WHERE emp_id=?)";
    $stmt_new= $dbobj->prepare($sql_new);
    $stmt_new->bind_param("s",$sampleid);
    $stmt_new->execute();
    $stmat_new->close();*/
    echo("1,Successfully Removed!");
  }
  $stmt->close();
  $dbobj->close();


}


/*function getNPSave(){
  $dbobj = DB::connect();
  $sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper;";

  $statement = $connect->prepare($sql);

  $statement->execute();

  $result = $statement->fetchAll();
}*/

?>