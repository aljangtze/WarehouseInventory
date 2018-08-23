<?php
$page_title = 'Edit product';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
?>
<?php
$entry_header = get_godown_entry_summary_by_id($_GET['entry_id']);
$entry_details = get_requestion_details_by_id($_GET['entry_id']);
?>

<script type="text/javascript">
    var product_id = 0;
    var detail_count = 0;

    //详细信息
    var g_reqeustionData = {};
    g_reqeustionData['items']= {};
    function isEmpty(a) {
        if (a == "" || a == null || a == undefined) {
            return true;
        }
        else {
            return false;
        }
    }

    //添加明细信息
    function addDetails() {
        //return;
        document.getElementById("head_msg_info").innerHTML = "";
        var tb = document.getElementById("product_details");
        var tr = tb.insertRow(0);

        var idCell1 = document.createElement("td");
        var idCell2 = document.createElement("td");
        var idCell3 = document.createElement("td");
        var idCell4 = document.createElement("td");
        var idCell5 = document.createElement("td");
        var idCell6 = document.createElement("td");
        var idCell7 = document.createElement("td");
        var idCell8 = document.createElement("td");
        var idCell9 = document.createElement("td");
        var idCell10 = document.createElement("td");
        var idCell11 = document.createElement("td");
        var idCell12 = document.createElement("td");
        var idCell13 = document.createElement("td");
        var idCell14 = document.createElement("td");
        var idCell15 = document.createElement("td");
        var idCell16 = document.createElement("td");
        var idCell17 = document.createElement("td");


        var startTime = ($("#data_start_date").val());
        var endTime = ($("#data_expect_date").val());
        if (false == validateData(startTime, "请购日期")) {
            $("#data_start_date").focus();
            return;
        }

        if (false == validateData(endTime, "期望货期")) {
            $("#data_expect_date").focus();
            return;
        }

        var timeStart = new Date(Date.parse(startTime));
        var timeEnd = new Date(Date.parse(endTime));
        if (timeEnd < timeStart) {
            noticeError("添加请购信息失败:  \"期望货期必须大于请购日期\"  不能为空,请修改相应数据后重新添加！");
            return;
        }

        if (false == validateData(($("#product_name_info").val()), "物料名称")) {
            $("#product_name_info").focus();
            return;
        }

        if (false == validateData(($("#product_name_info").val()), "物料名称")) {
            $("#product_name_info").focus();
            return;
        }

        if (false == validateData(($("#product_input_specification").val()), "物料规格", true)) {
            $("#product_input_specification").focus();
            return;
        }
        if (false == validateData(($("#product_input_modelnumber").val()), "物料型号", true)) {
            $("#product_input_modelnumber").focus();
            return;
        }

        detail_count = detail_count + 1;

        jsonData = {};

        jsonData['id'] = detail_count;
        jsonData['tr_id'] = "product_details_" + detail_count;
        jsonData['date_start'] = $("#data_start_date").val();
        jsonData['date_end'] = $("#data_expect_date").val();
        jsonData['project_name'] = $("#data_project").find("option:selected").text();
        jsonData['project_id'] = $("#data_project").val();
        jsonData['product_name'] = $("#product_name_info").val();
        jsonData['specification_name'] = $("#product_input_specification").val();
        jsonData['modelnumber_name'] = $("#product_input_modelnumber").val();
        jsonData['product_number'] = $("#data_product_number").val();
        jsonData['unit'] = $("#data_product_unit").find("option:selected").text();
        jsonData['type'] = $("#data_product_type").val();
        jsonData['type_name'] = $("#data_product_type").find("option:selected").text();///物料类别
        jsonData['product_code'] = $("#data_product_code").val();
        jsonData['qualification_name'] = $("#data_product_qualification").find("option:selected").text();//资质要求
        jsonData['qualification_id'] = $("#data_product_qualification").val();
        jsonData['reference'] = $("#data_product_reference").val();//物料参考资源
        jsonData['isTestInfo'] = $("#data_need_test").find("option:selected").text();//是否试样
        jsonData['isTest'] = $("#data_need_test").val();
        jsonData['process_again_info'] = $("#data_process_again").find("option:selected").text();//是否二次加工
        jsonData['process_again'] = $("#data_process_again").val();
        jsonData['memo'] = $("#data_product_memo").val();//备注


        tr.id = jsonData['tr_id'];

        idCell1.innerHTML = jsonData['id']
        idCell2.innerHTML = jsonData['date_start'];
        idCell3.innerHTML = jsonData['date_end'];
        idCell4.innerHTML = jsonData['project_name'];
        idCell5.innerHTML = jsonData['product_name'];
        idCell6.innerHTML = jsonData['specification_name'];
        idCell7.innerHTML = jsonData['modelnumber_name'];
        idCell8.innerHTML = jsonData['product_number'];
        idCell9.innerHTML = jsonData['unit'];
        idCell10.innerText = jsonData['type_name'];
        idCell11.innerHTML = jsonData['product_code'];
        idCell12.innerText = jsonData['qualification_name'];
        idCell13.innerText = jsonData['reference'];
        idCell14.innerText = jsonData['isTestInfo']
        idCell15.innerText = jsonData['process_again_info']
        idCell16.innerText = jsonData['memo'];
        //idCell17.innerHTML = "<div class=\"btn-group\"><a  class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" title=\"Edit\"><span class=\"glyphicon glyphicon-edit\"></span></a><a class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Remove\"  id=\"" + tr.id + "\" onclick=\"deleteNode('" + tr.id + "')\"><span class=\"glyphicon glyphicon-trash\"></span></a></div>";
        idCell17.innerHTML = "<div class=\"btn-group\"><a class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Remove\"  id=\"" + tr.id + "\" onclick=\"deleteNode('" + tr.id + "')\"><span class=\"glyphicon glyphicon-trash\"></span></a></div>";


        tr.appendChild(idCell1);
        tr.appendChild(idCell2);
        tr.appendChild(idCell3);
        tr.appendChild(idCell4);
        tr.appendChild(idCell5);
        tr.appendChild(idCell6);
        tr.appendChild(idCell7);
        tr.appendChild(idCell8);
        tr.appendChild(idCell9);
        tr.appendChild(idCell10);
        tr.appendChild(idCell11);
        tr.appendChild(idCell12);
        tr.appendChild(idCell13);
        tr.appendChild(idCell14);
        tr.appendChild(idCell15);
        tr.appendChild(idCell16);
        tr.appendChild(idCell17);

        g_reqeustionData.items[jsonData['tr_id']] = jsonData;

        document.getElementById("product_name_info").value = "";

        document.getElementById("product_input_modelnumber").value = "";
        document.getElementById("product_input_modelnumber_list").innerHTML = "";

        document.getElementById("product_input_specification").value = "";
        document.getElementById("product_input_specification_list").innerHTML = "";
    }
