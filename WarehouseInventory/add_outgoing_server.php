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

function addOutgoingEntry($data)
{
    global $db;
    global $retData;
    $user_id = $_SESSION['user_id'];
    $db->transaction();

    $code = getOutgoingCode();
    if ($data['code'] != $code['code']) {
        //请购号被更新了
        $retData['code'] = $code['code'];
    } else {
        $retData['code'] = $data['code'];
    }

    //检查是否存在
    $sql = "select count(1) as count from outgoing_entry_code where code='{$db->escape($code['code'])}'";

    $code_exists = count_by_sql($sql);
    if (is_null($code_exists)) {
        returnError("count code error", true);
        return false;
    }

    //插入请购单号
    $sql = "insert into outgoing_entry_code values(year(now()), month(now()), day(now()), {$code['number']}, '{$code['code']}')";

    if (false == do_insert($sql)) {
        returnError("count code error", true);
        return false;
    }

    $sql = "insert into outgoing_entry (code, initiator) values('{$db->escape($code['code'])}',  $user_id)";
    $godown_entry_id = "0";
    if (false == do_insert($sql)) {
        returnError("insert outgoing_entry error", true);
        return false;
    } else {
        $godown_entry_id = get_last_auto_id();
        if (is_null($godown_entry_id)) {
            returnError("get outgoing_entry code error", true);
            return false;
        }
    }


    foreach ($data['items'] as $item) {

        $sql = "INSERT INTO `outgoing_entry_details` (`outgoing_entry_id`,requestion_details_id, `product_id`,`project_id`,`supplier_id`, `number`,
		`memo`) values($godown_entry_id, {$db->escape($item['requestion_details_id'])}, 
		{$db->escape($item['product_id'])}, {$db->escape($item['project_id'])},{$db->escape($item['supplier_id'])}, 
		{$db->escape($item['outgoing_number'])}, '{$db->escape($item['memo'])}')";
        if (false == do_insert($sql)) {
            returnError("insert outgoing_entry_details error", true);
            return false;
        }
    }

    $db->commit();
    return true;
}

if (isset($_POST))
    if (count($_POST) == 0)
        return;
    $operate_type = $_POST['operate_type'];
    if($operate_type==0)
    {
        try {
            $data = get_outgoing_requestion_details();
            $retData['items'] = $data;

            echo json_encode($retData);
        } catch (Exception $e) {
            returnError($e->getMessage());
        }
    }
    else
    {
        if (true == addOutgoingEntry($_POST)) {
            echo json_encode($retData);
        }
        else
        {
            returnError("未知错误");
        }
    }


?>