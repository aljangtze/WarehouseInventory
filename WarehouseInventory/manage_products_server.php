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
    $operateType = $_POST['operate_type'];
    $item = $_POST['data'];

    if($operateType == "add")
    {
        $id = 0;
        $user_name = '';
        if(true == addProducts($item,$id, $user_name))
        {

            $item['id'] = $id;
            $item['user_name'] = $user_name;
            $item['initiator'] = $_SESSION['user_id'];
            $retData['data'] = $item;
            echo json_encode($retData);
        }
        else
        {
            returnError("添加物料失败");
        }
    }
    elseif ($operateType == "del")
    {
        if(true == removeProduct($item))
        {
            echo json_encode($retData);
        }
        else
        {
            returnError("删除物料失败");
        }
    }
    elseif ($operateType == "update")
    {
        if(true == updateProducts($item))
        {
            echo json_encode($retData);
        }
        else
        {
            returnError("更新物料失败");
        }
    }
    else
    {
        returnError("未知的操作");
    }


}

function addProducts($item, &$id, &$user_name)
{
    global $db;

    $sql = "select id from product where name='{$db->escape($item['name'])}' and specification='{$db->escape($item['specification'])}' and model_number='{$db->escape($item['model_number'])}'";
    $ret = find_id_by_sql($sql);
    $product_id = -1;
    if (is_null($ret)) {
        $sql = "INSERT INTO `product` (`name`,`specification`, `model_number`, `unit`,`type`,`initiator`) VALUES ('{$db->escape($item['name'])}','{$db->escape($item['specification'])}','{$db->escape($item['model_number'])}', '{$db->escape($item['unit'])}', {$db->escape($item['type'])}, {$_SESSION['user_id']})";

        if (false == do_insert($sql)) {
            returnError("insert requestion error");
            return false;
        }

        $id = get_last_auto_id();
        $current_user = find_by_id('users', $_SESSION['user_id']);
        $user_name = $current_user['name'];

        return true;

    } else {
        return false;
    }
}

function removeProduct($item)
{
    global $db;
    $sql = "delete from product where id={$db->escape($item['id'])}";
    $result = $db->query($sql);
    if ($result) {
        return true;
    } else
        return false;
}

function updateProducts($item)
{
    global $db;
    $sql = "update product set name='{$db->escape($item['product_name'])}', specification='{$db->escape($item['specification_name'])}', model_number='{$db->escape($item['modelnumber_name'])}' where id={$db->escape($item['id'])}";

    $result = $db->query($sql);
    if ($result) {
        return true;
    } else
        return false;
}

?>