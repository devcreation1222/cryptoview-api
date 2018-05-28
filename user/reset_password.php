<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/config.php";

$user_id = $_GET['id'];
$password = $_GET['password'];

$update_sql = "UPDATE `user` SET `password`='" . $password . "' WHERE `user_id`=" . $user_id;

mysqli_query($link, $update_sql);

mysqli_close($link);

header('Location: ' . $site_url);
?>
