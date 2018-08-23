<?php
$page_title = '添加新产品';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
$all_rules = find_product_info('product');
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<form method="post" action="add_role.php" class="clearfix">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>产品列表</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th style=>产品名称</th>
                            <th style=>产品描述</th>
                            <th style=>创建人</th>
                            <th class="text-center" style="width: 15%;">状态</th>
                            <th class="text-center" style="width: 70px;">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_rules as $a_rule): ?>
                            <tr>
                                <td class="text-center"><?php echo count_id2(); ?></td>
                                <td><?php echo remove_junk(ucwords($a_rule['name'])) ?></td>
                                <td><?php echo remove_junk(ucwords($a_rule['memo'])) ?></td>
                                <td><?php echo remove_junk(ucwords($a_rule['username'])) ?></td>
                                <td class="text-center">
                                    <?php if ($a_rule['status'] === '1'): ?>
                                        <span class="label label-success"><?php echo "Active"; ?></span>
                                    <?php else: ?>
                                        <span class="label label-danger"><?php echo "Deactive"; ?></span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
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

        <div class="row">
            <div class="col-md-4">

                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            <span>添加新的产品</span>
                        </strong>
                    </div>

                    <div class="text-center">
                        <h3>添加新的产品分类</h3>
                    </div>
                    <div class="form-group" style="width:80%;margin-left:10%;">
                        <label for="name" class="control-label">产品名称</label>
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
                        <button type="submit" name="add" class="btn btn-info"
                                style="align:center;width:200px;height:50px;">添加
                        </button>
                    </div>
                </div>
            </div>
</form>
<?php include_once('layouts/footer.php'); ?>
