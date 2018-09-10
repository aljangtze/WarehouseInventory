<?php
$page_title = '合同详情';
require_once('includes/load.php');

page_require_level("80001");

function get_product_details()
{
    global $db;
    $sql = "select a.*, u.name as user_name, t.name as product_type from product as a 
            left join users as u on a.id=u.id
            left join product_type as t on a.type=t.id;";

    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    $jarr = array();
    foreach ($result_set as $result) {
        $count = count($result);//不能在循环语句中，由于每次删除 row数组长度都减小
        for ($i = 0; $i < $count; $i++) {
            unset($result[$i]);//删除冗余数据
        }
        array_push($jarr, $result);
    }
    return $jarr;
}

$product_types = find_all('product_type');

$units = find_all('units');
?>
<?php include_once('layouts/header.php'); ?>

<script type="text/javascript">

    console.log('start');
    function isEmpty(a) {
        if (a == "" || a == null || a == undefined) {
            return true;
        }
        else {
            return false;
        }
    }

    function noticeError(msg) {
        var key = "warning";
        var value = "Add success";
        var output = "<div  class=\"alert alert-danger col-md-12\">";
        output += "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
        output += msg;
        output += "</div>";

        document.getElementById("head_msg_info").innerHTML = output;
    }


    var ds = '<?php $user_id = $_SESSION['user_id']; $requestion_infos = get_product_details(); echo str_replace('"', '"', json_encode($requestion_infos)); ?>';
    console.log('stop');

    var requestion_data = JSON.parse(ds);

    console.log(requestion_data);

    //详细信息
    var g_reqeustionData = {};
    g_reqeustionData['items'] = {};

    function updatetails(id) {
        var row = $('#example').bootstrapTable('getRowByUniqueId', id);

        $("#product_name").val(row.name);
        $("#product_specification").val(row.specification);
        $("#product_modelnumber").val(row.model_number);
        $("#product_unit").val(row.unit);
        $("#product_type").val(row.product_type);


        return;
    }

    //收藏
    function favoriteProduct(id, favorite)
    {

    }

    function  deleteProduct(id) {
        var data={};
        data['operate_type'] = 'del';
        var item = {};
        item['id'] = id;
        data['data'] = item;

        console.log(data);



        $.ajax({
            type: "POST",
            url: "manage_products_server.php",//请求的后台地址
            data: data,
            success: function (msg) {//msg:返回值
                var jsonObj = JSON.parse(msg);
                var result = jsonObj.result;

                if (result != 'success') {
                    noticeError("删除物料信息失败！");
                    return;
                }

                var data = jsonObj.data;

                $('#example').bootstrapTable('removeByUniqueId', id);

                alert('success');
            },
            error:function (request) {
                alert('success');
            }
        });

        return;

    }
    //添加物料
    function  add() {

        var product_name =  $("#product_name").val();
        console.log(product_name);
        var product_specification = $("#product_specification").val();
        var product_model_number = $("#product_modelnumber").val();
        var product_unit = $("#product_unit").find("option:selected").text();
        var product_type = $("#product_type").find("option:selected").val();

        if (isEmpty(product_name)) {
            noticeError("添加物料信息的名称不能为空");
            return;
        }

        if(isEmpty(product_specification))
        {
            product_specification = '/';
        }

        if(isEmpty(product_model_number))
        {
            product_model_number = '/';
        }


        var data = {};
        data['operate_type'] = 'add';
        var item = {};
        item['name'] = product_name;
        item['specification'] = product_specification;
        item['model_number'] =product_model_number;
        item['unit'] = product_unit;
        item['product_type'] =  $("#product_type").find("option:selected").text();
        item['type'] = $("#product_type").find("option:selected").val();

        data['data'] = item;
        console.log(data);

        $.ajax({
            type: "POST",
            url: "manage_products_server.php",//请求的后台地址
            data: data,
            success: function (msg) {//msg:返回值
                var jsonObj = JSON.parse(msg);
                var result = jsonObj.result;

                if (result != 'success') {
                    noticeError("添加物料信息失败！物料已经存在");
                    return;
                }

                var data = jsonObj.data;
                console.log(data);

                $('#example').bootstrapTable('prepend', data);

            },
            error:function (request) {
                alert('success');
            }
        });
    }

</script>

