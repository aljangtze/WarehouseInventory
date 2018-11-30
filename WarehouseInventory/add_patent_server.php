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

function addPatent($data)
{
    global $db;
    global $retData;
    $user_id = $_SESSION['user_id'];
    $db->transaction();



    //插入请购单号
    $sql = "INSERT INTO `warehouseinventory`.`patent`
            (`project_code`,`office_code`,`name`,`type`,
            `country`,`patent_code`,`submit_date`,`law_status`,
            `is_early_public`,`submit_early_public_date`,`is_actual_audit`,`submit_actual_audit_date`,
            `actual_audit_notice_date`,`priority_date`,`priority_code`,`submit_user`,
            `invertor_user`,`office_name`,`level1`,`level2`,
            `level3`,`level4`,`notification_type`,`agent_answer_date`,
            `agent`,`agent_notice_date`,`agent_submit_date`,`is_authorization_notification`,
            `authorization_notification_date`,`is_authorization_announcement`,`authorization_announcement_date`,`is_has_certificate`,
            `certificate_date`,`initiator_user`) values (
            '{$db->escape($data['project_code'])}','{$db->escape($data['office_code'])}','{$db->escape($data['name'])}','{$db->escape($data['type'])}',
            '{$db->escape($data['country'])}','{$db->escape($data['patent_code'])}',{$db->isNull($data['submit_date'])},'{$db->escape($data['law_status'])}',
            '{$db->escape($data['is_early_public'])}',{$db->isNull($data['submit_early_public_date'])},'{$db->escape($data['is_actual_audit'])}',{$db->isNull($data['submit_actual_audit_date'])},
            {$db->isNull($data['actual_audit_notice_date'])},{$db->isNull($data['priority_date'])},'{$db->escape($data['priority_code'])}','{$db->escape($data['submit_user'])}',
            '{$db->escape($data['invertor_user'])}','{$db->escape($data['office_name'])}','{$db->escape($data['level1'])}','{$db->escape($data['level2'])}',
            '{$db->escape($data['level3'])}','{$db->escape($data['level4'])}','{$db->escape($data['notification_type'])}',{$db->isNull($data['agent_answer_date'])},
            '{$db->escape($data['agent'])}',{$db->isNull($data['agent_notice_date'])},{$db->isNull($data['agent_submit_date'])},'{$db->escape($data['is_authorization_notification'])}',
            {$db->isNull($data['authorization_notification_date'])},'{$db->escape($data['is_authorization_announcement'])}',{$db->isNull($data['authorization_announcement_date'])},'{$db->escape($data['is_has_certificate'])}',
            {$db->isNull($data['certificate_date'])},'{$db->escape($data['initiator_user'])}'
            )";

    if (false == do_insert($sql)) {
        returnError("count code error", true);
        return false;
    }


    $db->commit();
    return true;
}

function updatePatent($data)
{
    global $db;
    global $retData;
    $user_id = $_SESSION['user_id'];
    $db->transaction();

    //插入请购单号
    $sql = "update `warehouseinventory`.`patent`
            set `project_code` = '{$db->escape($data['project_code'])}', `office_code`='{$db->escape($data['office_code'])}',`name`='{$db->escape($data['name'])}',`type`='{$db->escape($data['type'])}',
            `country`='{$db->escape($data['country'])}',`patent_code`='{$db->escape($data['patent_code'])}',`submit_date`={$db->isNull($data['submit_date'])},`law_status`='{$db->escape($data['law_status'])}',
            `is_early_public`= '{$db->escape($data['is_early_public'])}',`submit_early_public_date`={$db->isNull($data['submit_early_public_date'])},`is_actual_audit`='{$db->escape($data['is_actual_audit'])}',`submit_actual_audit_date`={$db->isNull($data['submit_actual_audit_date'])},
            `actual_audit_notice_date`={$db->isNull($data['actual_audit_notice_date'])},`priority_date`={$db->isNull($data['priority_date'])},`priority_code`='{$db->escape($data['priority_code'])}',`submit_user`='{$db->escape($data['submit_user'])}',
            `invertor_user`= '{$db->escape($data['invertor_user'])}',`office_name`='{$db->escape($data['office_name'])}',`level1`='{$db->escape($data['level1'])}',`level2`='{$db->escape($data['level2'])}',
            `level3`= '{$db->escape($data['level3'])}',`level4`='{$db->escape($data['level4'])}',`notification_type`='{$db->escape($data['notification_type'])}',`agent_answer_date`={$db->isNull($data['agent_answer_date'])},
            `agent`='{$db->escape($data['agent'])}',`agent_notice_date`={$db->isNull($data['agent_notice_date'])},`agent_submit_date`={$db->isNull($data['agent_submit_date'])},`is_authorization_notification`='{$db->escape($data['is_authorization_notification'])}',
            `authorization_notification_date`={$db->isNull($data['authorization_notification_date'])},`is_authorization_announcement`='{$db->escape($data['is_authorization_announcement'])}',`authorization_announcement_date`={$db->isNull($data['authorization_announcement_date'])},`is_has_certificate`='{$db->escape($data['is_has_certificate'])}',
            `certificate_date`={$db->isNull($data['certificate_date'])},`initiator_user`='{$db->escape($data['initiator_user'])}' where id={$db->escape($data['id'])}";

    if (false == do_insert($sql)) {
        returnError("count code error", true);
        return false;
    }

    $db->commit();
    return true;
}

if (isset($_POST)) {
    if (count($_POST) == 0) {
        returnError("传入参数不正确");
        return;
    }

    //$req_fields = array('project_code','name' );
    //validate_fields($req_fields);
    switch ($_POST["operate_code"]) {
        case 0:
            $data = $_POST['data'];
            addPatent($data);
            echo json_encode($retData);
            break;
        case 1:
            $data = $_POST['data'];
            updatePatent($data);
            echo json_encode($retData);
            break;
    }
}
?>