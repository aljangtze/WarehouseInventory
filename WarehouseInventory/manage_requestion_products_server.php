<?php
$page_title = '获取请购材料的详情';
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

//获取请购单号关联的信息
if (isset($_POST)) {
    $operateId = $_POST['operate_id'];
    $items = $_POST['data'];

    $supplier_id =  $_POST['supplier_id'];
    switch ($operateId)
    {
        //更新请购单为已处理
        case 0:
            //
        case 1:
    }
    updateRequestionStatus($items,$supplier_id);
    echo json_encode($retData);
}

function updateRequestionStatus($items, $supplier_id)
{
    global $db;

    if(count($items)<=0)
        return 0;

    $sql = "update requestion_details set supplier_id = case id ";
    $sqlDate = ", refreshTime=case id ";
    $sqlStatus = ", status=case id ";
    foreach ($items as $id)
    {
        $sql = $sql." when {$id} then {$supplier_id} ";
        $sqlDate = $sqlDate." when {$id} then now() ";
        $sqlStatus = $sqlStatus." when {$id} then 1 ";
    }
    $sql = $sql."else supplier_id end";
    $sqlDate = $sqlDate."else refreshTime end";
    $sqlStatus = $sqlStatus."else status end";

    $sql = $sql.$sqlDate.$sqlStatus;
    $result = $db->query($sql);
    if($result)
    {
        return $db->affected_rows();
    }
    else
        return 0;
    //return ($result && $db->affected_rows() === 1 ? true : false);

}

?>