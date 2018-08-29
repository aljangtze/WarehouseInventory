<?php
$page_title = '合同详情';
require_once('includes/load.php');

page_require_level(2);

function get_supplier_details()
{
    global $db;
    $sql = "select s.*,u.name as user_name from supplier as s
            left join users as u on s.initiator=u.id";

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

<script type="text/javascript">

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


    var g_supplier_id = 0;
    var ds = '<?php $user_id = $_SESSION['user_id']; $requestion_infos = get_supplier_details(); echo str_replace('"', '"', json_encode($requestion_infos)); ?>';
    var requestion_data = JSON.parse(ds);

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

    function  deleteSupplier(id) {
        var data={};
        data['operate_type'] = 'del';
        var item = {};
        item['id'] = id;
        data['data'] = item;

        console.log(data);
        $.ajax({
            type: "POST",
            url: "manage_suppliers_server.php",//请求的后台地址
            data: data,
            success: function (msg) {//msg:返回值
                var jsonObj = JSON.parse(msg);
                var result = jsonObj.result;

                if (result != 'success') {
                    noticeError("删除供应商信息失败！");
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

        if (isEmpty(product_name)) {
            noticeError("添加供应商名称名称不能为空");
            return;
        }


        var data = {};
        data['operate_type'] = 'add';
        var item = {};
        item['name'] = product_name;

        data['data'] = item;
        console.log(data);

        $.ajax({
            type: "POST",
            url: "manage_suppliers_server.php",//请求的后台地址
            data: data,
            success: function (msg) {//msg:返回值
                var jsonObj = JSON.parse(msg);
                var result = jsonObj.result;

                if (result != 'success') {
                    noticeError("添加供应商信息失败！供应商已经存在");
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
<?php include_once('layouts/header.php'); ?>
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
                        <span>供应商信息列表</span>
                    </strong>
                </div>
                <table id="example" class="table table-bordered table-hover" data-height="750" align="center"
                       data-unique-id="id"
                       data-toolbar="#toolbar1"
                       >
                    <thead>
                    <tr>
                        <th class="text-center" data-visible="true" data-formatter="rowIndex">#</th>
                        <th class="text-center" data-visible="false" data-field="id" >id</th>
                        <th class="text-center" data-sortable="true" data-visible="true" data-field="name" data-editable="true">名称</th>
                        <th class="text-center" data-sortable="true" data-field="user_name">创建人</th>
                        <th class="text-center" data-formatter="formatter_operator" data-visible="true">操作</th>
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
                    <h3>添加新的供应商</h3>
                </div>
                <div class="form-group" style="width:80%;margin-left:10%;">
                    <label for="name" class="control-label">名称</label>
                    <input type="name" class="form-control" id="product_name" placeholder="请输入名称">
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
        checkboxHeader: false,
        clickToSelect: false,
        search: true,
        showColumns: false,
        showRefresh: false,
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
        <a style="height:20px;" onclick="deleteSupplier(' +  id + ')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">\
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



