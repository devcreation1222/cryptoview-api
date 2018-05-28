<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/config.php";

$coinname = $_GET['coinname'];
$state = $_GET['state'];

if ($state == '1') {
    $select_sql = "SELECT * FROM `coin_admin` WHERE `coinname`='" . str_replace(' ', '-', strtolower($coinname)) . "'";
} elseif ($state == '0') {
    $select_sql = "SELECT * FROM `coin_admin` WHERE `coinname`='" . str_replace(' ', '-', strtolower($coinname)) . "' AND state=show";
}

$result = mysqli_query($link, $select_sql);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(array('status' => true));
} else {
    echo json_encode(array('status' => false));
}

mysqli_close($link);
?>