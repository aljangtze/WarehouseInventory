<?php
$page_title = '请求请购单的概览';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);

$retData = array();
$retData['result'] = "success";
$retData['items'] = array();

function returnError($info)
{
    global $db;
    $errorData = array();
    $errorData['result'] = "error";
    $errorData['info'] = $info;

    echo json_encode($errorData);
}

if(isset($_GET['requestion_id'])) {
    $requestion_id = $_GET['requestion_id'];
	$data = get_requestion_details_by_id($requestion_id);
	$retData['data'] = $data;

//echo "hello";
    echo json_encode($retData);
}
else
{
    returnError("未设置请购号id");
}
?>