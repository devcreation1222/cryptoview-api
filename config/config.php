<?php
$host = 'localhost';
$db = 'cryptoview';
$db_user = 'root';
$db_passwd = '';

$link = mysqli_connect($host, $db_user, $db_passwd, $db);

if (!$link) {
    echo 'Database connection was failed.';
    exit;
}

$api_url = "http://localhost/api/";
$site_url = "http://localhost:4200/signin";
$admin_email = 'lesok3333@gmail.com';
?>