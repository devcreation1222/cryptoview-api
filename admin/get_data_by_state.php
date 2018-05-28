<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/config.php";

$state = $_GET['state'];

if ($state == '1') {
    $select_sql = "SELECT * FROM `coin_admin` WHERE coinname <> '' ORDER BY `order_num`";
} elseif ($state == '0') {
    $select_sql = "SELECT * FROM `coin_admin` WHERE state='show' AND coinname <> '' ORDER BY `order_num`";
}
$sql_result = mysqli_query($link, $select_sql);
$i = 0;
while ($row = mysqli_fetch_array($sql_result)) {
    $data[$i]['coinname'] = $row['coinname'];
    $data[$i]['c_date'] = $row['c_date'];
    $data[$i]['price'] = $row['price'];
    $data[$i]['percentage'] = $row['percentage'];
    $data[$i]['description'] = $row['description'];
    $data[$i]['state'] = $row['state'];
    $i++;
}
echo json_encode($data);

mysqli_close($link);
?>