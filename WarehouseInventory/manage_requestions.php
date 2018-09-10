<?php
$page_title = 'Edit product';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level("0000x");
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
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    if ($type == '1') {
        //操作员
        $requestions = get_requestion_by_operator($user_id, 0);
    } else {
        $requestions = get_requestion_by_initiator($user_id, 0);
    }

} else {
    $requestions = get_requestion_by_initiator($user_id, 0);
}
?>

<script type="text/javascript">
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

    function goToDetails(requestion_id) {
        //console.log(requestion_id);
        g_requestion_id = requestion_id;
        document.getElementById("product_details").innerHTML = "";
        $.ajax({
            type: "GET",
            url: "get_requestion_summary.php",//请求的后台地址
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

                for (var i = 0; i < data.length; i++) {
                    var item = data[i];

                    returnInnerXml += "<tr><td class=\"text-center \">" + item['id'] + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['requestion_date'] + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['expect_date'] + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['name'] + "," + item['specification'] + "," + item['model_number'] + "," + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['requestion_number'] + " " + item['unit'] + "</td>";
                    returnInnerXml += "<td class=\"text-center \">" + item['godown_number'] + " " + item['unit'] + "</td></tr>";
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
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12" id="head_msg_info">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row  col-md-5">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-pencil"></span>
                <span>请购单列表</span>
            </strong>
        </div>
        <div >
            <div class="panel-body">
                <table id="example" class="table table-bordered table-hover"  data-height="400" align="center" >
                    <thead>
                    <tr>
                        <th class="text-center" data-checkbox="true">#</th>
                        <th class="text-center" data-visible="true">#</th>
                        <th class="text-center" data-switchable="false">创建日期</th>
                        <th class="text-center">请购单号</th>
                        <th class="text-center">请购人</th>
                        <th class="text-center">执行人</th>
                        <th class="text-center">更新状态</th>
                    </tr>
                    </thead>
                    <tbody id="requestion_list" class="text-center">
                    <?php foreach ($requestions as $a_group): ?>
                        <tr onclick="goToDetails('<?php echo (int)$a_group['id']; ?>')">
                            <td class="text-center"></td>
                            <td class="text-center"><?php echo count_id(); ?></td>
                            <td class="text-center"><?php echo $a_group['date']; ?></td>
                            <td class="text-center"><?php echo $a_group['code']; ?></td>
                            <td class="text-center"><?php echo $a_group['initiator_name']; ?></td>
                            <td class="text-center"><?php echo $a_group['operator_name']; ?></td>
                            <td class="text-center">
                                <select class="form-control form-inline">
                                    <option>已取消</option>
                                    <option>新提交</option>
                                    <option>审批中</option>
                                    <option>审批未过</option>
                                    <option>采购中</option>
                                    <option>部分完成</option>
                                    <option>完成</option>
                                </select>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="ro col-md-7">
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
            <table align="center" id="tb_details">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">请购日期</th>
                    <th class="text-center">期望货期</th>
                    <th class="text-center">品名、规格、型号</th>
                    <th class="text-center">请购</th>
                    <th class="text-center">到货</th>
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
        striped: true,
        pageSize:17,
        checkboxHeader:false,
        clickToSelect:true,
        search:true,
        showColumns: true,
        pageList:[20,50,100],

        onClickRow: function (row, $element) {
            // row: the record corresponding to the clicked row,
            // $element: the tr element.
            //console.log(row);
            //console.log(row[1]);
            goToDetails(row[1]);
        }
    });

    $('#tb_details').bootstrapTable({
        pagination: true,
    });
    //document.getElementById("data_start_date").value = today;
    //document.getElementById("data_expect_date").value = today;
    //document.getElementById("data_start_date").valueAsDate = new Date();

    //$("data_start_date").val(today);
    //$("data_expect_date").val(today);

    //alert(today);
</script>


