<?php
require("subheader.php");

require("cmn_booking_navbar.php");

require("lib/mod_np_booking.php");

require_once("lib/dbconnection.php");

//$newID=getNewOrderId();

/*include('lib/dbconnection.php');

$sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper WHERE newsp_id NOT IN (SELECT newsa_id FROM tbl_newspaper_ad) AND newsp_status=1;";

$statement = $connect->prepare($sql);

$statement->execute();

$result = $statement->fetchAll();  */

?>

<style type="text/css">
  .currency{
    text-align: right;
  }
</style>


    <!-- ======= Newspaper Booking Details Section ======= -->
<div class="container" style="padding-top: 100px;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <h3 >Newspaper Booking</h3>
    </li>
  </ol>

 <form id="BookingForm">

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="txt_npname">Newspaper Name<b class="text-danger">*</b></label>
            <select class="form-control col-sm-8" name="txt_npname" id="txt_npname">
              <option>-- Select Newspaper --</option>
                                  <?php getNewspaperCategories(); ?>
            </select>
        </div>
        
        <div class="form-group col-md-6">
          <label for="dtadpublish">Date Of Publish<b class="text-danger">*</b></label>                            
            <input type="text" id="dtadpublish" class="form-control col-sm-4" name="dtadpublish" readonly="readonly">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="txt_npadmode">Modes of Advertisment<b class="text-danger">*</b></label>
            <select class="form-control col-sm-8" name="txt_npadmode" id="txt_npadmode">
              <option>-- Select Ad Mode--</option>
                <?php getModesofAd(); ?>
            </select>
        </div>
        <div class="form-group col-md-6">
        <label for="txt_npadcolour">Colour<b class="text-danger">*</b></label>
          <select class="form-control col-sm-8" name="txt_npadcolour" id="txt_npadcolour">
            <option>-- Select Colour --</option>
              <?php getAdColour(); ?>
          </select>
      </div>
      <div class="form-group col-md-6">
        <label for="txt_npadsize">Size<b class="text-danger">*</b></label>
          <select class="form-control col-sm-8" name="txt_npadsize" id="txt_npadsize">
            <option>-- Select Size --</option>
              <?php getAdSize(); ?>
          </select>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="txt_npadcat">Category of Advertisment<b class="text-danger">*</b></label>
          <select class="form-control col-sm-8" name="txt_npadcat" id="txt_npadcat">
            <option>-- Select Ad Category--</option>
              <?php getAdCategories(); ?>
          </select>
      </div>
      <div class="form-group col-md-6">
        <label for="txt_npadcatdes">Description of Ad Category<b class="text-danger">*</b></label>
          <select class="form-control col-sm-8" name="txt_npadcatdes" id="txt_npadcatdes">
            <option>-- Select Ad Category Description--</option>
              <?php getAdCatDescription(); ?>
          </select>
      </div>    
    </div>




    <div class="form-row">
      <div class="form-group col-md-10">
        <label for="txtaddress">Description of Ad <b class="text-danger">*</b></label>
          <textarea type="text" class="form-control" name="txtaddress" id="txtaddress" placeholder="Type your Advertisment here"></textarea>
      </div>  
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="txt_wc">Word Count<b class="text-danger">*</b></label>
          <input type="text" class="form-control col-sm-8" id="txt_wc" name="txt_wc" value="">
      </div>
    </div>


    <div class="form-group row">
        <label for="imgad" class="col-sm-4 col-form-label">Upload Advertisment Image</label>
          <div class="col-sm-3">
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
            <input type="file" class="form-control-file" name="imgad" id="imgad"  accept="image/*">
          </div>
            <div style="padding-left: 180px; padding-right: 20px">
              <small id="passwordHelpBlock" class="form-text text-muted">*Only applicable for Photo classified advertisments
              </small>
            </div>
      </div>

    <div class="form-group row">
      <label for="imgupnic" class="col-sm-4 col-form-label">Upload Image of NIC<b style="color: red">*</b></label>
        <div class="col-sm-3">
          <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
          <input type="file" class="form-control-file" name="imgupnic" id="imgupnic"  accept="image/*">
        </div>
    </div>

    <div class="form-group row">
        <label for="imgupbr" class="col-sm-4 col-form-label">Upload Image of Business Registartion Certificate<b style="color: red">*</b></label>
          <div class="col-sm-3">
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
            <input type="file" class="form-control-file" name="imgupbr" id="imgupbr"  accept="image/*">
          </div>
    </div>

    <div class="form-group" style="padding-top: 50px;">
      <label for="tot_price">Total Price</label>
      <input type="text" class="form-control col-sm-2" id="tot_price" name="tot_price" readonly="readonly" value="00.00">
    </div> 

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="ck_agree">
          <label class="form-check-label" for="ck_agree">I agree to the Pay Half of the total Package fee as retainer to hold the date.</label>
    </div>

    <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
        <button type="button" class="btn btn-primary" id="btnBooking" disabled>Place My Booking</button>
    </div>
  </form>

</div>



   

      <!-- End Newspaper Booking Details Section -->
<script type="text/javascript">
  $(document).ready(function(){

    $("#btnadd").click(function(){
        var sid = $("#txtproid").val();
        var name = $("#txt_npname").val();
        var qty = parseInt($("#txt_npqty").val());

        if(name==""){
          swal("Invalid Input", "Please select the Newspaper", "error");
          return;
        }
        if(qty==0){
          swal("Error","Quantity Cannot be Zero","error");
          return;
        }

       // var url = "lib/mod_np_booking.php?type=getNPDetails";

        $.ajax({
                      method:"POST",
                      url:url,
                      data:{sampleid:sid,qty:qty},
                      dataType:"json",
                      success:function(result){
                        for(i=0;i<result.length;i++){
                          var name = result[i][0];
                          var qty = parseFloat(result[i][1]);
                          
                          var nprice = parseFloat(result[i][2]);
                          
                          var total = nprice*qty;
                          
                          var ntot = parseFloat($("#txtntot").val());

                          var row ="<tr>";
                          
                          row += "<td><a href = 'javascript:void(0)'><i class= 'fa fa-times remove' aria-hidden='true'style= 'color:red' ></i></a></td>";

                          row +="<td><input type='text' class ='form-control' readonly='readonly' size='2' value='"+name+"' name='txtnpname[]'/></td>";

                          row +="<td><input type='text' class ='form-control' readonly='readonly' size='2' value='"+qty+"' name='txtnpqty[]'/></td>";

                          row +="<td><input type='text' class ='form-control' readonly='readonly' size='2' value='"+nprice+"' name='txtsnprice[]'/></td>";

                          

                          row +="<td><input type='text' class ='form-control total currency' readonly='readonly' size='2' value='"+total+"' name='txtstotal[]'/></td>";
                          
                          row += "</tr>";
                          ntot = ntot + total;
                          $("#txtntot").val(ntot);
                          $("#sampledetails").append(row);
                          resetCtrl();
                        }
                                                
                      },
                      error:function(eobj,etxt,err){
                        console.log(etxt);
                      }
          });

      });
    
</script>




<?php
require("subfooter.php");
?>


