<?php 
require("subheader.php");  

require("lib/mod_ad_booking.php");

require("cmn_booking_navbar.php");
?> 


    <!-- ======= Advertisment Details Section ======= -->
  
    <div class="container" style="padding-top: 100px;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <h3 >Newspaper Booking</h3>
        </li>
      </ol>
    <form id="BookingForm" enctype="multipart/form-data">

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="txt_npname">Newspaper Name<b class="text-danger">*</b></label>
            <select class="form-control col-sm-8" name="txt_npname" id="txt_npname">
              <option value="">-- Select Newspaper --</option>
               <?php getNewspaperCategories(); ?>
            </select>
        </div>
        <div class="form-group col-md-6">
          <label for="dtnporder">Price</label>  
          <div class="col-md-6">
                <input type="hidden"    id="newsp_id" name="newsp_id" >
                <input type="text"  class=" form-control"  id="newsp_price" name="newsp_price" >
          </div> 
        </div>
         
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="txtqty" class="col-sm-5 col-form-label">Quantity<b class="text-danger">*</b></label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="txtqty" name="txtqty" value="">
            </div> 
          </div>
        <div class="form-group col-md-6">
          <label for="dtnporder">Date Of Order<b class="text-danger">*</b></label>  
            <input type="text" id="dtnporder" class="form-control col-sm-4" name="dtnporder" readonly="readonly">
        </div>
      </div>

      <div>
        <div class="align-items-end" >
          <input  type="button" class="btn btn-success col-1" value="Add" id="btn_np_add" name="btn_np_add">
        </div>
      </div>
      <br>

      <div class="container ">
         <table class="table table-sm" width="90%">
            <thead>
            <tr>
                <th></th>
                <th>Newspaper</th>
                <th>Quantity</th>
                <th>Total Price(Rs)</th>

            </tr>
            </thead>

            <tbody id="np_content">

            </tbody>
            <tfoot>

            <tr align="right" >
                <td colspan="2"></td>
                <td > <input type="text" readonly="readonly" class=" form-control form-control-sm text-right"  size="1" id="totqty" name="totqty" value="0"> </td>

                <td  > <input type="text" readonly="readonly" class=" form-control form-control-sm text-right px-3"  size="1" id="txtgtot" name="txtgtot" value="0.00"> </td>
            </tr>

            
            <tr align="right" ><th colspan="3" >Total(Rs)</th>
                <td  > <input type="text" readonly="readonly" class="form-control form-control-sm text-right"  size="2" id="txtntot" name="txtntot" value="0.00"> </td>
            </tr>
            </tfoot>

        </table>
        
          <div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
              <button type="button" class="btn btn-primary" id="btnBooking">Place My Booking</button>
            </div>
          </div>
        </div>
    </form>
</div>
<!-- End Advertismen Details Section -->

<script type="text/javascript"> 
    $(function(){
      $("#dtnporder").datepicker({
        changeYear:true,
        changeMonth:true,
        dateFormat:"yy-mm-dd",
        //maxDate:"-6570" 
        minDate:"10",                                 
    });

        /*----------------------get np price when click newspaper--------------------------   */
        $("#txt_npname").click(function() {  

          var newsp_id = $(this).val(); /* store currnet id of newpaper*/
            if(newsp_id==""){
               $("#newsp_price").html("<option value=''>0</option>");
              }else{
              var url  = "lib/mod_np_booking.php?type=getprice";
                  $.ajax({
            method:"POST",  
            url:url,
            data:{newsp_id:newsp_id},
            dataType:"text",
            success:function (result) {
                $("#newsp_price").html(result);
            },
            error:function (etxt) {
                console.log(etxt);
            }

          });
        }

      });  


     
 $("#btn_np_add").click(function () {

            $npodate = $("#dtnporder").val();
            $np_name = $("#txt_npname").val();
            $np_qty = $("#txtqty").val();
            $totqty = $("#totqty").val();

            if($npodate=="" || $np_name=="" || $np_qty=="" || $totqty==""){
              swal("Error","Please Fill All inputs","error");
                return;
            }
            //sum of curunt quantity and new quantity
            var totqty = parseInt($totqty)+ parseInt($np_qty);
            $("#totqty").val(totqty); //add quantity to total quantity input


            var total = parseFloat($newsp_price) * parseInt($np_qty); // calculate toatal using price and quantity
            total = parseFloat(total).toFixed(2);

            $row= "<tr>";
            $row += "<td><a href='javascript:void(0)' class='btn btn-danger remove' >X</a> </td>";

            $row += "<td><input type='text' class='form-control-plaintext '  readonly value='"+$prod_name+"'>" +
                "<input type='hidden' id='tbl_prod' name='tbl_prod[]'  value='"+$grn_prod+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext'  readonly value='"+$cat_name+"' >" +
                "<input type='hidden' id='tbl_cat' name='tbl_cat[]' value='"+$grn_cat+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right qty' id='tbl_qty' name='tbl_qty[]' readonly value='"+$grn_qty+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right' id='tbl_cprice' name='tbl_cprice[]' readonly value='"+$cost_price+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right' id='tbl_sprice' name='tbl_sprice[]' readonly value='"+$sell_price+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right total' id='bat_price' name='bat_price[]' readonly value='"+total+"' > </td>";

            $row += "</tr>";

            var gtot = parseFloat($("#txtgtot").val()); // input convert to currency
            var ntot = parseFloat($("#txtntot").val()); // input convert to currency

            gtot = parseFloat(gtot)+parseFloat(total);
            ntot = parseFloat(ntot)+parseFloat(total);
            gtot= parseFloat(gtot).toFixed(2);
            ntot= parseFloat(ntot).toFixed(2);


            $("#txtgtot").val(gtot); 
            $("#txtntot").val(ntot);
            $("#selectSup").val($("#grn_sup").val());
            $("#grn_sup").prop("disabled",true);

            $("#grn_content").append($row);
            resetinput();

        });





</script>


<?php
require("subfooter.php");
?>