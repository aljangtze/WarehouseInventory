<?php
$page_title = '添加请购单';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level("00001");

$retData = array();
$retData['result'] = "success";
$retData['items'] = array();

function returnError($info)
{
    global $db;
    $db->rollback();
    $errorData = array();
    $errorData['result'] = "error";
    $errorData['info'] = $info;

    echo json_encode($errorData);
}

function addRequestion($data)
{
    global $db;
	global $retData;
    $db->transaction();

    $code = getRequestionCode();

    if ($data['code'] != $code['code']) {
        //请购号被更新了
        $retData['code'] = $code['code'];

    } else {
        $retData['code'] = $data['code'];
    }

    //检查是否存在
    $sql = "select count(1) as count from requestion_code where code='{$db->escape($code['code'])}'";

    $code_exists = count_by_sql($sql);
    if (is_null($code_exists)) {
        returnError("count code error");
        return false;
    }

    //请购单列表
    $sql = "insert into requestion_code values({$code['year']}, {$code['number']}, '{$code['code']}')";

    if (false == do_insert($sql)) {
        returnError("count code error");
        return false;
    }


    //插入请购单号
    $sql = "insert into requestion (code, initiator, operator, status) values('{$db->escape($code['code'])}', {$db->escape($data['initiator'])}, {$db->escape($data['operator'])}, '0')";

    $requestion_id = "0";
    if (false == do_insert($sql)) {
        returnError("insert requestion error");
        return false;
    } else {
        $requestion_id = get_last_auto_id();
        if (is_null($requestion_id)) {
            returnError("get requestion code error");
            return false;
        }
    }

    foreach ($data['items'] as $item) {
        $sql = "select id from product where name='{$db->escape($item['product_name'])}' and specification='{$db->escape($item['specification_name'])}' and model_number='{$db->escape($item['modelnumber_name'])}'";
        $ret = find_id_by_sql($sql);
        $product_id = -1;
        if (is_null($ret)) {
            $sql = "INSERT INTO `product` (`name`,`specification`, `model_number`,
			`unit`,`type`,`initiator`) VALUES
			('{$db->escape($item['product_name'])}','{$db->escape($item['specification_name'])}','{$db->escape($item['modelnumber_name'])}',
			'{$db->escape($item['unit'])}', {$db->escape($item['type'])}, {$db->escape($data['initiator'])})";

            if (false == do_insert($sql)) {
                returnError("insert requestion error");
                return false;
            }

            $product_id = get_last_auto_id();
            if (is_null($requestion_id)) {
                returnError("get requestion code error");
                return false;
            }

            //$retData['items'] =array($product_id =>$item);

        } else {
            $product_id = $ret;
        }

        $sql = "INSERT INTO `requestion_details` (`requestion_id`,`code`,`product_id`,`reference`,
		`requestion_date`, `expect_date`,`requestion_number`, `memo`, 
		`qualification_id`, `is_test`, `is_reprocess`) values(
		{$db->escape($requestion_id)}, '{$db->escape($item['product_code'])}', $product_id, '{$db->escape($item['reference'])}', 
		'{$db->escape($item['date_start'])}', '{$db->escape($item['date_end'])}', {$db->escape($item['product_number'])}, '{$db->escape($item['memo'])}',
		{$db->escape($item['qualification_id'])}, {$db->escape($item['isTest'])},{$db->escape($item['process_again'])})";

        if (false == do_insert($sql)) {
            returnError("insert requestion error");
            return false;
        }
    }

    $db->commit();

    return true;
}

if (!isset($_POST)) {
    returnError("传入参数不正确");
    return;
}

$data = $_POST;

if (sizeof($data) == 0) {
    returnError("传入参数不正确");
    return;
}

if (true == addRequestion($data)) {
    //添加成功
	$retData['info'] = "提交请购单成功";
    $session->msg('i','请购单提交成功！请购单号:'.$retData['code']);
} else {
	$retData['result']='error';
	$errorData['info'] = "提交请购单失败";
}

//echo json_encode($item);

//echo "hello";
echo json_encode($retData);
?>