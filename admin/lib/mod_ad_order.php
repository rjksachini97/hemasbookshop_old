<?php  
require_once("dbconnection.php"); 

if(isset($_GET["type"])){
	$type = $_GET["type"];
	$type();
}
 function viewAllAdOrders() {
 	$table = <<<EOT
 				(SELECT ado.*,cus.cus_name,abook.adcolour_name,abook.newsp_name,abook.newsac_category,abook.adcattype_desc,abook.admode_details_size,abook.ad_description,abook.ad_wc,abook.ad_pay_status,abook.ad_book_status,email.email_id,email.email_status,sms.sms_id,sms.sms_status FROM tbl_ad_order ado 
					JOIN tbl_reg_customer cus ON ado.cus_id = cus.cus_id
					JOIN tbl_ad_booking abook ON ado.ad_book_id = abook.ad_book_id
                    JOIN tbl_email email ON ado.adorder_id = email.adorder_id
                    JOIN tbl_sms sms ON ado.adorder_id = sms.adorder_id
					WHERE abook.ad_book_status=1 ORDER BY ad_book_id
 			)temp
EOT;
 			$primaryKey = 'adorder_id';

 				$columns = array(
	    			array( 'db' => 'adorder_id','dt' => 0 ),
	    			array( 'db' => 'cus_name','dt' => 1 ),
	    			array( 'db' => 'adorder_date','dt' => 2 ),
	    			array( 'db' => 'publish_date','dt' => 3 ),
	    			array( 'db' => 'adorder_price','dt' => 4 ),
	    			array( 'db' => 'ad_order_status','dt' => 5 ),
	    			array( 'db' => 'email_status','dt' => 6 ),
	    			array( 'db' => 'sms_status','dt' => 7 )
	    			
				);

				// SQL server connection information
				require_once("config.php");
				$host = Config::$host;
				$uname = Config::$db_uname;
				$pass = Config::$db_pass;
				$db = Config::$dbname;

				$sql_details = array(
    			'user' => $uname,
    			'pass' => $pass,
    			'db'   => $db,
    			'host' => $host
	);

	require('ssp.class.php');
 
	echo json_encode(
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null)
	);
}

function completeAdOrder(){
	
}


 






/*function viewAllAdOrders(){ 

	$table = <<<EOT
				( SELECT ao.adorder_id,ao.adorder_date,ao.publish_date,ao.adorder_price,ao.adorder_status,cus.cus_name FROM tbl_ad_order ao JOIN tbl_reg_customer cus ON ao.cus_id = cus.cus_id WHERE ao.adorder_status=1
				)temp
EOT;
				//Table's PrimaryKey
				$PrimaryKey = 'adorder_id';

				$coloumns = array(
					array('db' => 'adorder_id','dt' => 0 ),
					array('db' => 'cus_name','dt' => 1 ),
					array('db' => 'adorder_date','dt' => 2 ),
					array('db' => 'publish_date','dt' => 3 ),
					array('db' => 'adorder_price','dt' => 4 ),
					array('db' => 'adorder_status','dt' => 5 )
				);

				//SQL Server Coonection Information
				require_once("config.php");
				$host = COnfig::$host;
				$uname = COnfig::$db_uname;
				$pass = COnfig::$db_pass;
				$db = Config::$dbname;

				$sql_details = array(
						'user' => $uname,
						'pass' => $pass,
						'db' => $db,
						'host' => $host,
				);

				require("ssp.class.php");

				echo json_encode(
				SSP::complex($_POST, $sql_details, $table, $PrimaryKey, $coloumns, null));

}*/

?>