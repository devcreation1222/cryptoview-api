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

$coinname = $request->coinname;
$price = $request->price;
$percentage = $request->percentage;
$description = $request->description;
$state = $request->state;
$date = date('Y-m-d');

$select_coinname_sql = "SELECT `id` FROM `coin_admin` WHERE `coinname`='" . str_replace(' ', '-', strtolower($coinname)) . "'";

$select_coinname = mysqli_query($link, $select_coinname_sql);

if (mysqli_num_rows($select_coinname) > 0) {
    $update_sql = "UPDATE `coin_admin` SET `coinname`='".str_replace(' ', '-', strtolower($coinname))."', `c_date`='".$date."', `price`='".floatval($price)."', `percentage`='".floatval($percentage)."', `description`='".$description."', `state`='".$state."' WHERE `coinname`='" . str_replace(' ', '-', strtolower($coinname)) . "'";
    
    if (mysqli_query($link, $update_sql)) {
        echo json_encode(array('status'=>'success', 'message'=>'Updated successfully.'));
    } else {
        echo json_encode(array('status'=>'error', 'message'=>'Failed to update.'));
    }

} else {
    $max_sql = mysqli_query($link, 'SELECT MAX(order_num) AS max FROM `coin_admin`');
    $max = mysqli_fetch_array($max_sql);
    $order_num = $max['max'] + 1;
    $insert_sql = "INSERT INTO `coin_admin` (`coinname`, `c_date`, `price`, `percentage`, `description`, `state`, `order_num`) VALUES ('".str_replace(' ', '-', strtolower($coinname))."', '".$date."', '".floatval($price)."', '".floatval($percentage)."', '".$description."', '".$state."', '".$order_num."')";

    if (mysqli_query($link, $insert_sql)) {
        echo json_encode(array('status'=>'success', 'message'=>'Registered successfully.'));
    } else {
        echo json_encode(array('status'=>'error', 'message'=>'Failed to register.'));
    }
}

mysqli_close($link);
?>