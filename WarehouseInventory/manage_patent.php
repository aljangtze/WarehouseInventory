
<?php require_once('includes/load.php');?>

<?php
$page_title = '合同详情';
page_require_level("60000");

function get_patent_details()
{
    global $db;
    $sql = "select * from patent";

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


    var ds = '<?php $user_id = $_SESSION['user_id']; $requestion_infos = get_patent_details(); echo str_replace('"', '"', json_encode($requestion_infos)); ?>';
    console.log('stop');

    var requestion_data = JSON.parse(ds);

    console.log(requestion_data);

    //详细信息
    var g_reqeustionData = {};
    g_reqeustionData['items'] = {};

    function  deletePatent(id) {
        var data={};
        data['operate_type'] = 'del';
        var item = {};
        item['id'] = id;
        data['data'] = item;

        console.log(data);
        $.ajax({
            type: "POST",
            url: "manage_patent_server.php",//请求的后台地址
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
<div class="col-md-12">
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
                       data-show-export="true"
                       data-show-multi-sort="true"
                       data-sort-priority='[{"sortName": "project_code", "sortOrder":"asc"},{"sortName": "office_code", "sortOrder":"asc"}]'>
                    <thead>
                    <tr>
                        <th class="text-center" data-visible="true" data-formatter="rowIndex" data-switchable="false">#</th>
                        <th class="text-center" data-sortable="true" data-switchable="false" data-visible="true"
                            data-field="project_code" data-editable="false">我方案号
                        </th>
                        <th class="text-center" data-sortable="true" data-field="office_code" data-editable="false">事务所案号</th>
                        <th class="text-center" data-sortable="true" data-field="name" data-editable="false">专利名称</th>
                        <th class="text-center" data-sortable="true" data-field="type" data-editable="false">类别</th>
                        <th class="text-center" data-sortable="true" data-field="country">国家</th>
                        <th class="text-center" data-sortable="true" data-field="patent_code">申请号/专利号</th>
                        <th class="text-center" data-sortable="true" data-field="submit_date">专利申请日</th>
                        <th class="text-center" data-sortable="true" data-field="law_status" data-visible="true">法律状态</th>
                        <th class="text-center" data-sortable="true" data-field="is_early_public" data-visible="true" data-formatter="formatter_charge">是否提前公开</th>
                        <th class="text-center" data-sortable="true" data-field="submit_early_public_date" data-visible="true">提前公开日期</th>
                        <th class="text-center" data-sortable="true" data-field="is_actual_audit" data-visible="true" data-formatter="formatter_charge">是否提出实审</th>
                        <th class="text-center" data-sortable="true" data-field="submit_actual_audit_date" data-visible="true">提前实审日</th>
                        <th class="text-center" data-sortable="true" data-field="actual_audit_notice_date" data-visible="true">提前实审日提醒</th>
                        <th class="text-center" data-sortable="true" data-field="priority_date" data-visible="true">优先权日</th>
                        <th class="text-center" data-sortable="true" data-field="priority_code" data-visible="true">优先权申请号</th>
                        <th class="text-center" data-sortable="true" data-field="submit_user" data-visible="true">申请人</th>
                        <th class="text-center" data-sortable="true" data-field="invertor_user" data-visible="true">发明人</th>
                        <th class="text-center" data-sortable="true" data-field="office_name" data-visible="true">事务所</th>
                        <th class="text-center" data-sortable="true" data-field="level1" data-visible="true">一级分类</th>
                        <th class="text-center" data-sortable="true" data-field="level2" data-visible="true">二级分类</th>
                        <th class="text-center" data-sortable="true" data-field="level3" data-visible="true">三级分类</th>
                        <th class="text-center" data-sortable="true" data-field="level4" data-visible="true">四级分类</th>
                        <th class="text-center" data-sortable="true" data-field="notification_type" data-visible="true">通知书类型</th>
                        <th class="text-center" data-sortable="true" data-field="agent_answer_date" data-visible="true">答复期限</th>
                        <th class="text-center" data-sortable="true" data-field="agent" data-visible="true">代理人</th>
                        <th class="text-center" data-sortable="true" data-field="agent_notice_date" data-visible="true">代理提醒日</th>
                        <th class="text-center" data-sortable="true" data-field="agent_submit_date" data-visible="true">代理提交日期</th>
                        <th class="text-center" data-sortable="true" data-field="is_authorization_notification" data-visible="true" data-formatter="formatter_charge">是否发授权通知书</th>
                        <th class="text-center" data-sortable="true" data-field="authorization_notification_date" data-visible="true">授权通知书发文日期</th>
                        <th class="text-center" data-sortable="true" data-field="is_authorization_announcement" data-visible="true" data-formatter="formatter_charge">是否授权公告</th>
                        <th class="text-center" data-sortable="true" data-field="authorization_announcement_date" data-visible="true">授权公告日期</th>
                        <th class="text-center" data-sortable="true" data-field="is_has_certificate" data-visible="true" data-formatter="formatter_charge">是否有证书</th>
                        <th class="text-center" data-sortable="true" data-field="certificate_date" data-visible="true">纸质证书收到日期</th>
                        <th class="text-center" data-sortable="true" data-field="id" data-visible="true" data-formatter="formatter_operator">操作</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                </table>
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
        <i class="glyphicon glyphicon-edit"></i>\
        </a>\
        <a style="height:20px;" onclick="deletePatent(' +  id + ')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">\
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

    function formatter_charge(value, row, index) {
        if(value == 0)
        {
            return '否';
        }
        else
        {
            return '是';
        }
    }
</script>



