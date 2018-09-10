<?php
$page_title = '入库信息';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level("20001");
$rk_code_info = getGoDownCode();
?>


<script type="text/javascript">
    var product_id = 0;
    var detail_count = 0;

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

    //更新供应商
    function onSupplierChange() {
        document.getElementById("head_msg_info").innerHTML = "";
        var supplierName = ($('#product_supplier_name').val());

        $('#data_supplier_name').text(supplierName);

        g_GodownEntryData['supplier_name'] = supplierName;


    }

    //修改请购单号
    function onRequestionChange() {
        document.getElementById("head_msg_info").innerHTML = "";

        product_name = '';
        $("#product_name_info_list").html("");
        $("#product_number_info").val("物料数量:（请购:0,已入库:0）");

        var docList = document.getElementById("product_requestion_code_list");

        var isFind = false;
        for (var data in g_GodownEntryData.items) {
            isFind = true;
            break;
        }
        if (isFind) {
            noticeWarning("更换请购单号，将清空入库物料列表");
            deleteAllNode();
        }

        // var options = docList.options;
        var requestion_code = $("#product_requestion_code").val();
        if (requestion_code == "")
            return;

        /*
        var user_name = "";

        for (var i = 0; i < options.length; i++) {

            var option = options[i];
            var option_value = option.value;
            if (reqeustion_code == option_value) {
                user_name = option.attributes['data-name'].value;
                break;
            }
        }*/

        //设置相关联的值
        $("#data_requestion_code").text(requestion_code);
        //ajax获取数据
        $.ajax({
                type: "GET",
                url: "add_godown_background.php",//请求的后台地址
                data: "requestion_code=" + requestion_code,//前台传给后台的参数
                success: function (msg) {//msg:返回值

                    //console.log(msg);
                    var jsonObj = JSON.parse(msg);
                    var result = jsonObj.result;

                    //没找到相应的物料
                    if (result != 'success') {
                        noticeError("获取物料规格信息失败");
                        return;
                    }

                    $("#data_user_name").val(jsonObj['initiatorName']);

                    var retXml = "";

                    var isFirst = true;
                    var items = jsonObj.items;

                    if (items.length == 0) {
                        noticeError("未找到此请购单相关的物料，检查是否正确");
                        return;
                    }

                    g_GodownEntryData['requestionCode'] = requestion_code;


                    for (var i = 0; i < items.length; i++) {
                        var item = items[i];
                        g_GodownEntryData['requestion_id'] = item['requestion_id'];
                        var data_product_info = item["product_name"] + " , " + item["specification"] + " , " + item["model_number"];
                        var data_product_spc_model = item["specification"] + "," + item["model_number"];
                        if (item["specification"] == "/") {
                            if (item["model_number"] == "/") {
                                data_product_spc_model = "/";
                                data_product_info = item["product_name"];
                            }
                            else {
                                data_product_spc_model = item["model_number"];
                                data_product_info = item["product_name"] + " , " + item["model_number"]
                            }
                        }
                        else {
                            if (item["model_number"] == "/") {
                                data_product_spc_model = item["specification"];
                                data_product_info = item["product_name"] + " , " + item["specification"]
                            }
                        }

                        if (isFirst)
                        {
                            retXml += "<option data-requestion-number=\"" + item['requestion_number'] + "\"data-godown-number=\"" + item['godown_number'] + "\" selected=\"selected\" data-id=\"" + item['id'] + "\" data-project-name=\"" + item['project_name'] + "\" data-unit=\"" + item['unit'] + "\" value=\"" + data_product_info + "\" data-product-name=\"" + item["product_name"] + "\" data-spc-model=\"" + data_product_spc_model + "\">" + data_product_info + " </option>";

                            //$("#product_number_info").text("物料数量:（请购:" + item['requestion_number'] +  ",已入库:" +  item['godown_number']  + "）");
                            isFirst=false;
                        }
                        else
                            retXml += "<option data-requestion-number=\"" + item['requestion_number'] + "\"data-godown-number=\"" + item['godown_number'] + "\" data-id=\"" + item['id'] + "\" data-project-name=\"" + item['project_name'] + "\" data-unit=\"" + item['unit'] + "\" value=\"" + data_product_info + "\" data-product-name=\"" + item["product_name"] + "\" data-spc-model=\"" + data_product_spc_model + "\">" + data_product_info + "</option>";

                    }
                    //alert(retXml);
                    document.getElementById("product_name_info_list").innerHTML = retXml;
                    onProductChanged();

                    console.log(g_GodownEntryData);
                }
            }
        )
        ;
        return;
    }

    var product_count = 0;
    var product_name = '';
    var requeston_detail_id = '';
    var product_sec_model = '';
    var product_unit = '';
    var requestion_project = "";

    function onProductChanged() {
        product_name = '';
        var options = document.getElementById("product_name_info_list").options;
        var modelnumber_name = document.getElementById("product_name_info_list").value;

        for (var i = 0; i < options.length; i++) {

            var option = options[i];

            var option_value = option.value;

            if (modelnumber_name == option_value) {
                requeston_detail_id = option.attributes['data-id'].value;
                product_name = option.attributes['data-product-name'].value;
                product_sec_model = option.attributes['data-spc-model'].value;
                product_unit = option.attributes['data-unit'].value;
                requestion_project = option.attributes['data-project-name'].value;
                var requestion_number = option.attributes['data-requestion-number'].value;
                var godown_number = option.attributes['data-godown-number'].value;

                $("#product_number_info").text("物料数量:（请购:" + requestion_number +  ",已入库:" +  godown_number  + "）");
                //console.log(requeston_detail_id);
                //console.log(product_name);
                //console.log(product_sec_model);
                //console.log(product_unit);
                //console.log(requestion_project);

                break;
            }
        }
    }

    function addDetails() {
        $("#head_msg_info").html("");

        if (false == validateData(product_name, "物料名称和规格信息")) {
            return;
        }

        console.log($("#product_requestion_code").text());
        if ($("#product_requestion_code").val() == "") {
            noticeError("添加入库信息失败，请先选择需要入库的请购单号");
            return;
        }

        var product_number = Number($("#data_product_number").val());
        if (product_number <= 0 || isNaN(product_number)) {
            noticeError("添加入库信息失败: 入库数量必须为大于0的数字，,请修改相应数据后重新添加！");
            return;
        }

        /*
                var price = Number($("#data_price").val());
                if (isNaN(price)) {
                    noticeError("添加入库信息失败: 单价必须为数字，没有请填0，请修改相应数据后重新添加！");
                  return;
                }

                /*
                if (price <= 0) {
                    noticeWarning("注意: 单价填写的小于等于0的数字，请确定是否正确！");
                }

                var totalPrice = Number($("#data_total_price").val());
                if (isNaN(totalPrice)) {
                    noticeError("添加入库信息失败: 总价必须为大于0的数字，,请修改相应数据后重新添加！");
                    return;
                }

                if (totalPrice <= 0) {
                    noticeWarning("注意: 总价填写的小于等于0的数字，请确定是否正确！");
                }

                if (price * product_number != totalPrice) {
                    noticeError("添加入库信息失败: 总价 != 单价*数量，,请修改相应数据后重新添加！");
                    return;
                }*/


        //console.log(g_GodownEntryData);
        for (var curData in g_GodownEntryData.items) {
            var item = g_GodownEntryData.items[curData];
            //console.log("item is ", item);
            //console.log($("#product_name_info").val(),  $("#product_input_specification").val(), $("#product_input_modelnumber").val())
            console.log(item);
            if (item['requestion_details_id'] == requeston_detail_id) {
                noticeError("已经添加过此物料 \"" + product_name + "\" ，一个入库单一类物料只能有一条信息！");
                return;
            }
        }

        var tb = document.getElementById("product_details");
        var tr = tb.insertRow(0);
        //requeston_detail_id = 0;
        product_count += 1;
        tr.id = "entray_id_" + product_count;
        var retXml = "<td class=\"text-center\">" + product_count + "</td>" +
            "<td class=\"text-center\">" + product_name + "</td>" +
            "    <td class=\"text-center\">" + product_sec_model + "</td>" +
            "   <td class=\"text-center\">" + product_unit + "</td> " +
            "   <td class=\"text-center\">" + product_number + "</td>" +
            "   <td class=\"text-center\">" + $("#flag_price").text() + ' ' + $("#data_price").val() + "</td>" +
            "   <td class=\"text-center\">" + $("#flag_total_price").text() + ' ' + $("#data_total_price").val() + "</td>" +
            "   <td class=\"text-center\">" + requestion_project + "</td>" +
            "   <td class=\"text-center\">" + $("#data_memo").val() + "</td>" +
            "<td class=\"text-center\"> " +
            "   <div class=\"btn-group\"> " +

            "   <a  class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Remove\"" + " onclick=\"deleteNode('" + tr.id + "')\" >" +
            "   <i class=\"glyphicon glyphicon-remove\"></i>" +
            "   </a>" +
            "   </div>" +
            "  </td>";
        tr.innerHTML = retXml;


        var jsonData = {};
        jsonData['id'] = tr.id;
        jsonData['requestion_details_id'] = requeston_detail_id;
        jsonData['godown_number'] = product_number;
        jsonData['price'] = 0;
        jsonData['total_price'] = 0;
        jsonData['memo'] = $("#data_memo").val();
        g_GodownEntryData.items[jsonData['id']] = jsonData;

        //1物料信息
        //物料数量
        //单价
        //总价
    }

    function validateData(data, info, flag) {
        var a = data;
        if (a == "" || a == null || a == undefined) {
            if (flag == true) {
                noticeError("添加入库失败:  \"" + info + "\"  不能为空,若没有特定的信息请使用 \"/\" 进行填充！");
            }
            else {
                noticeError("添加入库信息失败:  \"" + info + "\"  不能为空,请修改相应数据后重新添加！");
            }
            return false;
        }

        return true;
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

    function deleteNode(id) {
        $('#' + id).remove();
        delete  g_GodownEntryData.items[id];
    }

    function deleteAllNode() {
        for (var curData in g_GodownEntryData.items) {
            var item = g_GodownEntryData.items[curData];

            var id = item['id'];
            $('#' + id).remove();
            delete  g_GodownEntryData.items[id];
        }
    }

    function money_click() {
        if ($('#flag_total_price').text() == '$') {
            $('#flag_total_price').text('￥');
            $('#flag_price').text('￥');
        }
        else {
            $('#flag_total_price').text('$');
            $('#flag_price').text('$');
        }
    }


    var g_GodownEntryData = {};
    g_GodownEntryData.items = {};

    function submitGodownEntry() {
        //
        if ($('#product_supplier_name').val() == "") {
            noticeError("请选择供应商信息");
            return;
        }

        var isFind = false;
        for (var data in g_GodownEntryData.items) {
            isFind = true;
            break;
        }
        if (isFind == false) {
            noticeError("没有入库信息，请添加");
            return;
        }
        g_GodownEntryData['code'] = $('#data_godown_code').text();
        console.log(g_GodownEntryData);

        $.ajax({
            type: "POST",
            url: "add_godown_background.php",//请求的后台地址
            dataType: 'JSON',
            data: g_GodownEntryData,//前台传给后台的参数
            success: function (msg) {//msg:返回值
                var jsonObj = msg;

                if (jsonObj['result'] != 'success') {
                    noticeError(jsonObj['info']);
                    return;
                }

                /*
                var noticeInfo = "";
                if (jsonObj['code'] != $("#form_data_code").val()) {
                    noticeInfo += "请购单号被更新为 " + jsonObj['code'] + " ";
                }

                if (jsonObj['items'].length > 0) {
                    noticeInfo += "增加了部分物料信息" + " ";
                }

                noticeInfo += "提交请购单号成功！";
                noticeWarning(noticeInfo);
                */
                console.debug(msg);

                //$("#myModal").modal();


                alert("提交入库单成功");
                //location.reload();
                //document.getElementById("head_msg_info").innerHTML = msg;
            },
            error: function (request) {
                alert('error');
                console.log(request);
            }
        });
    }

</script>

<?php
$requestion_QSInfo = getRequestionCode();
if (null == $requestion_QSInfo) {
    //
} else {
    $requestion_code = $requestion_QSInfo["code"];
    $requestion_code_number = $requestion_QSInfo["number"];
}
getRequestionCode();
$products = find_product('product');
$qualification = find_all('supplier');

$requestion = get_godown_entrys();

$projects = find_all('project');
$units = find_all('units');
$users = find_all('users');
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12" id="head_msg_info">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row">
    <div class="panel panel-default ">
        <div class="text-center">
            <h3>填写入库单</h3>
        </div>
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-pencil"></span>
                <span>填写入库信息</span>
            </strong>
            <button name="add_product" class="btn btn-primary pull-right" onclick="submitGodownEntry(0)">提交入库单</button>
        </div>
        <div class="panel-body">
            <div class="row col-md-12">
                <div class="form-default" role="form">
                    <div class="row col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>供应商:</label>
                                <div class="input-group  col-md-12">
                                    <input type="text" id="product_supplier_name" class="form-control"
                                           list="product_supplier_info_list" placeholder="选择或输入供应商"
                                           onchange="onSupplierChange()">
                                    <datalist class="form-control" id="product_supplier_info_list"
                                              style="display:none;">
                                        <?php foreach ($qualification as $cat): ?>
                                            <option value="<?php echo $cat['name'] ?>"
                                                    data-id="<?php echo (int)$cat['id'] ?>"></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>内部请购单号:</label>
                                <div class="input-group col-md-12">
                                    <input type="text" id="product_requestion_code" class="form-control"
                                           list="product_requestion_code_list" placeholder="选择或输入内部请购单号"
                                           onchange="onRequestionChange()">
                                    <datalist class="form-control col-md-12" id="product_requestion_code_list"
                                              style="display:none;">
                                        <?php foreach ($requestion as $product): ?>
                                            <option data-id="<?php echo $product['id'] ?>"
                                                    data-name="<?php echo $product['initiator_name'] ?>"
                                                    value="<?php echo $product['code'] ?>"></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>
                                <label>请购人：</label>
                            </div>
                            <div class="input-group col-md-12">
                                <input type="text" disabled="disabled" class="form-control" id="data_user_name">
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>
                                <label>入库类别</label>
                            </div>
                            <div class="input-group col-md-12">
                                <select class="form-control" id="xx">
                                    <option>研发</option>
                                    <option>低耗</option>
                                    <option>其他</option>
                                </select>
                            </div>
                        </div>
                        <!--
                        <div class="form-group col-md-2">
                            <div>
                                <label >期望货期：</label>
                            </div>
                            <div class="input-group col-md-12">
                                <input type="text" disabled="disabled" class="form-control" id="data_expect_date">
                            </div>
                        </div>


                        <div class="form-group col-md-3">
                            <div>
                                <label>项目：</label>
                            </div>
                            <div class="input-group col-md-12">
                                <input type="text" disabled="disabled"  class="form-control" id="data_project_nama">
                            </div>
                        </div>
                        -->


                    </div>

                    <div class="row col-md-12"
                         style="background:#c4e3f3;height: 2px;margin-bottom: 15px;margin-left:20px;"></div>
                    <div class="row col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>物料名称规格:</label>
                                <div class="input-group col-md-12">
                                    <select class="form-control" id="product_name_info_list" placeholder="请先选择请购单号"
                                            onchange="onProductChanged()">
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="qty" id="product_number_info">物料数量:（请购:0,已入库:0）</label>
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" id="data_product_number" value="1">
                                    <span class="input-group-addon">
                                        <div>个</div>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-2 collapse">
                            <div>
                                <label>单价：</label>
                            </div>
                            <div class="input-group col-md-12 collapse">
                                <span class="input-group-addon" onclick="money_click()">
                                        <div id="flag_price">￥</div>
                                    </span>
                                <input type="text" class="form-control" id="data_price"
                                       onchange="document.getElementById('head_msg_info').innerHTML = '';" value="0.00">
                            </div>
                        </div>
                        <div class="form-group col-md-2 collapse">
                            <div>
                                <label>总价：</label>
                            </div>
                            <div class="input-group col-md-12 collapse">
                                <span class="input-group-addon" onclick="money_click()">
                                        <div id="flag_total_price">￥</div>
                                    </span>
                                <input type="text" class="form-control" id="data_total_price" value="0.00"
                                       onchange="document.getElementById('head_msg_info').innerHTML = '';">
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>
                                <label>备注：</label>
                            </div>
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control" id="data_memo">
                            </div>
                        </div>
                    </div>

                    <div class="row col-md-3">
                        <div class="col-md-12">
                            <button name="add_detail" type="submit" class="btn btn-primary center-block"
                                    onclick="addDetails()">添加入库信息
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>入库物料列表</span>
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
                    <td class="text-center" colspan="2" id="data_godown_code"><?php echo $rk_code_info['code']; ?></td>

                </tr>
                <tr>
                    <td class="text-right" colspan="1"><b>部门：</b></td>
                    <td class="text-left" colspan="4">研发中心</td>

                    <td class="text-right" colspan="3"><b>入库日期:</b></td>
                    <td class="text-center" colspan="2" id="data-date">2018-10-20</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="1"><b>供应商：</b></td>
                    <td class="text-left" colspan="4" id="data_supplier_name"></td>
                    <td class="text-right" colspan="3"><b>请购单号:</b></td>
                    <td class="text-center" colspan="2" id="data_requestion_code"></td>
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
                    <td class="text-center" style="width:60px;">操作</td>
                </tr>
                </thead>
                <tbody id="product_details" class="text-center">


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
    document.getElementById("data-date").innerText = today;
</script>
<?php include_once('layouts/footer.php'); ?>

