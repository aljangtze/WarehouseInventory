<?php
$page_title = '请求请购单的概览';
require_once('includes/load.php');

$retData = array();
$retData['result'] = "success";
$retData['info'] = "success";

function returnError($info, $rollback=true)
{
    global $db;
    $errorData = array();
    $errorData['result'] = "error";
    $errorData['info'] = $info;

    if($rollback)
        $db->rollback();

    echo json_encode($errorData);
}

function get_supplier_requestion_details_by_id($supplier_id)
{
    global $db;
    $sql = "select a.id, rq.code, pj.name as project_name, a.requestion_id, DATE(a.requestion_date) as requestion_date, Date(a.expect_date) as expect_date, 
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
            where a.supplier_id={$db->escape($supplier_id)}  and a.status = 1 and cd.id is null order by rq.code";

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

if (isset($_GET['supplier_id'])) {
    $requestion_id = $_GET['supplier_id'];
    $data = get_supplier_requestion_details_by_id($requestion_id);
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

function addContact($supplier_id, $items, $memo)
{
    global $db;
    $db->transaction();

    $code = get_contract_code();

    if (null == $code)
        return false;

    //检查是否存在
    $sql = "select count(1) as count from contract_entry_code where code='{$code['code']}'";

    $code_exists = count_by_sql($sql);
    if (is_null($code_exists)) {
        returnError("contract code confilict {$code}", true);
        return false;
    }

    //请购单列表
    $sql = "insert into contract_entry_code values({$code['year']}, {$code['number']}, '{$code['code']}')";

    if (false == do_insert($sql)) {
        returnError("insert contract code failed", true);
        return false;
    }


    //插入请购单号
    $sql = "insert into contract_entry (code, supplier_id, initiator, memo, status) values('{$code['code']}', {$db->escape($supplier_id)},  {$_SESSION['user_id']}, '{$db->escape($memo)}', 0)";
    if (false == do_insert($sql)) {
        returnError("insert contract_entry error");
        return false;
    } else {
        $entry_id = get_last_auto_id();
        if (is_null($entry_id)) {
            returnError("get contract code error");
            return false;
        }
    }

    foreach ($items as $item) {
        $sql = "INSERT IGNORE INTO `contract_entry_details` (`contract_id`,`supplier_id`,`requestion_details_id`,`memo`) values({$db->escape($entry_id)}, {$db->escape($supplier_id)}, {$db->escape($item)},'')";
        if (false == do_insert($sql)) {
            returnError("insert contract details error");
            return false;
        }
    }

    $db->commit();

    return true;
}

if (isset($_POST) and count($_POST) != 0) {
    $operate_id = $_POST["operate_id"];
    $items = $_POST['data'];
    $supplier_id = $_POST['supplier_id'];

    if (true == addContact($supplier_id, $items, '')) {
        echo json_encode($retData);
    }
}
?>