<div class="row">
    <div class="col-md-12" id="head_msg_info">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div>
            <div class="panel-body">
                <div id="toolbar1">
                    <strong>
                        <span class="glyphicon glyphicon-pencil"></span>
                        <span>物料信息列表</span>
                    </strong>
                </div>
                <table id="example" class="table table-bordered table-hover" data-height="750" align="center"
                       data-unique-id="id"
                       data-toolbar="#toolbar1"
                       data-show-multi-sort="true"
                       data-sort-priority='[{"sortName": "name", "sortOrder":"asc"},{"sortName": "specification", "sortOrder":"asc"},{"sortName": "model_number", "sortOrder":"asc"}]'>
                    <thead>
                    <tr>
                        <th class="text-center" data-visible="true" data-formatter="rowIndex">#</th>
                        <th class="text-center" data-sortable="true" data-switchable="false" data-visible="true"
                            data-field="name" data-editable="true">名称
                        </th>
                        <th class="text-center" data-sortable="true" data-field="specification" data-editable="true">规格</th>
                        <th class="text-center" data-sortable="true" data-field="model_number" data-editable="true">型号</th>
                        <th class="text-center" data-sortable="true" data-field="unit">单位</th>
                        <th class="text-center" data-sortable="true" data-field="user_name">创建人</th>
                        <th class="text-center" data-sortable="true" data-field="product_type">物料类型</th>
                        <th class="text-center" data-field="id" data-formatter="formatter_operator" data-visible="true">操作</th>
                        <th class="text-center" data-sortable="true" data-formatter="formatter_favorite" data-visible="false">收藏</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="text-center">
                    <h3>添加新的物料</h3>
                </div>
                <div class="form-group" style="width:80%;margin-left:10%;">
                    <label for="name" class="control-label">名称</label>
                    <input type="name" class="form-control" id="product_name" placeholder="请输入名称">
                </div>
                <div class="form-group" style="width:80%;margin-left:10%;">
                    <label for="level" class="control-label">规格</label>
                    <input type="info" class="form-control" id="product_specification" placeholder="请输入规格，不输入将默认填充'/'">
                </div>
                <div class="form-group" style="width:80%;margin-left:10%;">
                    <label for="level" class="control-label">型号</label>
                    <input type="info" class="form-control" id="product_modelnumber" placeholder="请输入型号，不输入将默认填充'/'">
                </div>
                <div class="form-group" style="width:80%;margin-left:10%;">
                    <label for="level" class="control-label">单位</label>
                    <select type="info" class="form-control" id="product_unit">
                        <?php foreach ($units as $cat): ?>
                            <option
                            value="<?php echo (int)$cat['id'] ?>"><?php echo $cat['name'] ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group" style="width:80%;margin-left:10%;">
                    <label for="level" class="control-label">类型</label>
                    <select type="info" class="form-control" id="product_type">
                        <?php foreach ($product_types as $cat): ?>
                            <option
                            value="<?php echo (int)$cat['id'] ?>"><?php echo $cat['name'] ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group clearfix" align="center">
                    <button type="button" id="btn_add" class="btn btn-info " onclick="add()" style="align:center;width:200px;height:40px;margin-left:20px;margin-right: 20px;">添加</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
<script type="text/javascript">
    $('#example').bootstrapTable({
        pagination: true,
        pageSize: 15,
        checkboxHeader: true,
        clickToSelect: true,
        search: true,
        showColumns: true,
        showRefresh: true,
        data: requestion_data,
        pageList: [15, 20, 50, 100],

    });

    $(window).resize(function () {
        $('#example').bootstrapTable('resetView');
    });

    function rowIndex(value, row, index) {
        return index + 1;
    }

    //操作
    function formatter_operator(value, row, index) {
        var id = row.id;
        return '<div class="btn-group" > \
        <a style="height:20px;" onclick="updateDetails(' + id + ')" class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit">\
        <i class="glyphicon glyphicon-ok"></i>\
        </a>\
        <a style="height:20px;" onclick="deleteProduct(' +  id + ')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">\
        <i class="glyphicon glyphicon-remove"></i>\
        </a>\
        </div>';
    }



    function formatter_favorite(value, row, index) {
        var id = row.id;
        if(id > 10)
            return '<div class="btn-group" > \
            <a style="height:20px;" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">\
            <i class="glyphicon glyphicon-star"></i>\
            </a></div>';
        else
            return '<div class="btn-group" > \
                <a style="height:20px;"  class="btn btn-xs btn-info" data-toggle="tooltip" title="Remove">\
                <i class="glyphicon glyphicon-star-empty"></i>\
                </a></div>';
    }
</script>



