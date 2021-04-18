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
</body>