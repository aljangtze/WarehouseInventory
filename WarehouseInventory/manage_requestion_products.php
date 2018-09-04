<?php
$page_title = '分配采购信息';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);

$suppliers = find_all('supplier');
?>
<?php include_once('layouts/header.php'); ?>

<script type="text/javascript">
    var ds = '<?php $user_id = $_SESSION['user_id']; $requestion_infos = get_requestion_product_details(0); echo str_replace('"', '"', json_encode($requestion_infos)); ?>';
    //console.log(ds);
    var requestion_data = JSON.parse(ds);
</script>

<html>
<body>
<div class="row">
    <div class="col-md-12" id="head_msg_info">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row  col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-pencil"></span>
                <span>请购单列表</span>
            </strong>
            <!--
            <button name="add_product" class="btn btn-primary pull-right" onclick="exportExls()">导出请购单</button>
            <button name="add_product" class="btn btn-primary pull-right" style="margin-right: 10px;"
                    onclick="updateRequestion(1)">标为已处理
            </button>
            <button name="add_product" class="btn btn-warning pull-right" style="margin-right: 10px;"
                    onclick="updateRequestion(0)">标为未处理
            </button>
            -->
        </div>
        <div class="panel-body">
            <div id="toolbar">
                    <div class="form-inline" role="form">
                        <div class="form-group">
                            <button name="add_product" class="btn btn-warning pull-left" style="margin-right: 20px;"
                                    onclick="clearSelect(0)">清除选中项</button
                            <span>选择采购供应商: </span>
                            <select class="form-control" style="width:300px; " id="select_supplier">
                                <?php foreach ($suppliers as $product): ?>
                                    <option value="<?php echo $product['id'] ?>"><?php echo $product['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button name="add_product" class="btn btn-primary pull-right" style="margin-left: 20px;"
                                    onclick="updateRequestion(0)">向此供应商采购
                            </button>
                        </div>
                    </div>
                </div>
                <table id="example" class="table table-bordered table-hover  table-condensed"  data-unique-id="id"  data-height="740"
                       data-show-multi-sort="true"
                       data-sort-priority='[{"sortName": "date","sortOrder":"asc"}]'
                       data-show-toggle="false"
                       data-show-fullscreen="true"
                       data-show-columns="true"
                       data-show-export="true"
                       data-toolbar="#toolbar"
                      >
                    <thead>
                    <tr>
                        <th class="text-center" data-checkbox="true">#</th>
                        <th class="text-center" data-visible="true" data-formatter="rowIndex">#</th>
                        <th class="text-center" data-switchable="false" data-visible="false" data-field="id">id</th>
                        <th class="text-center" data-switchable="false" data-field="date" data-sortable="true">创建日期</th>
                        <th class="text-center" data-field="code" data-sortable="true">请购单号</th>
                        <th class="text-center" data-field="initiator_name" data-sortable="true">请购人</th>
                        <th data-class="text-center" data-field="requestion_date" data-title="请购日期" data-sortable="true"></th>
                        <th data-class="text-center" data-field="expect_date" data-title="期望货期" data-sortable="true"></th>
                        <th data-class="text-center" data-field="project_name" data-title="项目" data-sortable="true"></th>
                        <th data-class="text-center" data-field="product_name" data-title="物料名称、规格、型号" data-sortable="true"></th>
                        <th data-class="text-center" data-field="requestion_info" data-title="请购数量"></th>
                        <th data-class="text-center" data-field="is_test" data-title="是否试样"
                            data-formatter="chargeInfo"></th>
                        <th data-class="text-center" data-field="is_reprocess" data-title="二次加工" data-formatter="chargeInfo"></th>
                        <th data-class="text-center" data-field="reference" data-title="参考链接"></th>
                        <th data-class="text-center" data-field="memo" data-title="备注"></th>
                        <th data-class="text-center" data-field="supplier_name" data-title="供应商" data-sortable="true"></th>
                        <th data-class="text-center" data-field="status" data-formatter="formatter_status" data-switchable="false" data-sortable="true">状态</th>
                    </tr>
                    </thead>
                    <tbody id="requestion_list" class="text-center">
                    </tbody>
                </table>
            </div>
    </div>
</body>
</html>

<?php include_once('layouts/footer.php'); ?>
<script type="text/javascript">

    window.icons = {
        refresh: 'fa-refresh',
        toggle: 'fa-toggle-on',
        columns: 'fa-th-list'
    };

    $('#example').bootstrapTable({
        sortable:true,
        pagination: true,
        pageSize: 15,
        checkboxHeader: true,
        clickToSelect: true,
        search: true,
        data: requestion_data,
        pageList: [15, 20, 50, 100],

        onClickRow: function (row, $element) {
            // row: the record corresponding to the clicked row,
            // $element: the tr element.
            console.log(row);
            //console.log(row[1]);
            //goToDetails(row["id"]);
        }
    });

    //导出请购单，标记处理
    function updateRequestion(status) {
        var selectedRows = $('#example').bootstrapTable('getSelections');

        var sendData = {};
        var items = {};

        var supplierId = $("#select_supplier").val();
        var supplierName = $("#select_supplier").find("option:selected").text();
        sendData['operate_id'] = 0;
        sendData['supplier_id'] = supplierId;
        sendData['supplier_name'] = supplierName;

        var length = 0;
        for (var i = 0; i < selectedRows.length; i++) {
            curRow = selectedRows[i];
            curRow.supplier_name = supplierName;
            curRow.status = 1;
            items[i] = curRow.id;

            $('#example').bootstrapTable('updateByUniqueId', {id: curRow.id, row: curRow});
            length++;
        }

        if(length<=0)
            return;

        sendData['data'] = items;
        console.log(sendData);
        $.ajax({
            type: "POST",
            url: "manage_requestion_products_server.php",//请求的后台地址
            dataType: 'JSON',
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

                console.debug(msg);
                //hideModal();
            },
            error: function (request) {
                // hideModal();
                alert('error');
                console.log(request);
            }
        });
    }

    function clearSelect() {
        $('#example').bootstrapTable('uncheckAll');
    }
    function getIdSelections() {
        return $.map($("#example").bootstrapTable('getSelections'), function (row) {
            return row.index;
        });
    }

    $(window).resize(function () {
        $('#example').bootstrapTable('resetView');
    });

    var tb = $('#tb_details').bootstrapTable({
        showColumns: true,
        cache: false,
        dataType: "json",
        showRefresh: false,
    });

    $(window).resize(function () {
        $('#tb_details').bootstrapTable('resetView');
    });

    function rowIndex(value, row, index) {
        return index + 1;
    }

    function chargeInfo(value, row, index) {
        if (value == "1")
            return "是";
        else
            return "否";
    }

    function formatter_status(value, row, index) {
        if (0 == value) {
            return "<span class=\"label label-warning\">未分配</span></td>";
        }
        else {
            return "<span class=\"label label-success\">已分配</span>";
        }

    }

</script>