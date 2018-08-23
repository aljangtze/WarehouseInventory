<?php
$page_title = '合同详情';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);

function get_contact_details()
{
    global $db;
     $sql = "select a.*, u.name as initiator_name, s.name as supplier_name from contract_entry as a 
            left join users as u on a.initiator=u.id
            left join supplier as s on a.supplier_id=s.id 
            where a.status=0";

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

?>

<script type="text/javascript">
    var g_supplier_id = 0;
    var ds = '<?php $user_id = $_SESSION['user_id']; $requestion_infos = get_contact_details(); echo str_replace('"', '"', json_encode($requestion_infos)); ?>';
    var requestion_data = JSON.parse(ds);

    //详细信息
    var g_reqeustionData = {};
    g_reqeustionData['items'] = {};

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

    function noticeWarning(msg) {
        var key = "warning";
        var value = "Add success";
        var output = "<div  class=\"alert alert-warning col-md-12\">";
        output += "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
        output += msg;
        output += "</div>";

        document.getElementById("head_msg_info").innerHTML = output;

    }

    function showDetails(requestion_detail_id, supplier_name) {
        $("#select_supplier_name").val(supplier_name);

        $.ajax({
            type: "GET",
            url: "manage_contract_price_server.php",//请求的后台地址
            data: "entry_id=" + requestion_detail_id,//前台传给后台的参数
            success: function (msg) {//msg:返回值
                var jsonObj = JSON.parse(msg);
                var result = jsonObj.result;

                if (result != 'success') {
                    noticeError("获取详细信息失败");
                    return;
                }

                var data = jsonObj.data;

                $("#tb_details").bootstrapTable('load', data);
            },
            error:function (request) {

            }
        });
        return;
    }
</script>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12" id="head_msg_info">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row  col-md-5">
    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div>
            <div class="panel-body">
                <div id="toolbar1">
                    <strong>
                        <span class="glyphicon glyphicon-pencil"></span>
                        <span>未处理合同列表</span>
                    </strong>
                </div>
                <table id="example" class="table table-bordered table-hover" data-height="750" data-unique-id="id"
                       data-toolbar="#toolbar1"
                       align="center">
                    <thead>
                    <tr>
                        <th class="text-center" data-visible="true" data-formatter="rowIndex">#</th>
                        <th class="text-center" data-switchable="false" data-visible="false" data-field="id">id</th>
                        <th class="text-center" data-switchable="false" data-visible="true" data-field="code">合同单号</th>
                        <th class="text-center" data-field="initiator_name" data-sortable="true">创建人</th>
                        <th class="text-center" data-switchable="false" data-field="supplier_name" data-sortable="true">供应商</th>
                        <th class="text-center" data-field="status" data-formatter="formatter_status" data-sortable="true">状态</th>
                    </tr>
                    </thead>
                    <tbody id="requestion_list" class="text-center">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="ro col-md-7">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
        </div>
        <div class="panel-body">
            <div id="toolbar">
                <div class="form-inline" role="form">
                    <div class="form-group">
                        <span>选中供应商: </span>
                        <input class="form-control" type="info" value="" id="select_supplier_name"></input>
                        <button name="add_product" class="btn btn-primary pull-right" style="margin-left: 30px;"
                                onclick="updateRequestion(0)">生成合同
                        </button>
                    </div>
                </div>
            </div>
            <table align="center" data-height="750" id="tb_details" data-click-to-select="true" data-toolbar="#toolbar" data-unique-id="id">
                <thead>
                <tr>
                    <th data-class="text-center" data-formatter="rowIndex">#</th>
                    <th data-class="text-center" data-field="id" data-visible="false" data-switchable="false">id</th>
                    <th data-class="text-center" data-field="requestion_date"  data-title="请购日期" data-visible="false"></th>
                    <th data-class="text-center" data-field="expect_date" data-title="期望货期" data-visible="false"></th>
                    <th data-class="text-center" data-field="requestion_code" data-title="请购单号"></th>
                    <th data-class="text-center" data-field="product_name" data-title="物料名称、规格、型号"></th>
                    <th data-class="text-center" data-field="requestion_info" data-title="请购数量"></th>
                    <th data-class="text-center" data-field="price" data-title="不含税价" data-editable="true" ></th>
                    <th data-class="text-center" data-field="total_price" data-title="不含税总价" data-editable="true" ></th>
                    <th data-class="text-center" data-field="tax_price" data-title="含税价格" data-editable="true"></th>
                    <th data-class="text-center" data-field="tax_total_price" data-title="含税总价" data-editable="true"></th>
                    <th data-class="text-center" data-field="godown_info" data-title="到货数量" data-visible="false"></th>
                    <th data-class="text-center" data-field="is_test" data-title="是否试样" data-visible="false" data-formatter="chargeInfo"></th>
                    <th data-class="text-center" data-field="is_reprocess" data-title="二次加工" data-visible="false" data-formatter="chargeInfo"></th>
                    <!--<th class="text-center">期望货期</th>
                    <th class="text-center">品名、规格、型号</th>
                    <th class="text-center">请购</th>
                    <th class="text-center">试样</th>
                    <th class="text-center">二次加工</th>
                    <th class="text-center">备注</th>-->
                </tr>
                </thead>
                <tbody id="product_details" class="text-center">
                </tbody>
                </tbody>
            </table>
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
        showColumns: false,
        data: requestion_data,
        pageList: [15, 20, 50, 100],

        onClickRow: function (row, $element) {
            // row: the record corresponding to the clicked row,
            // $element: the tr element.
            //console.log(row);
            //console.log(row[1]);
            document.getElementById("head_msg_info").innerHTML = "";
            g_supplier_id = row["id"];
            showDetails(row["id"], row["supplier_name"]);
        }
    });

    //导出请购单后用此，标记处理
    function updateRequestion(status) {

        if(g_supplier_id == 0)
        {
            noticeError("请先选择生成合同的供应商");
            return;
        }

        var selectedRows = $('#tb_details').bootstrapTable('getSelections');

        console.log(selectedRows);

        var sendData = {};
        var items = {};

        sendData['operate_id'] = 0;
        var length = 0;
        //更新后台状态，然后更新前台状态
        for (var i = 0; i < selectedRows.length; i++) {
            var curRow = selectedRows[i];
            curRow.status = status;
            items[i] = curRow.id;
            //$('#tb_details').bootstrapTable('updateByUniqueId', {id: curRow.id, row: curRow});
            length++;
        }

        if (length <= 0)
            return;

        sendData['data'] = items;
        sendData['supplier_id'] = g_supplier_id;

        console.log(sendData);
        $.ajax({
            type: "POST",
            url: "gennerate_contact_server.php",//请求的后台地址
            dataType: 'json',
            data: sendData,//前台传给后台的参数
            beforeSend: function () {
                //showModal();
            },
            success: function (msg) {//msg:返回值
                var jsonObj = msg;

                if (jsonObj['result'] != 'success') {
                    noticeError(jsonObj['info']);
                    return;
                }

                //更新成功后，删除明细列表，重新供应商信息
                var selectedRows = $('#tb_details').bootstrapTable('getSelections');
                //更新后台状态，然后更新前台状态
                for (var i = 0; i < selectedRows.length; i++) {
                    var curRow = selectedRows[i];
                    $('#tb_details').bootstrapTable('removeByUniqueId', curRow.id);
                }

                var readRow = $('#example').bootstrapTable('getRowByUniqueId', g_supplier_id);
                readRow['number'] = Number(readRow['number'])-length;

                console.log(readRow);

                $('#example').bootstrapTable('updateByUniqueId', {id:g_supplier_id, row:readRow});

                console.debug(msg);
                //hideModal();
            },
            error: function (request) {
                alert('error');
                console.log(request);
            }
        });
    }

    function chargeInfo(value, row, index) {
        if (value == "1")
            return "是";
        else
            return "否";
    }

    var tb = $('#tb_details').bootstrapTable({
        pagination: true,
        pageSize: 15,
        checkboxHeader: true,
        clickToSelect: true,
        search: true,
        showColumns: true,
        cache: false,
        dataType: "json",
        showRefresh: false,
    });

    $(window).resize(function () {
        $('#tb_details').bootstrapTable('resetView');
        $('#example').bootstrapTable('resetView');
    });

    function rowIndex(value, row, index) {
        return index + 1;
    }



    function formatter_status(value, row, index) {
        if (0 == value) {
            return "<span class=\"label label-warning\">未处理</span></td>";
        }
        else {
            return "<span class=\"label label-success\">已处理</span>";
        }

    }

    function updateStatus(value, row, index) {
        return "<span class=\"label label-success\">Active</span>";
    }
</script>


