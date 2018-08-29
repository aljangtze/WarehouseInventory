<?php
$page_title = '添加请购单';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
$retData = array();
$retData['result'] = "success";

function returnError($info, $rollback = false)
{
    $errorData = array();
    $errorData['result'] = "error";
    $errorData['info'] = $info;
    if ($rollback == true) {
        global $db;
        $db->rollback();
    }

    echo json_encode($errorData);
}

if(isset($_GET['entry_id']))
{
    $entry_id = $_GET['entry_id'];
    $retData['items'] = get_godown_entry_details_summary_by_id($entry_id);
    echo json_encode($retData);
}

//获取请购单号关联的信息
if (isset($_POST)) {
    if(count($_POST) != 0)
    {
        try {

            $retData[items] = get_godown_entry_summary();

            echo json_encode($retData);
        } catch (Exception $e) {
            returnError($e->getMessage());
        }
    }
    else
    {

    }

}


?>