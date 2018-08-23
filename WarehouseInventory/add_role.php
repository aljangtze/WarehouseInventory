<?php
  $page_title = '添加新角色';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
   $all_rules = find_all('rule');
?>
<?php
  if(isset($_POST['add'])){

   $checked_list = $_POST["s"];
   $req_fields = array('role-name','role-info');
   validate_fields($req_fields);
   $role_data = find_by_roleName($_POST['role-name']);
    if(!is_null($role_data)){
     $session->msg('d','<b>抱歉</b> 输入的角色名已经存在!');
     redirect('add_role.php', false);
   }

        $name = remove_junk($db->escape($_POST['role-name']));
        $memo = remove_junk($db->escape($_POST['role-info']));
        $status = remove_junk($db->escape($_POST['status']));

		$db->transaction();
        $query  = "INSERT INTO role (name, memo, status) values('$name','$memo',$status)";
        if($db->query($query)){
			if(sizeof($checked_list)===0)
			{
				$db->commit();
				$session->msg('s',"创建角色成功！");
				redirect('role.php', false);
				return;
			}

			//下面是更新权限
			//find_by_roleName($_POST['role-name'])
			$role_data = find_by_roleName($_POST['role-name']);
			$role_id=$role_data['id'];

			$sql = "insert ignore into role_rules (role_id, rule_id) values";
			$insql = "delete from role_rules where rule_id not in (";
			$isFirst = true;
			foreach($checked_list as $rule_id)
			{
				if($isFirst)
				{
					$sql=$sql."($role_id,$rule_id)";
					$insql = $insql."$rule_id";
					$isFirst = false;
				}
				else
				{
					$sql=$sql.",($role_id,$rule_id)";
					$insql = $insql.",$rule_id";
				}
			}
			$insql = $insql.")";

		if($db->query($sql) && $db->query($insql)){
			$db->commit();
          //sucess
			  $session->msg('s',"创建角色成功！");
				redirect('role.php', false);
			}
			else
			{
			$db->rollback();
			//failed
			$session->msg('d','抱歉，创建角色失败！');
			redirect('add_role.php', false);
			}
        } else {
			$db->rollback();
          //failed
          $session->msg('d','抱歉，创建角色失败！');
            redirect('add_role.php', false);
        }
   
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<form method="post" action="add_role.php" class="clearfix">
<div class="row">
  <div class="col-md-5">
    <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>选择权限</span>
     </strong>
    </div>
     <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th style=>权限名称</th>
            <th class="text-center" style="width: 15%;">状态</th>
            <th class="text-center" style="width: 70px;">选择</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_rules as $a_rule): ?>
    <tr>
            <td class="text-center"><?php echo count_id2();?></td>
           <td><?php echo remove_junk(ucwords($a_rule['name']))?></td>
           <td class="text-center">
           <?php if($a_rule['status'] === '1'): ?>
            <span class="label label-success"><?php echo "Active"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Deactive"; ?></span>
          <?php endif;?>
</td>
<td class="text-center">
    <div class="btn-group">
        <input type="checkbox" id="horns" name="s[]" style="width: 18px;height:18px;" value="<?php echo $a_rule['id'];?>"  name="feature"/>
    </div>
</td>
</tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">

	    <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>添加新的角色</span>
     </strong>
    </div>

        <div class="text-center">
           <h3>添加新的角色</h3>
         </div>
            <div class="form-group" style="width:80%;margin-left:10%;" >
                  <label for="name" class="control-label">名称</label>
                  <input type="name" class="form-control" name="role-name">
            </div>
            <div class="form-group" style="width:80%;margin-left:10%;">
                  <label for="level" class="control-label">描述信息</label>
                  <input type="info" class="form-control" name="role-info">
            </div>
            <div class="form-group" style="width:80%;margin-left:10%;">
              <label for="status">状态</label>
                <select class="form-control" name="status">
                  <option value="1">Active</option>
                  <option value="0">Deactive</option>
                </select>
            </div>
            <div class="form-group clearfix" align="center">
                <button type="submit" name="add" class="btn btn-info" style="align:center;width:200px;height:50px;">保存</button>
            </div>
    </div>
</div>
</form>
<?php include_once('layouts/footer.php'); ?>
