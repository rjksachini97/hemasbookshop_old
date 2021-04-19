 <?php 
require("../lib/mod_booking_pay.php");
?>
<script>
 $(document).ready(function(){
    var dataTable = $("#tblviewadpay").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "lib/mod_booking_pay.php?type=viewadbookingpay",
            "type": "POST"
        },
        "columns":[
          {"data":"0"},
          {"data":"1"},
          {"data":"2"},
          {"data":"3"},
          ],
        "columnDefs":[

           {
            "data":null,
            "defaultContent": "<a href='#' title='Open_Slip' data-toggle='modal' data-target='#viewSlip'><i class='fas fa-money-check-alt'></i></a>",
            "targets": 4
          },
          {
            "data":"3",
            "render":function(data,type,row){
              return (data=="1")?"Yes":"No";
            },
            "targets": 5
          },

        {
            "data":null,
            "defaultContent": "<a href='#' title='Full_payment'><i class='fas fa-calendar-check'></i></a>",
            "targets": 6
          },
    
        
         
        ]
    });


});


</script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">Payment & Billing</a></li>            
  <li class="breadcrumb-item active">View Ad Booking Payments</li>
</ol>

<!-- New Newspaer Form -->
<h3 class="h3" >View Advertisment Booking Payments</h3>
<hr>
<table id="tblviewadpay" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Cus ID</th>
      <th>Total Price</th>
      <th>Status</th>
      <th>Uploaded Slip</th>
      <th>Fully paid</th>
      <th>Full payment</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
	  <th>ID</th>
      <th>Cus ID</th>
      <th>Total Price</th>
      <th>Status</th>
      <th>Uploaded Slip</th>
      <th>Fully paid</th>
      <th>Full payment</th>
    </tr>
  </tfoot>
</table>


            <!-- View Bank Slip Modal -->
            <div class="modal fade" id="viewSlip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bank Slip</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="view-slip"></div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
