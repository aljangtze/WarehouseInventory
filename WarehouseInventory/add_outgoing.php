<?php
$page_title = '出库信息';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
$ck_code_info = getOutgoingCode();
?>


<script type="text/javascript">

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
            <h3>填写出库单</h3>
        </div>
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-pencil"></span>
                <span>填写出库信息</span>
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
                                <label>合同单号:</label>
                                <div class="input-group col-md-12">
                                    <input type="text" id="product_requestion_code" class="form-control"
                                           list="product_requestion_code_list" placeholder="选择或输入请购单号"
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>内部请购单号:</label>
                                <div class="input-group col-md-12">
                                    <input type="text" id="product_requestion_code" class="form-control"
                                           list="product_requestion_code_list" placeholder="选择或输入请购单号"
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
                                <label>出库人：</label>
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
                                <label for="qty">物料数量:</label>
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" id="data_product_number" value="1">
                                    <span class="input-group-addon">
                                        <div>个</div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-2">

                            <div>
                                <label>单价：</label>
                            </div>
                            <div class="input-group col-md-12">
                                <span class="input-group-addon" onclick="money_click()">
                                        <div id="flag_price">￥</div>
                                    </span>
                                <input type="text" class="form-control" id="data_price"
                                       onchange="document.getElementById('head_msg_info').innerHTML = '';" value="0.00">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <div>
                                <label>总价：</label>
                            </div>
                            <div class="input-group col-md-12">
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
                    <td class="text-center" colspan="2" id="data_godown_code"><?php echo $ck_code_info['code']; ?></td>
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

