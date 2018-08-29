<?php
$page_title = '确认请购单';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
include_once('layouts/header.php');
?>
<?php
$requestion_QSInfo = getRequestionCode();
if (null == $requestion_QSInfo) {
    //
} else {
    $requestion_code = $requestion_QSInfo["code"];
    $requestion_code_number = $requestion_QSInfo["number"];
}

getRequestionCode();

//查找所有创建人创建的status的id

$user_id = $_SESSION['user_id'];

$requestions = array();
$requestions = get_requestion_by_operator($user_id, 0);

?>

<script type="text/javascript">

    var ds = '<?php $user_id = $_SESSION['user_id']; $requestion_infos = get_requestion_by_operator($user_id, 0); echo str_replace('"', '"', json_encode($requestion_infos)); ?>';
    var requestion_data = JSON.parse(ds);

    var product_id = 0;
    var detail_count = 0;
    var g_requestion_id = 0;
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

    function showDetails(requestion_id) {
        //console.log(requestion_id);
        g_requestion_id = requestion_id;
        document.getElementById("product_details").innerHTML = "";
        $.ajax({
            type: "GET",
            url: "get_requestion_details_server.php",//请求的后台地址
            data: "requestion_id=" + requestion_id,//前台传给后台的参数
            success: function (msg) {//msg:返回值
                var jsonObj = JSON.parse(msg);
                var result = jsonObj.result;

                if (result != 'success') {
                    noticeError("获取物料详细信息失败");
                    return;
                }

                var items = jsonObj.items;
                var returnInnerXml = "";

                var data = jsonObj.data;

                //data = [{'id':'1', 'name':'info'},{'id':'1', 'name':'info'}];

                console.log(data);

                /*
                //bootstrapTable('destroy').bootstrapTable();
                var tb= $('#tb_details').bootstrapTable({
                    data:data,
                    cache:false,
                    dataType:"json",
                    showRefresh:true,
                });
                //$('#tb_details').showRefresh;
                console.log(tb);*/

                $("#tb_details").bootstrapTable('load', data);

                return;
                console.log(requestion_id);
                console.log(data);
                var count = 0;
                for (var i = 0; i < data.length; i++) {

                    var item = data[i];
                    count = count + 1;
                    returnInnerXml += "<tr><td class=\"text-center \">" + count + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['id'] + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['requestion_date'] + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['expect_date'] + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['name'] + "," + item['specification'] + "," + item['model_number'] + "," + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['requestion_number'] + " " + item['unit'] + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['is_test'] + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['is_reprocess'] + "</td>";
                    //returnInnerXml += "<td class=\"text-center \">" + item['is_test']=='0'?'是':'否' +  "</td>";
                    //returnInnerXml += "<td class=\"text-center \">" + item['is_reprocess']=='0'?'是':'否' + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['memo'] + "</td></tr>";
                }

                document.getElementById("product_details").innerHTML = returnInnerXml;
            }
        });
        return;
    }

    function goRequestionDetails(x) {
        if (g_requestion_id == 0)
            return;

        window.open("get_requestion_details.php?requestion_id=" + g_requestion_id);
    }
</script>

