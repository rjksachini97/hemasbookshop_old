<?php
require_once("dbconnection.php");

if(isset($_GET["type"])){  
	$type = $_GET["type"];
	$type();
}

/*------------------------get NP Category List----------------------*/
function getNPCategory(){
    $dbobj = DB::connect();

    $sql = "SELECT npcat_id, npcat_category FROM  tbl_newspaper_category;";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    $output .="<option value=''>  All</option>";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['npcat_id']."'>".$row['npcat_category']."</option>";
    }

    echo($output);
    $dbobj->close();
}


function getNewspaper(){
    $npcat_id = $_POST["npcat_id"];
    $dbobj = DB::connect();

    $sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper WHERE npcat_id='$npcat_id'";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['newsp_id']."'>".$row['newsp_name']."</option>";
    }
    $out="<option value=''>***Select Newspaper***</option>";
    echo($out.$output);
    $dbobj->close();
}



function getModesofAd(){
  $dbobj = DB::connect(); 
  $sql = "SELECT newsad_mode_id,newsad_mode FROM tbl_news_ad_mode WHERE newsad_mode_id NOT IN (SELECT newsa_id FROM tbl_newspaper_ad) AND newsad_mode_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["newsad_mode_id"]."'>".$rec["newsad_mode"]."</option>");
    }
  }
  $dbobj->close(); 
}

function getAdColour(){
  $dbobj = DB::connect(); 
  $sql = "SELECT  adcolour_id,adcolour_name FROM tbl_ad_colour WHERE adcolour_id NOT IN (SELECT newsa_id FROM tbl_newspaper_ad) AND adcolour_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["adcolour_id"]."'>".$rec["adcolour_name"]."</option>");
    }
  }
  $dbobj->close(); 
}

function getNewspaperCategories(){
  $dbobj = DB::connect(); 
  $sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper WHERE newsp_id NOT IN (SELECT newsa_id FROM tbl_newspaper_ad) AND newsp_status=1;";

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

function getAdCategories(){
  $dbobj = DB::connect(); 
  $sql = "SELECT newsac_id,newsac_category FROM `tbl_news_ad_category` WHERE newsac_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["newsac_id"]."'>".$rec["newsac_category"]."</option>");
    }
  }
  $dbobj->close(); 
}

function getAdCatDescription(){
  $newsac_id = $_POST["newsac_id"];
  $dbobj = DB::connect();
  
   $sql = "SELECT adcattype_id,adcattype_desc FROM tbl_news_adcat_type WHERE newsac_id='$newsac_id'";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['adcattype_id']."'>".$row['adcattype_desc']."</option>";
    }
    $out="<option value=''>Select Ad Category Description</option>";
    echo($out.$output);
    $dbobj->close();
}

function getAdSize(){
  $dbobj = DB::connect(); 
  $sql = "SELECT admode_details_id,admode_details_size FROM `tbl_ad_modes_details` WHERE admode_details_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["admode_details_id"]."'>".$rec["admode_details_size"]."</option>");
    }
  }
  $dbobj->close(); 
}

/*   lahiru  */

function addNewAdBooking(){
          session_start();

          $cus_id = $_SESSION['session_cus']['cus_id'];
          $newsad_mode = $_POST["txt_npadmode"];
          $adcolour_name = $_POST["txt_npadcolour"];
          $newsp_name = $_POST["txt_npname"];
          $newsac_category = $_POST["txt_npadcat"];
          $adcattype_desc = $_POST["txt_npadcatdes"];
          $admode_details_size= $_POST["txt_npadsize"];
          $adpub_date = $_POST["dtadpublish"];
          $ad_description = $_POST["txtaddress"];
          $ad_wc = $_POST["txt_wc"];
          $ad_tot_price = $_POST[""];
          $ad_book_status = 1;
          $crnt_date = date("Y-m-d");


        /*  $ad_img = $_FILES["imgad"];
          $nic_im = $_FILES["imgupnic"];
          $br_img = $_FILES("imgupbr");
          $tot_price = $_POST["tot_price"];

          $ad_path = "";
          $nic_path = "";
          $br_path = "";  */

    $dbobj = DB::connect();

    $sql = "INSERT INTO tbl_ad_booking (cus_id,newsad_mode,adcolour_name,newsp_name,newsac_category,adcattype_desc, admode_details_size,crnt_date,adpub_date,ad_description,ad_wc,ad_tot_price,ad_pay_status,ad_book_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $dbobj->prepare($sql);

    if(!$stmt->execute()){
        echo(" AdBooking SQL Error: ".$stmt->error);
        exit;
    }else {
        
            $sql_adorder = "INSERT INTO tbl_ad_order (adorder_id,cus_id,newsad_mode,adorder_date,publish_date,adorder_price,adorder_status) VALUES (?,?,?,?,?,?,?)";

            $stmt_adorder= $dbobj->prepare($sql_adorder);
            $stmt_adorder->bind_param("iisssdi",$bat_id,$grn_id,$tbl_prod[$i],$tbl_cprice[$i],$tbl_sprice[$i],$tbl_qty[$i],$tbl_qty[$i],$rdate,$bat_price[$i],$status);
            if(!$stmt_adorder->execute()){
                echo(" Batch SQL Error: ".$stmt_adorder->error);
                exit;
            }
            $stmt_adorder->close();
        }
        echo("1,Order Successfully added");
        $stmt->close();
        $dbobj->close();

    }



 
/*function getBatchDetails(){
  $prodid = $_POST["prodid"];
  $rqty = $_POST["rqty"];
  $dbobj = DB::connect();

  $sql = "SELECT * FROM tbl_batch JOIN tbl_product ON tbl_batch.prod_id=tbl_product.prod_id WHERE tbl_batch.prod_id='$prodid' and tbl_batch.bat_status=1 order by tbl_batch.bat_id ASC;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("0,SQL Error : ".$dbobj->error);
    exit;
  }

  $output = array();
  while($rec=$result->fetch_assoc()){
    $line = array();
    if($rec["bat_qty_rem"]>=$rqty){
      $line[0] = $rec["prod_id"];
      $line[1] = $rec["bat_id"];
      $line[2] = $rec["prod_name"];
      $line[3] = $rec["bat_sprice"];
      $line[4] = $rqty;
      $output[] = $line;
      break;
    }
    else{
      $line[0] = $rec["prod_id"];
      $line[1] = $rec["bat_id"];
      $line[2] = $rec["prod_name"];
      $line[3] = $rec["bat_sprice"];
      $line[4] = $rec["bat_qty_rem"];
      $rqty = $rqty - $rec["bat_qty_rem"];
      $output[] = $line;
    }
  }
  echo(json_encode($output));
  $dbobj->close();
}   */


?>