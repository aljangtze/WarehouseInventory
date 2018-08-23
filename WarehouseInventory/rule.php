<?php
  $page_title = '所有权限';
    require_once('includes/load.php');
// Checkin What level user has permission to view this page
//判断是否有权限，没有权限跳到home页面
page_require_level(1);

$all_groups = find_all('rule');

if(isset($_GET['remove']))
{
	$rule_id=(int)$_GET['id'];

	$sql_del_rule= "delete from role_rules where rule_id=$rule_id";
	$sql_del_relation = "delete from rule where id=$rule_id";
	$db->transaction();
	if($db->query($sql_del_rule) && $db->query($sql_del_relation)){
		//sucess
		$db->commit();
		$session->msg('s',"删除权限成功");
		redirect('rule.php', false);
	}
	else
	{
		$db->rollback();
		$session->msg('s',"删除权限失败");

		redirect('rule.php', false);
	}

	return;
}

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div >
    <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>权限列表</span>
     </strong>
       <a href="add_rule.php" class="btn btn-info pull-right btn-sm">新增权限</a>
    </div>
     <div class="panel-body">
      <table class="table table-bordered" align="center">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th >权限名称</th>
			<th>权限代码</th>
            <th class="text-center" style="width: 15%;">状态</th>
            <th class="text-center" style="width: 100px;" >操作</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_groups as $a_group): ?>
    <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_group['name']))?></td>
           <td><?php echo remove_junk(ucwords($a_group['code']))?></td>
           <td class="text-center">
           <?php if($a_group['status'] === '1'): ?>
            <span class="label label-success"><?php echo "Active"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Deactive"; ?></span>
          <?php endif;?>
</td>
<td class="text-center">
<div class="btn-group">
    <a href="edit_rule.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
        <i class="glyphicon glyphicon-pencil"></i>
    </a>
    <a href="rule.php?remove=1&id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
        <i class="glyphicon glyphicon-remove"></i>
    </a>
    <!--<input type="checkbox" id="horns" name="feature"/>-->
</div>
</td>
</tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
