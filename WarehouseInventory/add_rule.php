<?php
  $page_title = '添加权限';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  if(isset($_POST['add'])){
   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);

	if(is_exist_by_rule_name($_POST['group-name']) === false ){
     $session->msg('d','<b>抱歉！</b> 输入的权限名称已经被使用！');
     redirect('add_rule.php', false);
   }
        $name = remove_junk($db->escape($_POST['group-name']));
        $level = remove_junk($db->escape($_POST['group-level']));
        $status = remove_junk($db->escape($_POST['status']));

        $query  = "INSERT INTO rule (";
        $query .="name,code,status";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$level}','{$status}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s',"权限增加成功");
          redirect('rule.php', false);
        } else {
          //failed
          $session->msg('d','权限增加失败');
          redirect('add_rule.php', false);
        }
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h3>添加新的权限</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="add_rule.php" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">权限名称</label>
              <input type="name" class="form-control" name="group-name">
        </div>
        <div class="form-group">
              <label for="level" class="control-label">权限代码</label>
              <input type="text" class="form-control" name="group-level">
        </div>
        <div class="form-group">
          <label for="status">启用状态</label>
            <select class="form-control" name="status">
              <option value="1">Active</option>
              <option value="0">Deactive</option>
            </select>
        </div>
        <div class="form-group clearfix" align="center">
                <button type="submit" name="add" class="btn btn-info" style="width:140px;height:50px;">添加</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>
