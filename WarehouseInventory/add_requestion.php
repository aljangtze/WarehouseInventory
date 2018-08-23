<?php
$page_title = '新建请购单';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
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
$products = find_product('product');
$all_categories = find_all('categories');
$all_photo = find_all('media');
$qualification = find_all('qualification');
$projects = find_all('project');
$units = find_all('units');
$users = find_all('users');
//if(!$product){
//  $session->msg("d","Missing product id.");
//  redirect('add_requestion.php');
//}
?>

<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-sm">
        <img alt=""
             src="data:image/gif;base64,R0lGODlhGQAZAJECAK7PTQBjpv///wAAACH/C05FVFNDQVBFMi4wAwEAAAAh/wtYTVAgRGF0YVhNUDw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo5OTYyNTQ4Ni02ZGVkLTI2NDUtODEwMy1kN2M4ODE4OWMxMTQiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RUNGNUFGRUFGREFCMTFFM0FCNzVDRjQ1QzI4QjFBNjgiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RUNGNUFGRTlGREFCMTFFM0FCNzVDRjQ1QzI4QjFBNjgiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjk5NjI1NDg2LTZkZWQtMjY0NS04MTAzLWQ3Yzg4MTg5YzExNCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5OTYyNTQ4Ni02ZGVkLTI2NDUtODEwMy1kN2M4ODE4OWMxMTQiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4B//79/Pv6+fj39vX08/Lx8O/u7ezr6uno5+bl5OPi4eDf3t3c29rZ2NfW1dTT0tHQz87NzMvKycjHxsXEw8LBwL++vby7urm4t7a1tLOysbCvrq2sq6qpqKempaSjoqGgn56dnJuamZiXlpWUk5KRkI+OjYyLiomIh4aFhIOCgYB/fn18e3p5eHd2dXRzcnFwb25tbGtqaWhnZmVkY2JhYF9eXVxbWllYV1ZVVFNSUVBPTk1MS0pJSEdGRURDQkFAPz49PDs6OTg3NjU0MzIxMC8uLSwrKikoJyYlJCMiISAfHh0cGxoZGBcWFRQTEhEQDw4NDAsKCQgHBgUEAwIBAAAh+QQFCgACACwAAAAAGQAZAAACTpSPqcu9AKMUodqLpAb0+rxFnWeBIUdixwmNqRm6JLzJ38raqsGiaUXT6EqO4uIHRAYQyiHw0GxCkc7l9FdlUqWGKPX64mbFXqzxjDYWAAAh+QQFCgACACwCAAIAFQAKAAACHYyPAsuNH1SbME1ajbwra854Edh5GyeeV0oCLFkAACH5BAUKAAIALA0AAgAKABUAAAIUjI+py+0PYxO0WoCz3rz7D4bi+BUAIfkEBQoAAgAsAgANABUACgAAAh2EjxLLjQ9UmzBNWo28K2vOeBHYeRsnnldKBixZAAA7"/>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    var opts = {
        lines: 10, // 花瓣数目
        length: 2, // 花瓣长度
        width: 3, // 花瓣宽度
        radius: 5, // 花瓣距中心半径
        corners: 1, // 花瓣圆滑度 (0-1)
        rotate: 0, // 花瓣旋转角度
        direction: 1, // 花瓣旋转方向 1: 顺时针, -1: 逆时针
        color: '#51aded', // 花瓣颜色
        speed: 1, // 花瓣旋转速度
        trail: 60, // 花瓣旋转时的拖影(百分比)
        shadow: false, // 花瓣是否显示阴影
        hwaccel: false, //spinner 是否启用硬件加速及高速旋转
        className: 'spinner', // spinner css 样式名称
        zIndex: 2e9, // spinner的z轴 (默认是2000000000)
        top: '16', // spinner 相对父容器Top定位 单位 px
        left: '20'// spinner 相对父容器Left定位 单位 px
    };

    function hideModal() {
        $('#myModal').modal('hide');
    }

    function showModal() {
        $('#myModal').modal({backdrop: 'static', keyboard: false});
    }

    var product_id = 0;
    var detail_count = 0;

    //详细信息
    var g_reqeustionData = {};
    g_reqeustionData['items'] = JSON.parse("{}");

    function isEmpty(a) {
        if (a == "" || a == null || a == undefined) {
            return true;
        }
        else {
            return false;
        }
    }

    //更新产品规格内容
    function updateSpecification(e) {
        //清除提示信息
        document.getElementById("head_msg_info").innerHTML = "";
        //选择值
        //var product_name = $("#product_name_info").val();
        var product_name = $("#product_name_info_list").val();

        //设置规格为空
        //document.getElementById("product_input_specification").value = "";
        document.getElementById("product_input_specification_list").innerHTML = "";


        //设置型号为空
        //document.getElementById("product_input_modelnumber").value = "";
        document.getElementById("product_input_modelnumber_list").innerHTML = "";

        if (isEmpty(product_name)) {
            return;
        }


        var spinner = new Spinner(opts);

        //document.getElementById("specification_loading").style.display = 'block';
        //ajax获取数据
        $.ajax({
            type: "GET",
            url: "get_specifications.php",//请求的后台地址
            data: "product_name=" + product_name,//前台传给后台的参数
            beforeSend: function () {
                var target = $("#specification_loading").get(0);
                spinner.spin(target);//显示loading图

                // document.getElementById("specification_loading").style.display = "none";
            },
            success: function (msg) {//msg:返回值
                var jsonObj = JSON.parse(msg);
                var result = jsonObj.result;
                spinner.spin();
                //没找到相应的物料
                if (result == 'undefined') {
                    //document.getElementById("product_input_specification").value = "/";
                    //document.getElementById("product_input_modelnumber").value = "/";
                    noticeWarning("物料名称不存在，将自动添加，请注意添加规格型号，单位及物料类别");
                    return;
                }
                if (result != 'success') {
                    noticeError("获取物料规格信息失败");
                    return;
                }

                /*if(jsonObj.count <=0)
                {
                    noticeWarning("此物料不存在，将自动添加");
                    document.getElementById("product_specification_info").innerHTML = "";
                    return;
                }*/

                var items = jsonObj.items;
                var returnInnerXml = "";
                if (items.length == 1) {
                    document.getElementById("product_input_specification_list").innerHTML = "<option value=\"" + items[0].specification + "\" >" + items[0].specification + "</option>";
                    //document.getElementById("product_input_specification").value = items[0].specification;

                    //通过修改规格来修改型号
                    updateModelnumber();
                }
                else {
                    //设置
                    for (var i = 0; i < items.length; i++) {
                        returnInnerXml += "<option value=\"" + items[i].specification + "\">" + items[i].specification + "</option>";
                    }

                    document.getElementById("product_input_specification_list").innerHTML = returnInnerXml;

                    updateModelnumber();
                }
            }
        });
        return;
    }

    //更新产品型号内容
    function updateModelnumber(e) {
        document.getElementById("head_msg_info").innerHTML = "";

        //设置型号为空
        //document.getElementById("product_input_modelnumber").value = "";
        document.getElementById("product_input_modelnumber_list").innerHTML = "";

        //var product_specification = $("#product_input_specification").val();
        //var product_name = $("#product_name_info").val();
        var product_specification = $("#product_input_specification_list").val();

        var product_name = $("#product_name_info_list").val();
        //alert(product_name);
        //alert(product_specification);

        if (isEmpty(product_specification)) {
            return;
        }

        var spinner = new Spinner(opts);
        $.ajax({
            type: "GET",
            url: "get_modelnumber.php",//请求的后台地址
            data: "product_name=" + product_name + "&specification=" + product_specification,//前台传给后台的参数,
            beforeSend: function () {
                var target = $("#modelnumber_loading").get(0);
                spinner.spin(target);//显示loading图

                // document.getElementById("specification_loading").style.display = "none";
            },
            success: function (msg) {
                //msg:返回值
                var jsonObj = JSON.parse(msg);
                var result = jsonObj.result;

                //没找到相应的物料
                if (result == 'undefined') {
                    //document.getElementById("product_input_modelnumber").value = "/";
                    document.getElementById("product_input_modelnumber_list").innerHTML = "";

                    noticeWarning("物料规格不存在，将自动添加，请注意修改型号，单位和物料类别");
                    return;
                }
                if (result != 'success') {
                    noticeError("获取物料型号信息失败");
                    return;
                }

                var items = jsonObj.items;

                if (items.length == 1) {
                    //document.getElementById("product_input_modelnumber").value = items[0].model_number;
                    document.getElementById("product_input_modelnumber_list").innerHTML = "<option value=\"" + items[0].model_number + "\" data-unit=" + items[0].unit + " data-type=" + items[0].type + ">" + items[0].model_number + "</option>";

                    //$("#data_product_unit").val(items[0].unit);
                    //alert(items[0].unit);
                    $("#data_product_unit").text(items[0].unit);
                    $("#data_product_type").val(items[0].type);
                }
                else {
                    var returnInnerXml = "";
                    for (var i = 0; i < items.length; i++) {
                        returnInnerXml += "<option value=\"" + items[i].model_number + "\" data-unit=" + items[i].unit + " data-type=" + items[i].type + ">" + items[i].model_number + "</option>";
                    }

                    document.getElementById("product_input_modelnumber_list").innerHTML = returnInnerXml;
                }
                spinner.spin();
            }
        });
    }

    function updateUnitAddType(e) {
        document.getElementById("head_msg_info").innerHTML = "";

        //$("#data_product_unit").val("个");
        //$("#data_product_type").val(1);


        var options = document.getElementById("product_input_modelnumber_list").options;
        var option_length = options.length;
        var option_unit = "个";
        var option_type = "1";
        var modelnumber_name = document.getElementById("product_input_modelnumber").value;

        for (var i = 0; i < option_length; i++) {

            var option = options[i];
            var option_value = option.value;

            if (modelnumber_name == option_value) {
                option_unit = option.attributes['data-unit'].value;
                option_type = option.attributes['data-type'].value;

                break;
            }
        }

        $("#data_product_unit").val(option_unit);
        $("#data_product_type").val(option_type);
    }

    function validateData(data, info, flag) {
        var a = data;
        if (a == "" || a == null || a == undefined) {
            if (flag == true) {
                noticeError("添加请购信息失败:  \"" + info + "\"  不能为空,若没有特定的信息请使用 \"/\" 进行填充！");
            }
            else {
                noticeError("添加请购信息失败:  \"" + info + "\"  不能为空,请修改相应数据后重新添加！");
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

        delete  g_reqeustionData.items[id];

        $('#' + id).remove();
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

        if (false == validateData(($("#product_name_info_list").val()), "物料名称")) {
            $("#product_name_info_list").focus();
            return;
        }

        if (false == validateData(($("#product_input_specification_list").val()), "物料规格", true)) {
            $("#product_input_specification_list").focus();
            return;
        }
        if (false == validateData(($("#product_input_modelnumber_list").val()), "物料型号", true)) {
            $("#product_input_modelnumber_list").focus();
            return;
        }
        //检查是否已经添加过某物品
        for (var curData in g_reqeustionData.items) {
            var item = g_reqeustionData.items[curData];
            //console.log("item is ", item);
            //console.log($("#product_name_info").val(),  $("#product_input_specification").val(), $("#product_input_modelnumber").val())
            if (item['product_name'] == $("#product_name_info_list").val() &&
                item['specification_name'] == $("#product_input_specification_list").val() &&
                item['modelnumber_name'] == $("#product_input_modelnumber_list").val()) {
                noticeError("已经添加过此物料 \"" + $("#product_name_info_list").val() + "\" ，一个请购单一类物料只能有一条信息！");
                return;
            }
        }


        detail_count = detail_count + 1;

        jsonData = {};

        jsonData['id'] = detail_count;
        jsonData['tr_id'] = "product_details_" + detail_count;
        jsonData['date_start'] = $("#data_start_date").val();
        jsonData['date_end'] = $("#data_expect_date").val();
        jsonData['project_name'] = $("#data_project").find("option:selected").text();
        jsonData['project_id'] = $("#data_project").val();
        jsonData['product_name'] = $("#product_name_info_list").val();
        jsonData['specification_name'] = $("#product_input_specification_list").val();
        jsonData['modelnumber_name'] = $("#product_input_modelnumber_list").val();
        jsonData['product_number'] = $("#data_product_number").val();
        jsonData['unit'] = $("#data_product_unit").text();
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

    function getFormData() {

        g_reqeustionData['code'] = $("#form_data_code").val();
        g_reqeustionData['initiator'] = document.getElementById("form_data_user_name").attributes['user-id'].value;
        g_reqeustionData['initiator_name'] = $("#form_data_user_name").val();

        g_reqeustionData['operator'] = $("#form_data_operator").val();
        g_reqeustionData['operator_name'] = $("#form_data_operator").find("option:selected").text();

        if ('{}' == JSON.stringify(g_reqeustionData.items)) {
            noticeError(" 请添加请购的物料信息列表 ");
            return false;
        }


        return true;
        //console.debug(g_reqeustionData);
    }

    //提交请购单
    function submitRequestion() {
        if (false == getFormData())
            return;

        $.ajax({
            type: "POST",
            url: "add_requestion_background.php",//请求的后台地址
            dataType: 'JSON',
            data: g_reqeustionData,//前台传给后台的参数
            beforeSend: function () {
                showModal();
            },
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


                alert("提交请购单据成功");
                location.reload();
                //document.getElementById("head_msg_info").innerHTML = msg;
                hideModal();
            },
            error: function (request) {
                hideModal();
                alert('error');
                console.log(request);

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
<div class="row">
    <div class="panel panel-default ">
        <div class="text-center">
            <h3>填写请购单</h3>
        </div>
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-pencil"></span>
                <span>填写请购信息</span>
            </strong>
            <button name="add_product" class="btn btn-primary pull-right" onclick="submitRequestion(0)">提交请购单</button>
        </div>
        <div class="panel-body">
            <div class=" col-md-2">
                <div class="form-group">
                    <label>请购单号：</label>
                    <input type="text" class="form-control" name="product-quantity" disabled="disabled"
                           id="form_data_code"
                           value="<?php echo $requestion_code ?>">
                </div>
                <div class="form-group">
                    <label class="text-right">请购人：</label>
                    <input type="text" class="form-control " name="product-quantity" disabled="disabled"
                           id="form_data_user_name"
                           value="<?php echo remove_junk(ucfirst($user['name'])); ?>"
                           user-id="<?php echo remove_junk(ucfirst($user['id'])); ?>">
                </div>
                <div class="form-group">
                    <label class="text-right">提交处理：</label>
                    <select class="form-control" style="color: blue;" id="form_data_operator">
                        <?php foreach ($users as $cat): ?>
                            <option
                            value="<?php echo (int)$cat['id'] ?>"><?php echo $cat['name'] ?></option><?php endforeach; ?>
                    </select>
                </div>
                <!--
                <div class="form-group">
                    <label class="text-right">创建日期：</label>
                    <input type="text" class="form-control" name="product-quantity" disabled="disabled"
                           value="<?php echo date("Y年m月j日"); ?>">
                </div>-->
            </div>
            <div class="row col-md-10">
                <div class="form-default" role="form">
                    <div class="col-md-12">
                        <div class="form-group col-md-3">
                            <label for="qty">项目：</label>
                            <div class="input-group col-md-12">
                                <select class="form-control col-md-1" name="product-categorie" id="data_project">
                                    <?php foreach ($projects as $cat): ?>
                                        <option
                                        value="<?php echo (int)$cat['id'] ?>"><?php echo $cat['name'] ?></option><?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <div>
                                <label>请购日期：</label>
                            </div>
                            <div class="input-group col-md-12">
                                <input type="date" class="datepicker form-control" id="data_start_date">
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="qty">期望货期:</label>
                            <div class="input-group col-md-12">
                                <input type="date" class="datepicker form-control" id="data_expect_date">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qty">物料代码：</label>
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" id="data_product_code">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>物料名称:</label>
                                <div class="input-group col-md-12">
                                    <!--<input type="text" id="product_name_info" class="form-control"
                                           list="product_name_info_list"
                                           onchange="updateSpecification()"
                                           name="product-quantity" placeholder="选择或输入">-->
                                    <select id="product_name_info_list" class="form-control"
                                            onchange="updateSpecification()">
                                        <?php foreach ($products as $product): ?>
                                            <option data-id="<?php echo $product['id'] ?>"
                                                    value="<?php echo $product['name'] ?>"><?php echo $product['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qty">物料规格:</label>
                                <div class="input-group col-md-12">
                                    <!--<input type="text" class="form-control" list="product_input_specification_list"
                                           id="product_input_specification"
                                           name="product-quantity" placeholder="选择或输入"
                                           onchange="updateModelnumber()">-->
                                    <select id="product_input_specification_list" class="form-control"
                                            onchange="updateModelnumber()">

                                    </select>
                                    <span>
                                        <div id="specification_loading"></div>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qty">物料型号:</label>
                                <!--<input type="text" class="form-control" list="product_input_modelnumber_list"
                                       id="product_input_modelnumber" onchange="updateUnitAddType()"
                                       placeholder="选择或输入">-->
                                <div class="input-group col-md-12">
                                    <select id="product_input_modelnumber_list" class="form-control"
                                            onchange="updateUnitAddType()">
                                    </select>
                                    <span>
                                    <div id="modelnumber_loading"></div>
                                </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="qty">物料数量:</label>
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" id="data_product_number" value="1">
                                    <span class="input-group-addon">
                                        <div id="data_product_unit">个</div>
                                        <!--<select id="data_product_unit">
                                            <?php foreach ($units as $cat): ?>
                                                <option value="<?php echo $cat['name'] ?>"
                                                        data-id="<?php echo (int)$cat['id'] ?>"><?php echo $cat['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>-->
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label>物料类别:</label>
                                <div class="input-group">
                                    <select class="form-control" id="data_product_type" disabled="disabled">
                                        <option value="1" selected="selected">A 类</option>
                                        <option value="2">B 类</option>
                                        <option value="3">C 类</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>资质要求:</label>
                                <div class="input-group  col-md-12">
                                    <select class="form-control" name="data_product_qualification"
                                            id="data_product_qualification">
                                        <?php foreach ($qualification as $cat): ?>
                                            <option value="<?php echo (int)$cat['id'] ?>"><?php echo $cat['qualification_info'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="qty">是否试样:</label>
                                <div class="input-group">
                                    <select class="form-control" name="status" id="data_need_test">
                                        <option value="1">是</option>
                                        <option value="0" selected="selected">否</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="qty">二次加工:</label>
                                <div class="input-group">
                                    <select class="form-control" name="status" id="data_process_again">
                                        <option value="1">是</option>
                                        <option value="0" selected="selected">否</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-offset-6">
                            <div class="form-group   col-md-6">
                                <label>参考链接:</label>
                                <div class="input-group  col-md-12">
                                    <input type="text" class="form-control" name="product-quantity"
                                           id="data_product_reference">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qty">备注:</label>
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" name="product-quantity"
                                           id="data_product_memo">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-md-3">
                        <div class="col-md-12">
                            <button name="add_detail" type="submit" class="btn btn-primary center-block"
                                    onclick="addDetails()">添加请购信息
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
                <span>请购物料列表</span>
            </strong>
        </div>
        <div class="panel-body">
            <table class="table table-bordered" align="center">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">请购日期</th>
                    <th class="text-center">期望货期</th>
                    <th class="text-center">项目</th>
                    <th class="text-center">品名</th>
                    <th class="text-center">规格</th>
                    <th class="text-center">型号</th>
                    <th class="text-center">数量</th>
                    <th class="text-center">单位</th>
                    <th class="text-center">物料类别</th>
                    <th class="text-center">物料代码</th>
                    <th class="text-center">资质要求</th>
                    <th class="text-center">参考资源</th>
                    <th class="text-center">是否试样</th>
                    <th class="text-center">二次加工</th>
                    <th class="text-center">备注</th>
                    <th class="text-center">操作</th>
                </tr>
                </thead>
                <tbody id="product_details" class="text-center">
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
<script type="text/javascript">
    document.getElementById("data_expect_date").valueAsDate = new Date();
    document.getElementById("data_start_date").valueAsDate = new Date();

    updateSpecification();


</script>

