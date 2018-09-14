<?php
$page_title = '出库信息';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level("30001");
$ck_code_info = getOutgoingCode();

$product_details = get_outgoing_requestion_details();
?>
<?php include_once('layouts/header.php'); ?>
<script>
    var product_count = 0;
    var product_name = '';
    var requeston_detail_id = '';
    var product_sec_model = '';
    var product_unit = '';
    var requestion_project = "";
    var canOutgoingNumber = 0;
    var product_id = 0;
    var project_id = 0;
    var supplier_id = 0;

    var g_GodownEntryData = {};
    g_GodownEntryData.items = {};

    function onProductChanged() {
        //console.log("on product changed");
        var options = document.getElementById("product_name_info_list").options;
        product_name = document.getElementById("product_name_info").value;
        console.log(product_name);
        requeston_detail_id = 0;
        product_id = 0;
        project_id = 0;
        supplier_id = 0;

        for (var i = 0; i < options.length; i++) {
            var option = options[i];

            var option_value = option.value;

            if (product_name == option_value) {
                requeston_detail_id = option.attributes['data-id'].value;
                product_name = option.attributes['data-row-num'].value + ": " + option.attributes['data-product-name'].value;
                product_sec_model = option.attributes['data-product-sec-model'].value;
                product_unit = option.attributes['data-unit'].value;
                requestion_project = option.attributes['data-project-name'].value;
                product_id = option.attributes['data-product-id'].value;
                project_id = option.attributes['data-project-id'].value;
                supplier_id = option.attributes['data-supplier-id'].value;
                var requestion_number = option.attributes['data-requestion-number'].value;
                var godown_number = parseInt(option.attributes['data-godown-number'].value);
                var outgoing_number = parseInt(option.attributes['data-outgoing-number'].value);
                canOutgoingNumber = godown_number - outgoing_number;

                $("#product_number_info").text("物料名称规格:（请购:" + requestion_number + ",可出库:" + canOutgoingNumber + "）");
                //console.log(requeston_detail_id);
                //console.log(product_name);
                //console.log(product_sec_model);
                //console.log(product_unit);
                //console.log(requestion_project);

                break;
            }
        }
    }

    function deleteNode(id) {
        $('#' + id).remove();
        delete  g_GodownEntryData.items[id];
    }


    function addDetails() {
        $("#head_msg_info").html("");

        //console.log('add details');
        //console.log(product_name);

        if (false == validateData(product_name, "物料名称和规格信息")) {
            return;
        }

        /*
        console.log($("#product_requestion_code").text());
        if ($("#product_requestion_code").val() == "") {
            noticeError("添加入库信息失败，请先选择需要入库的请购单号");
            return;
        }*/

        if (requeston_detail_id == 0) {
            noticeError("没有此物料 \"" + product_name + "\" 的库存信息，不能添加出库！");
            return;
        }

        var product_number = Number($("#data_product_number").val());
        if (product_number <= 0 || isNaN(product_number)) {
            noticeError("添加入库信息失败: 入库数量必须为大于0的数字，,请修改相应数据后重新添加！");
            return;
        }

        if (product_number > canOutgoingNumber) {
            noticeError("添加入库信息失败: 入库数量必须小于库存！库存数量为:" + canOutgoingNumber);
            $("#data_product_number").focus();
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
                console.log(requeston_detail_id);
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
            //"   <td class=\"text-center\">" + $("#flag_price").text() + ' ' + $("#data_price").val() + "</td>" +
            //"   <td class=\"text-center\">" + $("#flag_total_price").text() + ' ' + $("#data_total_price").val() + "</td>" +
            //"   <td class=\"text-center\">" + requestion_project + "</td>" +
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
        jsonData['outgoing_number'] = product_number;
        jsonData['project_id'] = project_id;
        jsonData['product_id'] = product_id;
        jsonData['supplier_id'] = supplier_id;
        jsonData['memo'] = $("#data_memo").val();
        g_GodownEntryData.items[jsonData['id']] = jsonData;

        $("#product_name_info").val("");
        product_name = "";
        requeston_detail_id = 0;
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

    function submitGodownEntry() {
        var isFind = false;
        for (var data in g_GodownEntryData.items) {
            isFind = true;
            break;
        }
        if (isFind == false) {
            noticeError("没有入库信息，请添加");
            return;
        }
        g_GodownEntryData['operate_type'] = 1;
        g_GodownEntryData['code'] = $('#data_godown_code').text();
        console.log(g_GodownEntryData);

        $.ajax({
            type: "POST",
            url: "add_outgoing_server.php",//请求的后台地址
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


                alert("提交出库单成功");
                location.reload();
                //document.getElementById("head_msg_info").innerHTML = msg;
            },
            error: function (request) {
                alert('error');
                console.log(request);
            }
        });
    }

</script>
<div class="row">
    <div class="col-md-12" id="head_msg_info">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row">
    <div class="panel panel-default ">
        <div class="text-center">
            <h3>填写出库单</h3>
        </div>
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-pencil"></span>
                <span>填写出库信息</span>
            </strong>
            <button name="add_product" class="btn btn-primary pull-right" onclick="submitGodownEntry(0)">提交出库单</button>
        </div>
        <div class="panel-body">
            <div class="row col-md-12">
                <div class="form-default" role="form">
                    <div class="row col-md-12">
                        <div class="form-group col-md-2">
                            <div>
                                <label>出库人：</label>
                            </div>
                            <div class="input-group col-md-12">
                                <input type="text" disabled="disabled" class="form-control" id="data_user_name"
                                       value="<?php echo current_user()['name']; ?>">
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <div>
                                <label>出库类别</label>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label id="product_number_info">物料名称规格:</label>
                                <div class="input-group col-md-12">
                                    <input type="text" id="product_name_info" class="form-control"
                                           list="product_name_info_list" onchange="onProductChanged()"
                                           placeholder="选择或输入">
                                    <datalist id="product_name_info_list" class="form-control"
                                              style="display: none;">
                                        <?php foreach ($product_details as $product): ?>
                                            <option data-row-num="<?php echo $product['row_num']; ?>"
                                                    data-requestion-number="<?php echo $product['requestion_number']; ?>"
                                                    data-godown-number="<?php echo $product['godown_number']; ?>"
                                                    data-outgoing-number="<?php echo $product['outgoing_number']; ?>"
                                                    data-project-name="<?php echo $product['project_name']; ?>"
                                                    data-project-id="<?php echo $product['project_id']; ?>"
                                                    data-product-id="<?php echo $product['product_id']; ?>"
                                                    data-supplier-id="<?php echo $product['supplier_id']; ?>"
                                                    data-unit="<?php echo $product['unit']; ?>"
                                                    data-product-name="<?php echo $product["product_name"]; ?>"
                                                    data-product-specification="<?php echo $product["specification"]; ?>"
                                                    data-product-modelinfo="<?php echo $product["specification"]; ?>"
                                                    data-product-sec-model="<?php echo $product["specification"] . "," . $product["model_number"]; ?>"
                                                    data-id="<?php echo $product['id']; ?>"

                                                    value="<?php echo $product['row_num'] . '.  ' . $product['product_name'] . ',' . $product['specification'] . ',' . $product['model_number']; ?>">
                                                <?php echo '库存:' . ($product['godown_number'] - $product['outgoing_number']);//echo $product['row_num'] . '.  ' . $product['product_name'] . ',' . $product['specification'] . ',' . $product['model_number']; ?>
                                            </option>
                                        <?php endforeach; ?>

                                        <input class="form-control" list="product_name_info_list" id="product_name_info"
                                               type="text">
                                        <datalist class="form-control" id="product_name_info_list"
                                                  placeholder="请先选择请购单号"
                                                  style="display: none">
                                            <?php foreach ($product_details as $product): ?>

                                            <?php endforeach; ?>
                                        </datalist>
                                    </datalist>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="qty">物料数量:</label>
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" id="data_product_number" value="1">
                                    <span class="input-group-addon">
                                        <div>个</div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div>
                                <label>备注：</label>
                            </div>
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control" id="data_memo">
                            </div>
                        </div>
                    </div>

                    <div class="row col-md-9">
                        <div class="col-md-12">
                            <button name="add_detail" type="submit" class="btn btn-primary center-block"
                                    onclick="addDetails()">添加出库信息
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
                <span>出库物料列表</span>
            </strong>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped" align="center">
                <thead>
                <tr>
                    <td colspan="8" class="text-center"><h4><b>出库单</b></h4></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="1"><b>单位：</b></td>
                    <td class="text-left" colspan="2" id="data_company_name">四川蓝光英诺生物科技股份有限公司</td>
                    <td class="text-right" colspan="2"
                    <b>出库单号:</b></td>
                    <td class="text-center" colspan="2" id="data_godown_code"><?php echo $ck_code_info['code']; ?></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="1"><b>部门：</b></td>
                    <td class="text-left" colspan="2">研发中心</td>

                    <td class="text-right" colspan="2"><b>出库日期:</b></td>
                    <td class="text-center" colspan="2" id="data-date">2018-10-20</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="1"><b>供应商：</b></td>
                    <td class="text-left" colspan="2" id="data_supplier_name"></td>
                    <!--<td class="text-right" colspan="2"><b>请购单号:</b></td>
                    <td class="text-center" colspan="2" id="data_requestion_code"></td>-->
                </tr>
                <tr>
                    <td class="text-center"><b>序号</b></td>
                    <td class="text-center"><b>品名</b></td>
                    <td class="text-center"><b>规格型号</b></td>
                    <td class="text-center"><b>单位</b></td>
                    <td class="text-center"><b>数量</b></td>
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

