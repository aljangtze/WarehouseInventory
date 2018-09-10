<?php
$page_title = '所有角色';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
//判断是否有权限，没有权限跳到home页面
page_require_level('70003');

$all_groups = find_all('role_group');
$all_rules = [];
$current_groupname = "未选择角色";
$current_groupid = "";
?>

<?php
if (isset($_GET["id"])) {
    $role_id = (int)$_GET['id'];
    $all_rules = find_role_group_by_id((int)$_GET['id']);
    if (is_null($all_rules)) {
        $session->msg("d", "抱歉，解析角色分组的角色出错");
        redirect('role_group.php');
    }
    $group_info = find_by_id('role', (int)$_GET['id']);
    $current_groupname = $group_info['name'];
    $current_groupid = "?id=" . $group_info['id'];

    if (isset($_GET["remove"])) {
        $sql_del_role = "delete from role_group_roles where group_id=$role_id";
        $sql_del_relation = "delete from role_group where id=$role_id";
        $db->transaction();
        if ($db->query($sql_del_role) && $db->query($sql_del_relation)) {
            //sucess
            $db->commit();
            $session->msg('s', "删除角色成功");
            redirect('role_group.php', false);
        } else {
            $db->rollback();
            $session->msg('s', "删除角色失败");

            redirect('role_group.php', false);
        }

        return;
    }

    //更新权限信息
    if (isset($_POST['update'])) {
        $checked_list = $_POST["s"];

        if (sizeof($checked_list) === 0) {
            $db->transaction();
            $sql = "delete from role_group_roles where group_id=" . $role_id;

            if ($db->query($sql)) {
                //sucess
                $db->commit();
                $session->msg('s', "更新权限成功");
                redirect('role_group.php' . $current_groupid, false);
            } else {
                $db->rollback();
                $session->msg('s', "更新权限失败");
                redirect('role_group.php' . $current_groupid, false);
            }
        }


        $sql = "insert ignore into role_group_roles (group_id, role_id) values";
        $insql = "delete from role_group_roles where role_id not in (";
        $isFirst = true;
        foreach ($checked_list as $rule_id) {
            if ($isFirst) {
                $sql = $sql . "($role_id,$rule_id)";
                $insql = $insql . "$rule_id";
                $isFirst = false;
            } else {
                $sql = $sql . ",($role_id,$rule_id)";
                $insql = $insql . ",$rule_id";
            }
        }
        $insql = $insql . ") and group_id=" . $role_id;

        $db->transaction();
        if ($db->query($sql) && $db->query($insql)) {
            //sucess
            $db->commit();
            $session->msg('s', "更新权限成功");
            redirect('role_group.php' . $current_groupid, false);
        } else {
            $db->rollback();
            $session->msg('s', "更新权限失败");
            redirect('role_group.php' . $current_groupid, false);
        }
    }
}


?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
</div>

<div class="col-md-7">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>角色</span>
            </strong>
            <a href="add_role_group.php" class="btn btn-info pull-right btn-sm">新增角色组</a>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th style="width: 20%;">角色组名称</th>
                    <th class="text-center">角色组描述</th>
                    <th class="text-center" style="width: 15%;">状态</th>
                    <th class="text-center" style="width: 100px;">操作</th>
                </tr>
                </thead>
                <script type="text/javascript">
                    function goToDetails(groupId) {
                        self.location = 'role_group.php?id=' + groupId;
                    }
                </script>
                <tbody>
                <?php foreach ($all_groups as $a_group): ?>
                    <tr onclick="goToDetails('<?php echo (int)$a_group['id']; ?>')">
                        <td class="text-center"><?php echo count_id(); ?></td>
                        <td><?php echo remove_junk(ucwords($a_group['name'])) ?></td>
                        <td class="text-center">
                            <?php echo remove_junk(ucwords($a_group['memo'])) ?>
                        </td>
                        <td class="text-center">
                            <?php if ($a_group['status'] === '1'): ?>
                                <span class="label label-success"><?php echo "Active"; ?></span>
                            <?php else: ?>
                                <span class="label label-danger"><?php echo "Deactive"; ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="role_group.php?id=<?php echo (int)$a_group['id']; ?>"
                                   class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                <a href="role_group.php?remove=1&id=<?php echo (int)$a_group['id']; ?>"
                                   class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<form method="post" action="role_group.php<?php echo $current_groupid; ?>">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>角色拥有的权限-<?php echo $current_groupname ?></span>
                    </strong>
                    <button type="submit" name="update" class="btn btn-info pull-right btn-sm">保存角色分组</button>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th style=>角色名称</th>
                            <th class="text-center" style="width: 15%;">状态</th>
                            <th class="text-center" style="width: 70px;">选择</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($all_rules as $a_rule): ?>
                            <tr>
                                <td class="text-center"><?php echo count_id2(); ?></td>
                                <td><?php echo remove_junk(ucwords($a_rule['name'])) ?></td>
                                <td class="text-center">
                                    <?php if ($a_rule['status'] === '1'): ?>
                                        <span class="label label-success"><?php echo "Active"; ?></span>
                                    <?php else: ?>
                                        <span class="label label-danger"><?php echo "Deactive"; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <input type="checkbox" name="s[]" id="horns" style="width: 18px;height:18px;"
                                               value="<?php echo $a_rule['id']; ?>" <?php if ($a_rule['checked'] === '1') echo('checked'); ?>
                                               fname="feature"/>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
<?php include_once('layouts/footer.php'); ?>
