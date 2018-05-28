<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/config.php";

$identify = $_GET['identify'];
$password = $_GET['password'];

$select_sql = "SELECT * FROM user WHERE (username='" . $identify . "' OR email='" . $identify . "') AND password='" . md5($password) . "' AND status=1";
$sql_result = mysqli_query($link, $select_sql);
$row = mysqli_fetch_array($sql_result);

if (count($row) > 0) {
    $user_data = array('username' => $row['username'], 'user_role' => $row['user_role']);
    echo json_encode(array('status' => 'success', 'data' => $user_data));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Failed to signin'));
}

mysqli_close($link);
?>