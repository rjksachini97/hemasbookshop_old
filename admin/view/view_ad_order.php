<?php     
require("../lib/mod_ad_order.php");  
?>

<script>
	$(document).ready(function(){
		var dataTable = $("#tblviewadorder").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "lib/mod_ad_order.php?type=viewAllAdOrders",
				"type": "POST"
			},
			"columns":[
				{"data":"0"},
				{"data":"1"},
				{"data":"2"},
				{"data":"3"},
				{"data":"4"},
				{"data":"5"
				   "visible":false,
				   "searchable":false},
				{"data":"6"
				   "visible":false,
				   "searchable":false},
				{"data":"7"
				    "visible":false,
					"searchable":false},
			],
			"columnDefs":[
				
				 {
                        "data":"5",
                        "render": function(data,type,row){
                            return(data=="0")?"<button class='btn btn-success btn-sm' title='Send Email'>Send Email</button>":"<button class='btn btn-primary btn-sm' title='view Email'>View Email</button>";
                        },
                        "targets":8
                    },

                    {
					"data":[8],
					"render":function(data,type,row){
						if(data=="0"){
							return "<a href='#' title='completed' ><i class='fas fa-1x text-primary fa-check-double'></i></a> "
						}else{
							return "<p class='text-success'>Completed</p> "
						}
					},
					"targets": 9
				},
				{
                        "target":"8",
                        "render": function(data,type,row){
                            return(target=="0")?"<button class='btn btn-success btn-sm' title='Send SMS'>Send SMS</button>":"<button class='btn btn-primary btn-sm' title='view SMS'>View SMS</button>";
                        },
                        "targets":10
                    },


			/*	{
					"data":"5",
					"render":function(data,type,row){
						if(data=="0"){
							return "<p class='text-success'>Not Completed</p> "
						}else{
							return "<a href='#' title='Send_Message' data-toggle='modal' data-target='#sendsms' ><i class='fas fa-sms'></i></a>"
						}
					},
					"targets": 6
				}, */

				{
					"data":null,
					"defaultContent":"<a href='#' title='view_ad_orders'><i class='fas fa-2x fa-clipboard-list'></i></a> ",
					"targets": 11
				}
				]
		});

	$("#tblviewadorder tbody").on('click','a',function(){ //on command is dynamically content a-anker tag
		var type = $(this).attr('title');
		var data = dataTable.row($(this).parents('tr')).data(); //parents command using for select top data
		var adoid = data[0];

		if(type=="Completed"){
			swal({
				title:"Do you want to confirm this Order?",
				text:"You are trying to confirm this Order!"+adoid,
				icon:"warning",
				buttons:true,
				dangerMode:true
			}).then((willDelete)=>{
				if(willDelete){
					var url = "lib/mod_ad_order.php?type=completeAdOrder";
					$.ajax({
						method:"POST",
						url:url,
						//data:{:adoid},
						dataType:"text",
						success:function(result){

							if(result == 1){
								swal("Successfully Updated!", "success");
								$("#lnkviewadorder").click();
							}
							else{
								swal("Error", "Some problem occured in the system", "error");
							}
						},
						error:function(eobj,etxt,err){
							console.log(etxt);
						}
					});
				}
			});
		}else if(type=="Send_Message"){
			var url = "lib/mod_ad_order.php?type=sendSMS";
			$.ajax({
				method:"POST",
				url:url,
			})
		}



		else if(type=="view_ad_orders"){
			//var url = "lib/mod_ad_order.php?type=";
			$.ajax({
				method:"POST",
				url:url,
				//data:{:adoid},
				dataType:"text",
				success:function(result){
					$("#viewadorderdetails").html(result);
        			$("#viewadordermodel").modal("show");
        		},
        		error:function(eobj,etxt,err){
        			console.log(etxt);
        		}

			});
		}

	});





$("#btnmsgsend").click(function(){
		var fdata = $("#smsform").serialize();
		var url = "../controller/contsms.php?type=sendSMS";

		$.ajax({
			method:"POST",
			url:url,
			data:fdata,
			dataType:"text",
			success:function(result){
			alert(result);
			// if(result=="0"){
			// 	swal("Error","sms not send!","error");
			// }
			// else if(result=="1"){
			// 	swal("Success","message send","success");				 
			// }
			},
			error:function(eobj,etext,err){
				 console.log();
			}
		});
	});









	});
