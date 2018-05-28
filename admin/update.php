<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/config.php";

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
for ($i=0; $i < count($request); $i++) { 
    $update_sql = "UPDATE `coin_admin` SET `order_num`='".$i."' WHERE `coinname`='" . str_replace(' ', '-', strtolower($request[$i]->coinname)) . "'";
    mysqli_query($link, $update_sql);
}

echo json_encode(array('message'=>'success update'));
mysqli_close($link);
?>