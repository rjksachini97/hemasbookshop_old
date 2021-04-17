<?php    
require_once("config.php"); 
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type(); 
}

/*---------------------------------Inventry Reports-----------------------------------------*/

function stockSummary(){
    $table = "tbl_newspaper";

    $primary_key ="newsp_id" ;

    $columns = array(
        array( 'db' => 'newsp_id', 'dt' => 0 ),
        array( 'db' => 'newsp_name',  'dt' => 1 ),
        array( 'db' => 'newsp_qty',   'dt' => 2 ),
        array( 'db' => 'newsp_rlevel',   'dt' => 3 ),
        array( 'db' => 'npcat_id',   'dt' => 4 ),
    );
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
        SSP::complex($_POST, $sql_details, $table, $primary_key, $columns)
    );
}
 function lowStockSummary(){
    $table = "tbl_newspaper";

    $primary_key ="newsp_id" ;

    $columns = array(
        array( 'db' => 'newsp_id', 'dt' => 0 ),
        array( 'db' => 'newsp_name',  'dt' => 1 ),
        array( 'db' => 'newsp_qty',   'dt' => 2 ),
        array( 'db' => 'newsp_rlevel',   'dt' => 3 ),
        array( 'db' => 'npcat_id',   'dt' => 4 ),
    );
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
        SSP::complex($_POST, $sql_details, $table, $primary_key, $columns,"newsp_qty < newsp_rlevel")
    );

 }

/*---------------------------------Income Inventory------------------------------*/

function incomeInventory($sdate,$edate){

    $dbobj = DB::connect();

    $sql = "SELECT bat.*,np.newsp_name FROM tbl_batch bat JOIN tbl_newspaper np ON np.newsp_id = bat.newsp_id WHERE bat_rdate BETWEEN '$sdate' AND '$edate' ORDER BY bat_rdate ";

    $result = $dbobj->query($sql);

    $output = "";
    $i=1;
    if($result->num_rows =="0"){
        $output .="<tr><td>No data<td></tr>";
    }else{
        while ($rec = $result->fetch_assoc()) {
            $output .= "<tr>
                            <td>".$i."</td>
                            <td>".$rec['bat_rdate']."</td>
                            <td>".$rec['newsp_name']."</td>
                            <td>".$rec['bat_qty']."</td>
                            <td>".$rec['bat_rem']."</td>

                        </tr>";
                        $i++;
        }
    }

    $result = $dbobj->query($sql);

    $output = "";
    $i=1;
    if($result->num_rows =="0"){
        $output .="<tr><td>No data</td></tr>";
    }else{
        while ($rec = $result->fetch_assoc()) {
            $output .="<tr>
                            <td>".$i."</td>
                            <td>".$rec['bat_rdate']."</td>
                            <td>".$rec['newsp_name']."</td>
                            <td>".$rec['bat_qty']."</td>
                            <td>".$rec['bat_rem']."</td>
                        </tr>";
                        $i++;
        }
    }
    echo $output;
    $dbobj->close();

}

/*---------------------------------Expenses Reports-----------------------------------------*/
function numberOrderByYear(){

    $year = $_GET['year'];

    

    $dbobj=DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), count(inv_id) FROM tbl_invoice WHERE YEAR(inv_date) ='$year' AND inv_status != '0' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);
    $data_point =array();
    while($row= $result->fetch_assoc()){
        $point = array();
        $point['label'] = $row['MONTHNAME(inv_date)'];
        $point['value'] = $row['count(inv_id)'];


        array_push($data_point,$point);
    }
    header('Content-type: application/json');
    echo json_encode($data_point);
    $dbobj->close();

}

/*function npOrderByDay(){

   $category = $_GET['category'];

    

    $dbobj=DB::connect();
    $sql ="SELECT newp_name, count(newsp_id) FROM tbl_newspaper WHERE npcat_id ='$category'" ;
    $result = $dbobj->query($sql);
    $data_point =array();
    while($row= $result->fetch_assoc()){
        $point = array();
        $point['label'] = $row['newsp_name'];
        $point['value'] = $row['newsp_id'];


        array_push($data_point,$point);
    }
    header('Content-type: application/json');
    echo json_encode($data_point);
    $dbobj->close();

}
*/




?>