</script>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
    <a href="home.php">Order Management</a>
  </li>
  <li class="breadcrumb-item active">View Ad Order</li>
</ol>
<!--------- Breadcrumb end--------->

<!--------- Heading start--------->
<h2>Ad Orders for the Company</h2><br>
<!--------- Heading end--------->


<table id="tblviewadorder" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Customer Name</th>
      <th>Order Date</th>
      <th>Publish Date</th>
      <th>Total Price</th>
      <th>Status</th>
      <th>Send Email</th>
      <th>Send Message</th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Customer Name</th>
      <th>Order Date</th>
      <th>Publish Date</th>
      <th>Total Price</th>
      <th>Status</th>
      <th>Send Email</th>
      <th>Send Message</th>
	  <th></th>
    </tr>
  </tfoot>
</table>

<!--view full details model-->
<div class="modal fade" id="viewadordermodel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Order Details
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="form-horizontal" id="viewadorderdetails">
							


						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>	
</div>


<!--  --------------Send Email------------- -->

<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="formSendemail"> 
            <div class="modal-header">
                                   
                
                <div class="modal-title" >
                    <h5 >Send Email</h5>                 
                </div>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="msg_body">
                <input type="hidden" name="id" id="id" value="" >
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">name</label>:
                    <input type="email" class="ml-1 col-lg-6 form-control" readonly name="send_name" id="send_name"> 
                </div>
                <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">To</label>:
                    <input type="email" class="ml-1 col-lg-6 form-control" readonly name="send_mail" id="send_mail"> 
                </div>
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">Title</label>:
                    <input type="text" class="ml-1 col-lg-6 form-control" readonly name="send_title" id="send_title">
                </div>
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">Message</label>:
                    <textarea class="ml-1 col-lg-7 form-control " rows="6" id="send_msg" name="send_msg">
                            
                    </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <img src="../resources/img/page-loading.gif" class="d-none" id="load_imag" width='100px'>
                <button type="button" class="btn btn-success"  id="modal_reply_send"> Send</button>

            </div>
            </form>
        </div>
    </div>
</div>



<div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-6 shadow">
		<div align="center"><h5>Send SMS</h5></div>
		<form id="smsform" class="pt-3">
			<label><i class="fas fa-mobile"></i> Enter recepiant number </label>
			<input type="text" name="contactno" id="contactno" placeholder="contact number">
			<label><i class="fas fa-comment"></i> Enter text message </label>
			<input type="text" name="msgtext" id="msgtext" placeholder="enter your text">
			<button type="button" id="btnmsgsend" name="btnmsgsend" class="btn btn-success border border-dark shadow">Send</button>
		</form>
	</div>
	<div class="col-sm-3"></div>
</div> 
<!--   code for send sms  -->
<?php
if(isset($_GET["type"])){
	$type = $_GET["type"];
	$obj = new ContSMS();
	$obj->$type();
}
class ContSMS{
	public $conn;
	function __construct(){
		require_once("../model/connection.php");
		$this->conn= Connection::conn();
	}

	public function sendSMS(){
		$sender_contact = $_POST["contactno"];
		$sms_text = $_POST["msgtext"];

		// echo($sender_contact.$sms_text);

		//Username to login
        $user = "94717228827";

        //Password set
        $password = "4380";

        //Message encoding to avoid space character ommiting
        $text = urlencode("$sms_text");

        //Receiver number
        $to = "$sender_contact";

        //Gateway URL
        $baseurl = "http://www.textit.biz/sendmsg";

        //Setting sending parameter and pass
        $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text&eco=y";

        $ret = file($url);
        $res = explode(":", $ret[0]);
        // Get message delivery status if needed
        if (trim($res[0]) == "OK") {
            echo "Message Sent - ID : " . $res[1];
        } else {
            echo "Sent Failed - Error : " . $res[1];
        }

	}
}
?> 


