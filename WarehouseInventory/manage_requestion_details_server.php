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

    switch ($operateId)
    {
        //更新请购单为已处理
        case 0:
        //
        case 1:
    }
    updateRequestionStatus($items, 1);
    echo json_encode($retData);
}

function updateRequestionStatus($items, $status=0)
{
    global $db;

    if(count($items)<=0)
        return 0;

    $sql = "update requestion set status = case id ";
    $sqlDate = ", flushdate=case id ";
    foreach ($items as $id)
    {
        $sql = $sql." when {$id} then {$status} ";
        $sqlDate = $sqlDate." when {$id} then now() ";
    }
    $sql = $sql."else status end";
    $sqlDate = $sqlDate."else flushdate end";

    $sql = $sql.$sqlDate;
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