</script>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12" id="head_msg_info">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>入库物料列表</span>
                <button name="add_product" class="btn btn-primary pull-right" onclick="">导出到excel</button>
            </strong>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped" align="center">
                <thead>
                <tr>
                    <td colspan="10" class="text-center"><h4><b>入库单</b></h4></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="1"><b>单位：</b></td>
                    <td class="text-left" colspan="4" id="data_company_name">四川蓝光英诺生物科技股份有限公司</td>
                    <td class="text-right" colspan="3"
                    <b>入库单号:</b></td>
                    <td class="text-center" colspan="2" id="data_godown_code"><?php echo $entry_header['code'] ?></td>

                </tr>
                <tr>
                    <td class="text-right" colspan="1"><b>部门：</b></td>
                    <td class="text-left" colspan="4">研发中心</td>

                    <td class="text-right" colspan="3"><b>入库日期:</b></td>
                    <td class="text-center" colspan="2" id="data-date"><?php echo $entry_header['date'] ?></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="1"><b>供应商：</b></td>
                    <td class="text-left" colspan="4" id="data_supplier_name"><?php echo $entry_header['supplier_name'] ?></td>
                    <td class="text-right" colspan="3"><b>请购单号:</b></td>
                    <td class="text-center" colspan="2" id="data_requestion_code"><?php echo $entry_header['requestion_code'] ?></td>
                </tr>
                <tr>
                    <td class="text-center"><b>序号</b></td>
                    <td class="text-center"><b>品名</b></td>
                    <td class="text-center"><b>规格型号</b></td>
                    <td class="text-center"><b>单位</b></td>
                    <td class="text-center"><b>数量</b></td>
                    <td class="text-center"><b>单价</b></td>
                    <td class="text-center"><b>总价</b></td>
                    <td class="text-center"><b>项目</b></td>
                    <td class="text-center"><b>备注</b></td>
                </tr>
                </thead>
                <tbody id="product_details" class="text-center">
                <?php foreach ($entry_details as $a_group): ?>
                    <tr>
                        <td class="text-center "><?php echo count_id(); ?></td>
                        <td class="text-center"><?php echo $a_group['product_name']; ?></td>
                        <td class="text-center"><?php echo $a_group['product_model']; ?></td>
                        <td class="text-center"><?php echo $a_group['unit']; ?></td>
                        <td class="text-center"><?php echo $a_group['number']; ?></td>
                        <td class="text-center"><?php echo '￥ '.$a_group['price']; ?></td>
                        <td class="text-center"><?php echo '￥ '.$a_group['total_price']; ?></td>
                        <td class="text-center"><?php echo $a_group['project_name']; ?></td>
                        <td class="text-center"><?php echo $a_group['memo']; ?></td>
                    </tr>
                <?php endforeach; ?>

                <!--
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">XXXXXXXXXXXXXXXXXXXXXXXXXXX</td>
                    <td class="text-center">规格型号</td>
                    <td class="text-center">个</td>
                    <td class="text-center">￥10</td>
                    <td class="text-center">100</td>
                    <td class="text-center">￥1000</td>
                    <td class="text-center">研发项目</td>
                    <td class="text-center">备注XXXXXXXXXXXXXXXXX</td>
                    <td class="text-center" style="width:60px;">操作</td>
                </tr>-->

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
    document.getElementById("data_expect_date").value = today;
    document.getElementById("data_start_date").valueAsDate = new Date();

    //$("data_start_date").val(today);
    //$("data_expect_date").val(today);
    //alert(today);
</script>
<?php include_once('layouts/footer.php'); ?>

