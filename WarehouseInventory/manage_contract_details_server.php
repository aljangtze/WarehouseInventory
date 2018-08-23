<?php
$page_title = '请求请购单的概览';
require_once('includes/load.php');

$retData = array();
$retData['result'] = "success";
$retData['info'] = "success";

function returnError($info, $rollback = true)
{
    global $db;
    $errorData = array();
    $errorData['result'] = "error";
    $errorData['info'] = $info;

    if ($rollback)
        $db->rollback();

    echo json_encode($errorData);
}

function get_contact_requestion_details_by_id($contract_id)
{
    global $db;
    $sql = "select a.id as requestion_detail_id, ce.code as contract_code, rq.code as requestion_code, pj.name as project_name, a.requestion_id, DATE(a.requestion_date) as requestion_date, Date(a.expect_date) as expect_date, 
            a.reference,pt.name as product_type_name,
            b.name, b.specification, concat(b.name, ',', b.specification,',', b.model_number) as product_name, a.memo,
            q.qualification_info,a.is_test, a.is_reprocess, concat(a.requestion_number, ' ', b.unit) as requestion_info, concat(a.godown_number, ' ', b.unit) as godown_info, 
            b.model_number,  a.requestion_number, a.godown_number, b.unit from requestion_details as a 
            left join project as pj on a.project_id=pj.id
            left join product as b on a.product_id=b.id 
            left join qualification as q on a.qualification_id=q.id
            left join requestion as rq on a.requestion_id=rq.id
            left join product_type as pt on b.type = pt.id
            left join contract_entry_details as cd on cd.requestion_details_id=a.id
            left join contract_entry as ce on cd.contract_id=ce.id
            where cd.contract_id={$db->escape($contract_id)} order by ce.code,rq.code";

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

if (isset($_GET['entry_id'])) {
    $requestion_id = $_GET['entry_id'];
    $data = get_contact_requestion_details_by_id($requestion_id);
    $retData['data'] = $data;

    echo json_encode($retData);
    return;
}

function get_contract_code()
{
    global $db;
    $sql = $db->query("SELECT number+1 as number, year, concat('CON', concat(year, LPAd(number+1, 4, '0'))) as code FROM contract_entry_code where year=year(now()) order by year,number desc limit 1");
    if ($result = $db->fetch_assoc($sql))
        return $result;
    else
        return null;
}

function updateContact($items, $status)
{
    global $db;
    //$db->transaction();

    $sql = "update contract_entry set status = case id ";
    $sqlOperator = ", operator=case id ";
    foreach ($items as $id)
    {
        $sql = $sql." when {$id} then {$status} ";
        $sqlOperator = $sqlOperator." when {$id} then {$_SESSION['user_id']} ";
    }

    $sql = $sql."else status end";
    $sqlOperator = $sqlOperator."else operator end";

    $sql = $sql.$sqlOperator;
    $result = $db->query($sql);
    if($result)
    {
        //return $db->affected_rows();
        return true;
    }
    else
        return false;

    //$db->commit();

    return true;
}

if (isset($_POST) and count($_POST) != 0) {
    $operate_id = $_POST["operate_id"];
    $items = $_POST['data'];
    $status = $_POST['status'];

    if (true == updateContact($items, $status)) {
        echo json_encode($retData);
    }
}
?>