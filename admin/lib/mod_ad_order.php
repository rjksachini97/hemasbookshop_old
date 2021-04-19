<?php  
require_once("dbconnection.php"); 

if(isset($_GET["type"])){
	$type = $_GET["type"];
	$type();
}
 function viewAllAdOrders() {
 	$table = <<<EOT
 				(SELECT abook.ad_book_id,cus.cus_name,amode.newsad_mode,clr.adcolour_name,np.newsp_name,ac.newsac_category,act.adcattype_desc,
 		md.admode_details_size,abook.current_date,abook.adpub_date,abook.ad_description,abook.ad_wc,abook.ad_tot_price,abook.ad_pay_status,
 		abook.ad_book_status FROM tbl_ad_booking abook
			JOIN tbl_reg_customer cus ON abook.cus_id = cus.cus_id
			JOIN tbl_news_ad_mode amode ON abook.newsad_mode_id = amode.newsad_mode_id
			JOIN tbl_ad_colour clr ON abook.adcolour_id = clr.adcolour_id
			JOIN tbl_newspaper np ON abook.newsp_id = np.newsp_id
			JOIN tbl_news_ad_category ac ON abook.newsac_id = ac.newsac_id
			JOIN tbl_news_adcat_type act ON abook.adcattype_id = act.adcattype_id
			JOIN tbl_ad_modes_details md ON abook.admode_details_id = md.admode_details_id WHERE
			abook.ad_book_status=1 ORDER BY ad_book_id
 			)temp
EOT;
 			$primaryKey = 'ad_book_id';

 				$columns = array(
	    			array( 'db' => 'ad_book_id','dt' => 0 ),
	    			array( 'db' => 'cus_name','dt' => 1 ),
	    			array( 'db' => 'current_date','dt' => 2 ),
	    			array( 'db' => 'adpub_date','dt' => 3 ),
	    			array( 'db' => 'ad_tot_price','dt' => 4 ),
	    			array( 'db' => 'ad_pay_status','dt' => 5 )
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