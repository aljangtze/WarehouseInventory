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
            updateRequestionStatus($items, 1);
            echo json_encode($retData);
            break;
        //获取导出请购单的数据
        case 1:
            $data = getExportDetails($items);
            $retData['data'] = $data;
            echo json_encode($retData);
            break;
    }

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

function getExportDetails($items)
{
    $idList = '';
    $isFirst = true;

    if(count($items)<=0)
        return "{}";

    foreach ($items as $id)
    {
        if($isFirst == true)
        {
            $idList = $idList.$id;
            $isFirst = false;
        }
        else
        {
            $idList = $idList.",".$id;
        }
    }

    $data = get_requestion_details_by_id_list($idList);

    return $data;
}
function get_requestion_details_by_id_list($id_list)
{
    global $db;
    $sql = "select distinct a.requestion_id,a.id, rq.code as requestion_code, u.name as user_name, a.code, pj.name as project_name,  DATE(a.requestion_date) as requestion_date, Date(a.expect_date) as expect_date, 
            a.reference,pt.name as product_type_name,
            b.name, b.specification, concat(b.name, ',', b.specification,',', b.model_number) as product_name, a.memo,
            q.qualification_info,a.is_test, a.is_reprocess, concat(a.requestion_number, ' ', b.unit) as requestion_info,
            b.model_number,  a.requestion_number, a.godown_number, b.unit from requestion_details as a 
            left join project as pj on a.project_id=pj.id
            left join product as b on a.product_id=b.id 
            left join qualification as q on a.qualification_id=q.id
            left join requestion as rq on a.requestion_id=rq.id
            left join product_type as pt on b.type = pt.id
            left join users as u on u.id=rq.initiator
            where a.requestion_id in ({$db->escape($id_list)}) order by a.requestion_id,a.id";

    $result = $db->query($sql);
    $result_set = $db->while_loop($result);

    $jarr = array();
    foreach ($result_set as $result) {
        $count = count($result);//不能在循环语句中，由于每次删除 row数组长度都减小
        for ($i = 0; $i < $count; $i++) {
            unset($result[$i]);//删除冗余数据
        }
        array_push($jarr, $result);
    }

    return $jarr;
}



?>