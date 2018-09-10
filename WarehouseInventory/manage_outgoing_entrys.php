<?php
$page_title = '入库单管理';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level("30002");
?>
<?php
$requestion_QSInfo = getRequestionCode();
if (null == $requestion_QSInfo) {
    //
} else {
    $requestion_code = $requestion_QSInfo["code"];
    $requestion_code_number = $requestion_QSInfo["number"];
}
$requestions = get_godown_entry_summary();
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

    function noticeWarning(msg) {
        var key = "warning";
        var value = "Add success";
        var output = "<div  class=\"alert alert-warning col-md-12\">";
        output += "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
        output += msg;
        output += "</div>";

        document.getElementById("head_msg_info").innerHTML = output;

    }

    function updateEntrys()
    {

    }

    function goToDetails(entry_id)
    {
        document.getElementById("product_details").innerHTML = "";
        g_entry_id = entry_id;

        $.ajax({
            type: "GET",
            url: "manage_godown_entrys_background.php",//请求的后台地址
            data: "entry_id=" + entry_id,//前台传给后台的参数
            success: function (msg) {//msg:返回值
                var jsonObj = JSON.parse(msg);
                var result = jsonObj.result;

                if (result != 'success') {
                    noticeError("获取入库单详细信息失败");
                    return;
                }

                var items = jsonObj.items;
                var returnInnerXml = "";

                for(var i =0;i<items.length;i++)
                {
                    var item = items[i];
                    returnInnerXml +="<tr><td class=\"text-center \">" + item['id'] + "</td>";
                    returnInnerXml +="<td class=\"text-center \">" + item['product_name'] + "," +item['specification'] + ","+ item['model_name']+","+ "</td>";
                    returnInnerXml +="<td class=\"text-center \">" + item['requestion_number'] + " " + item['unit'] + "</td>";
                    returnInnerXml +="<td class=\"text-center \">" + item['number'] + " " +item['unit'] + "</td></tr>";
                }

                document.getElementById("product_details").innerHTML = returnInnerXml;
            }
        });
        return;
    }

    var g_entry_id = 0;
    function goRequestionDetails(x)
    {
        if(g_entry_id ==0)
            return;

        window.open("get_godown_entry_details.php?entry_id="+g_entry_id);
    }
</script>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12" id="head_msg_info">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row  col-md-7">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-pencil"></span>
                <span>入库单列表</span>
            </strong>
        </div>
        <div class="">
            <div class="panel-body">
                <table class="table table-bordered table-hover" align="center">
                    <thead>
                    <tr >
                        <th class="text-center">#</th>
                        <th class="text-center">入库时间</th>
                        <th class="text-center">入库单号</th>
                        <th class="text-center">请购单号</th>
                        <th class="text-center">入库人</th>
                        <th class="text-center">供应商</th>
                    </tr>
                    </thead>
                    <tbody id="requestion_list" class="text-center">
                    <?php foreach ($requestions as $a_group): ?>
                        <tr onclick="goToDetails('<?php echo (int)$a_group['id'];?>')">
                            <td class="text-center "><?php echo count_id(); ?></td>
                            <td class="text-center"><?php echo $a_group['date']; ?></td>
                            <td class="text-center"><?php echo $a_group['code']; ?></td>
                            <td class="text-center"><?php echo $a_group['requestion_code']; ?></td>
                            <td class="text-center"><?php echo $a_group['user_name']; ?></td>
                            <td class="text-center"><?php echo $a_group['supplier_name']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="ro col-md-5">
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
            <table class="table table-bordered" align="center">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">品名、规格、型号</th>
                    <th class="text-center">请购数量</th>
                    <th class="text-center">入库数量</th>
                </tr>
                </thead>
                <tbody id="product_details" class="text-center">
                </tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    //alert("hello");
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    //格式化月，如果小于9，前面补0
    var month = ("0" + (now.getMonth() + 1)).slice(-2);

    var today = now.getFullYear() + "-" + (month) + "-" + (day);

    //document.getElementById("data_start_date").value = today;
    //document.getElementById("data_expect_date").value = today;
    //document.getElementById("data_start_date").valueAsDate = new Date();

    //$("data_start_date").val(today);
    //$("data_expect_date").val(today);

    //alert(today);
</script>
<?php include_once('layouts/footer.php'); ?>

