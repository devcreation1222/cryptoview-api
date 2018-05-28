<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/config.php";

$coinname = $_GET['coinname'];

$delete_sql = "DELETE FROM coin_admin WHERE coinname='" . str_replace(' ', '-', strtolower($coinname)) . "'";

if (mysqli_query($link, $delete_sql)) {
    echo json_encode(array('status'=>'success', 'message'=>'Deleted successfully.'));
} else {
    echo json_encode(array('status'=>'error', 'message'=>'Failed to delete.'));
}

mysqli_close($link);
?>