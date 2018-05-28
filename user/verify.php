<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once "../config/config.php";

$verify_key = $_GET['verify_key'];

$update_sql = "UPDATE `user` SET `status`=1 WHERE `verify_key`='" . $verify_key . "'";
mysqli_query($link, $update_sql);

mysqli_close($link);

header('Location: ' . $site_url);
?>