<div class="row">
    <div class="col-md-12" id="head_msg_info">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row  col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-pencil"></span>
                <span>请购单列表</span>
            </strong>
            <button name="add_product" class="btn btn-primary pull-right" onclick="exportExls()">导出请购单</button>
            <button name="add_product" class="btn btn-primary pull-right" style="margin-right: 10px;"
                    onclick="updateRequestion(1)">标为已处理
            </button>
            <button name="add_product" class="btn btn-warning pull-right" style="margin-right: 10px;"
                    onclick="updateRequestion(0)">标为未处理
            </button>
        </div>
        <div>
            <div class="panel-body">
                <table id="example" class="table table-bordered table-hover" data-height="750" data-unique-id="id"
                       align="center">
                    <thead>
                    <tr>
                        <th class="text-center" data-checkbox="true">#</th>
                        <th class="text-center" data-visible="true" data-formatter="rowIndex">#</th>
                        <th class="text-center" data-switchable="false" data-visible="false" data-field="id">id</th>
                        <th class="text-center" data-switchable="false" data-field="date" data-sortable="true">创建日期</th>
                        <th class="text-center" data-field="code" data-sortable="true">请购单号</th>
                        <th class="text-center" data-field="initiator_name" data-sortable="true">请购人</th>
                        <th class="text-center" data-field="status" data-formatter="formatter_status"
                            data-sortable="true">状态
                        </th>
                    </tr>
                    </thead>
                    <tbody id="requestion_list" class="text-center">
                    <!--<?php foreach ($requestions as $a_group): ?>
                        <tr onclick="goToDetails('<?php echo (int)$a_group['id']; ?>')">
                            <td class="text-center"></td>
                            <td class="text-center"><?php echo count_id(); ?></td>
                            <td class="text-center"><?php echo $a_group['id']; ?></td>
                            <td class="text-center"><?php echo $a_group['date']; ?></td>
                            <td class="text-center"><?php echo $a_group['code']; ?></td>
                            <td class="text-center"><?php echo $a_group['initiator_name']; ?></td>
                            <td class="text-center"><span class="label label-warning">未处理</span></td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="ro col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>请购物料列表</span>
                <span>请购单号:</span>
                <span>请购人</span>
                <span>创建日期</span>
            </strong>
            <button name="add_product" class="btn btn-primary pull-right" onclick="goRequestionDetails(0)">详细信息</button>
        </div>
        <div class="panel-body">
            <table align="center" data-height="750" id="tb_details">
                <thead>
                <tr>
                    <th data-class="text-center" data-formatter="rowIndex">#</th>
                    <th data-class="text-center" data-field="id" data-visible="false" data-switchable="false">id</th>
                    <th data-class="text-center" data-field="requestion_date" data-title="请购日期"></th>
                    <th data-class="text-center" data-field="expect_date" data-title="期望货期"></th>
                    <th data-class="text-center" data-field="product_name" data-title="物料名称、规格、型号"></th>
                    <th data-class="text-center" data-field="requestion_info" data-title="请购数量"></th>
                    <th data-class="text-center" data-field="is_test" data-title="是否试样"
                        data-formatter="chargeInfo"></th>
                    <th data-class="text-center" data-field="is_reprocess" data-title="二次加工"
                        data-formatter="chargeInfo"></th>
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
    //alert("hello");
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    //格式化月，如果小于9，前面补0
    var month = ("0" + (now.getMonth() + 1)).slice(-2);

    var today = now.getFullYear() + "-" + (month) + "-" + (day);

    $('#example').bootstrapTable({
        pagination: true,
        pageSize: 15,
        checkboxHeader: true,
        clickToSelect: true,
        search: true,
        showColumns: true,
        data: requestion_data,
        pageList: [15, 20, 50, 100],

        onClickRow: function (row, $element) {
            // row: the record corresponding to the clicked row,
            // $element: the tr element.
            console.log(row);
            //console.log(row[1]);
            showDetails(row["id"]);
        }
    });

    function exportExls() {

        var selectedRows = $('#example').bootstrapTable('getSelections');

        var items = {};
        //更新后台状态，然后更新前台状态
        for (var i = 0; i < selectedRows.length; i++) {
            curRow = selectedRows[i];
            items[i] = curRow.id;
        }

        var sendData = {};
        sendData['operate_id'] = '1';
        sendData['data'] = items;

        $.ajax({
            type: "POST",
            url: "manage_requestion_details_server.php",//请求的后台地址
            data: sendData,//前台传给后台的参数
            success: function (msg) {//msg:返回值
                var jsonObj = JSON.parse(msg);
                var result = jsonObj.result;

                if (result != 'success') {
                    noticeError("获取物料详细信息失败");
                    return;
                }

                var items = jsonObj.items;
                var returnInnerXml = "";

                var data = jsonObj.data;

                var requestion_id = 0;

                //data = [{'id':'1', 'name':'info'},{'id':'1', 'name':'info'}];
                var jsonData = new Array();
                var index = 1;
                for (var i = 0; i < data.length; i++) {
                    var item = data[i];
                    var cur_requestion_id = Number(item['requestion_id']);
                    jsonData.append([
                        index++,
                        item["requestion_code"],
                        item["requestion_date"],
                        item["code"],
                        item["user_name"],
                        null,
                        "丁腈手套（S）",
                        "100双/盒",
                        "盒",
                        "2",
                        null,
                        null,
                        "一周"
                    ]);

                    if(requestion_id > 0 && requestion_id != cur_requestion_id) {
                        //generateXls(item['code'], jsonData)
                        jsonData.splice(0, jsonData.length);
                        index = 1;
                    }
                    index ++;
                }

                console.log(data);
            },
            error: function (request) {
                alert('error');
            }
        });

        var workBook = XLSX.utils.book_new();

        console.log(workBook);
        var data = [{ //测试数据
            "id": 1,//A
            "合并的列头1": "数据11",//B
            "合并的列头2": "数据12",//C
            "合并的列头3": "数据13",//D
            "合并的列头4": "数据14",//E
        }, {
            "id": 2,
            "合并的列头1": "数据21",
            "合并的列头2": "数据22",
            "合并的列头3": "数据23",
            "合并的列头4": "数据24",
        }];

        var wb = {SheetNames: ['Sheet1'], Sheets: {}, Props: {}};

        data = XLSX.utils.json_to_sheet(data);
        data["B1"] = {t: "s", v: "asdad"};
        data["!merges"] = [{//合并第一行数据[B1,C1,D1,E1]
            s: {//s为开始
                c: 1,//开始列
                r: 0//开始取值范围
            },
            e: {//e结束
                c: 4,//结束列
                r: 0//结束范围
            }
        }];

        wb.Sheets['Sheet1'] = data;

        const wopts = {bookType: 'xlsx', bookSST: true, type: 'binary'};


        var fileName = "C:\\Users\\Administrator\\Desktop\\1.xlsx";
        alert(fileName);
        XLSX.write(wb, wopts);
        saveAs(new Blob([s2ab(XLSX.write(wb, wopts))], {type: "application/octet-stream"}), "这里是下载的文件名" + '.' + (wopts.bookType == "biff2" ? "xls" : wopts.bookType));

        return;
    }

    function generateXls(code, jsonData)
    {
        var jsonHeader = [[
                "请  购  单"
            ],
            [
                "请购单号",
                code,
                null,
                null,
                null,
                null,
                null,
                "制单人",
                null,
                null,
                "王梅佳"
            ],
            [
                "请购明细"
            ],
            [
                "序号",
                "请购单号",
                "请购日期",
                "物料代码",
                "请购人",
                "项目",
                "品名",
                "品牌/规格",
                "单位",
                "数量",
                "参考资源",
                "货号",
                "期望货期",
                "物料类别",
                "资质要求",
                "是否试样",
                "是否需要二次加工",
                "备注"
            ]];

        var filePath = code +".xlsx";

        var ws1 = XLSX.utils.json_to_sheet(jsonData);
        XLSX.utils.book_append_sheet(workbook, ws1, "Presidents");

        XLSX.writeFile(workbook, filePath)

    }

    function s2ab(s) {
        if (typeof ArrayBuffer !== 'undefined') {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        } else {
            var buf = new Array(s.length);
            for (var i = 0; i != s.length; ++i) buf[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }
    }

    function saveAs(obj, fileName) {//当然可以自定义简单的下载文件实现方式
        var tmpa = document.createElement("a");
        tmpa.download = fileName || "下载";
        tmpa.href = URL.createObjectURL(obj); //绑定a标签
        tmpa.click(); //模拟点击实现下载
        setTimeout(function () { //延时释放
            URL.revokeObjectURL(obj); //用URL.revokeObjectURL()来释放这个object URL
        }, 100);
    }

    //导出请购单后用此，标记处理
    function updateRequestion(status) {
        var selectedRows = $('#example').bootstrapTable('getSelections');

        //console.log(selectedRows);

        var sendData = {};
        var items = {};

        sendData['operate_id'] = 0;
        var length = 0;
        //更新后台状态，然后更新前台状态
        for (var i = 0; i < selectedRows.length; i++) {
            var curRow = selectedRows[i];
            curRow.status = status;
            items[i] = curRow.id;
            $('#example').bootstrapTable('updateByUniqueId', {id: curRow.id, row: curRow});
            length++;
        }

        if (length <= 0)
            return;

        sendData['data'] = items;

        console.log(sendData);
        $.ajax({
            type: "POST",
            url: "manage_requestion_details_server.php",//请求的后台地址
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
            return "<span class=\"label label-warning\">未处理</span></td>";
        }
        else {
            return "<span class=\"label label-success\">已处理</span>";
        }

    }

    function updateStatus(value, row, index) {
        return "<span class=\"label label-success\">Active</span>";
    }

    /*
    $('#tb_details').bootstrapTable({
        pagination: true,
        pageSize:15,
        checkboxHeader:true,
        clickToSelect:true,
        search:false,
        showColumns: true,
        pageList:[15, 20, 50,100],
    });*/
    //document.getElementById("data_start_date").value = today;
    //document.getElementById("data_expect_date").value = today;
    //document.getElementById("data_start_date").valueAsDate = new Date();

    //$("data_start_date").val(today);
    //$("data_expect_date").val(today);

    //alert(today);
</script>


