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

//获取请购单号关联的信息
if (isset($_GET['requestion_code'])) {
    try {
        $requestion_code = $_GET['requestion_code'];
        //username找到用户名
        //查找用户名，如果没有找到就使用like
        $requestionList = get_requestion_by_code($requestion_code);
        if (count($requestionList) == 0) {
            $retData['userName'] = "";
            echo json_encode($retData);
            return;
        } else {
            $retData['initiatorName'] = $requestionList[0]['initiator_name'];
            $retData['operatorName'] = $requestionList[0]['operator_name'];
        }

        $data = get_requestion_details_by_code($requestion_code);
        $retData['items'] = $data;

        echo json_encode($retData);
    } catch (Exception $e) {
        returnError($e->getMessage());
    }
}

function addGodownEntry($data)
{

    global $db;
    global $retData;
    $user_id = $_SESSION['user_id'];
    $db->transaction();

    $code = getGoDownCode();
    if ($data['code'] != $code['code']) {
        //请购号被更新了
        $retData['code'] = $code['code'];

    } else {
        $retData['code'] = $data['code'];
    }

    //检查是否存在
    $sql = "select count(1) as count from godown_entry_code where code='{$db->escape($code['code'])}'";

    $code_exists = count_by_sql($sql);
    if (is_null($code_exists)) {
        returnError("count code error", true);
        return false;
    }

    //插入请购单号
    $sql = "insert into godown_entry_code values(year(now()), month(now()), day(now()), {$code['number']}, '{$code['code']}')";

    if (false == do_insert($sql)) {
        returnError("count code error", true);
        return false;
    }

    //检查供应商是否存在，不存在则创建
    $sql = "select id from supplier where name='{$db->escape($data['supplier_name'])}'";
    $ret = find_id_by_sql($sql);
    $supplier_id = -1;
    if (is_null($ret)) {
        $sql = "INSERT INTO `supplier` (`name`, `initiator`) VALUES
			('{$db->escape($data['supplier_name'])}',$user_id)";

        if (false == do_insert($sql)) {
            returnError("insert supplier error", true);
            return false;
        }

        $supplier_id = get_last_auto_id();
        if (is_null($supplier_id)) {
            returnError("get supplier code error", true);
            return false;
        }
        //$retData['items'] =array($product_id =>$item);

    } else {
        $supplier_id = $ret;
    }
    $sql = "insert into godown_entry (code, requestion_id, supplier_id, initiator) values('{$db->escape($code['code'])}', {$db->escape($data['requestion_id'])}, $supplier_id,  $user_id)";
    $godown_entry_id = "0";
    if (false == do_insert($sql)) {
        returnError("insert godown_entry error", true);
        return false;
    } else {
        $godown_entry_id = get_last_auto_id();
        if (is_null($godown_entry_id)) {
            returnError("get godown_entry code error", true);
            return false;
        }
    }


    foreach ($data['items'] as $item) {

        $sql = "INSERT INTO `godown_entry_details` (`godown_entry_id`,requestion_details_id, `price`,`total_price`,`number`,
		`memo`) values($godown_entry_id, {$db->escape($item['requestion_details_id'])}, 
		{$db->escape($item['price'])}, {$db->escape($item['total_price'])}, 
		{$db->escape($item['godown_number'])}, '{$db->escape($item['memo'])}')";
        if (false == do_insert($sql)) {
            returnError("insert godown_entry_details error", true);
            return false;
        }
    }

    $db->commit();
    return true;
}

if (isset($_POST)) 
    if (count($_POST) == 0)
        return;

    if (true == addGodownEntry($_POST)) {
        echo json_encode($retData);
    }
    else
    {
        returnError("未知错误");
    }
?>