<?php 
session_start();
 require_once("lib/dbconnection.php");
 $dbobj=DB::connect();

$cus_id= $_SESSION["session_cus"]["cus_id"];

$sql_cus = "SELECT * FROM tbl_reg_customer WHERE cus_id = '$cus_id'";


$rescus = $dbobj->query($sql_cus);
$cus_info = $rescus->fetch_assoc();

$sqlnp = "SELECT np_book_id, newsp_name, np_tot_price, np_book_status FROM tbl_newspaper_booking WHERE cus_id='$cus_id'";
$sqlad = "SELECT ad_book_id, newsad_mode, ad_tot_price, ad_book_status FROM tbl_ad_booking WHERE cus_id='$cus_id'";

$resnp = $dbobj->query($sqlnp);
$resad = $dbobj->query($sqlad);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Hemas Bookshop</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="images/1.png" rel="icon">
  <link href="images/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

   <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="scripts/sweetalert.min.js"></script>

<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->


  <!-- Template Main CSS File -->
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="scripts/jquery-ui-1.12.1/jquery-ui.min.css">

  
</head>

<body>
<header id="header">
    <div class="container">
      <div class="logo float-left">
        
        <h1 class="text-light"><a href="#intro" class="scrollto"><span><?php echo "Hello!, " . $_SESSION['session_cus']['cus_name']; ?></span></a></h1>

      </div>        
      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
              <li><a href="index.php">Home</a></li> 
              <li><a href="lib/logout.php" id="logout_btn">Logout</a></li>                
        </ul>
      </nav>
      <!-- .main-nav -->
      
    </div>
</header>
  <!-- #header --> 
<section id="services" class="section-bg" style="padding-top: 150px;">
  <div class="container">
  <table style="width:100%;" align="center">
  <tr>
    <th><button class="btn btn-success" id="profile-btn">Profile</button></th> 
    <th><button class="btn btn-success" id="bookings-btn">My Bookings</button></th>
  </tr>  
</table>
</div>
</section>

<!-- /////////////////////////////////Profile infomations///////////////////////////////////// -->

<div class="container">
	
  <div class="row">
    <fieldset class="for-panel" id="panel-profile">
      <legend>Profile Infomation</legend>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-horizontal">
              <label class="col-xs-5 control-label">Name:</label>
                <p class="form-control-static"><?php echo $cus_info["cus_name"]; ?></p>               
               <label class="col-xs-5 control-label">Phone Number: </label>
                <p class="form-control-static"><?php echo $cus_info["cus_mobile"]; ?></p>               
                <label class="col-xs-5 control-label">Address</label>
                  <p class="form-control-static"><?php echo $cus_info["cus_address"]; ?></p>
                 <label class="col-xs-4 control-label">Gender: </label>
                  	<p class="form-control-static"><?php if ($cus_info["cus_gender"]==1){
                        echo "Male";
                      }else{
                        echo "Female";
                      } ?></p>                        
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-horizontal">               
                  <label class="col-xs-4 control-label">Date Of Birth:</label>
                  	<p class="form-control-static"><?php echo $cus_info["cus_dob"]; ?></p>
                  <label class="col-xs-4 control-label">NIC Number:</label>
                  	<p class="form-control-static"><?php echo $cus_info["cus_nic"]; ?></p>
                  <label class="col-xs-4 control-label">Email:</label>
                  		<p class="form-control-static"><?php echo $cus_info["cus_email"]; ?></p>                
              </div>
             </div>
          </div>

          <a href="#Updatemodal" data-toggle="modal" class="btn btn-primary">
              Edit Details
            </a>
        <!--  <a href="#updatepaswrd" data-toggle="modal" class="btn btn-primary">
              Update Password
            </a>  -->
        </fieldset>

        <!-- /////////////////////////////////Booking infomations///////////////////////////////////// -->

        <fieldset class="for-panel" id="panel-bookings">
          <legend>Booking Infomation</legend>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Booking Date</th>
                    <th scope="col">Booking time</th>
                    <th scope="col">Address</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Payment Slip</th>
                    <th scope="col">Slip approve Status</th>
                    <th scope="col">Full payment Status</th>


                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="8" class="bg-info font-weight-bold" style="text-align:center;color:white;border-radius:30px;">
                      Advertisment Bookings
                    </td>
                  </tr>
    </div>


</body>