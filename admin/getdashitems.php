<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/config.php";

$state = $_GET['state'];

$coin_api_url = 'https://api.coinmarketcap.com/v1/ticker/';

if ($state == '1') {
    $select_sql = "SELECT * FROM `coin_admin` WHERE coinname <> '' ORDER BY `order_num`";
} elseif ($state == '0') {
    $select_sql = "SELECT * FROM `coin_admin` WHERE state='show' AND coinname <> '' ORDER BY `order_num`";
}

$sql_result = mysqli_query($link, $select_sql);
$i = 0;

$btc_data = file_get_contents($coin_api_url . 'bitcoin/?convert=EUR');
$btc_data = mb_substr($btc_data, strpos($btc_data, '{'));
$btc_data = mb_substr($btc_data, 0, -1);
$btc_data = json_decode($btc_data);
$btc_data = json_encode($btc_data);
$btc_data = json_decode($btc_data);
$btc_usd_price_change = $btc_data->percent_change_24h;

while ($row = mysqli_fetch_array($sql_result)) {
    $coin_data = file_get_contents($coin_api_url . $row['coinname'] . '/?convert=EUR');
    $coin_data = mb_substr($coin_data, strpos($coin_data, '{'));
    $coin_data = mb_substr($coin_data, 0, -1);
    $coin_data = json_decode($coin_data);
    $coin_data = json_encode($coin_data);
    $coin_data = json_decode($coin_data);
    
    $data[$i]['name'] = $coin_data->name;
    $data[$i]['symbol'] = $coin_data->symbol;
    $data[$i]['btcPrice'] = $coin_data->price_btc;
    $data[$i]['usdPrice'] = $coin_data->price_usd;
    $data[$i]['btcPercentChange'] = $btc_usd_price_change + $coin_data->percent_change_24h;
    $data[$i]['usdPercentChange'] = $coin_data->percent_change_24h;
    $data[$i]['btcPercent'] = (($coin_data->price_btc / $row['price']) - 1) * 100;
    $data[$i]['potentialPercent'] = $row['percentage'];
    $data[$i]['description'] = $row['description'];
    $i++;
}
echo json_encode($data);

mysqli_close($link);
?>