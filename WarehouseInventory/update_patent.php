<?php
$page_title = '编辑专利信息';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level("60000");
?>

<?php
    $patentData = find_by_id('patent',(int)$_GET['id']);
?>

<?php include_once('layouts/header.php'); ?>

<script type="text/javascript">

    //var ds = '<?php $patentData = find_by_id('patent',(int)$_GET['id']); echo str_replace('"', '"', json_encode($patentData)); ?>';
    //console.log(ds);
    //var requestion_data = JSON.parse(ds);
    //console.log(requestion_data);
    var g_id = '<?php echo $_GET['id'];?>';
    function validateData(data, info, flag) {
        var a = data;
        if (a == "" || a == null || a == undefined) {
            if (flag == true) {
                noticeError("添加失败:  \"" + info + "\"  不能为空,若没有特定的信息请使用 \"/\" 进行填充！");
            }
            else {
                noticeError("添加入库信息失败:  \"" + info + "\"  不能为空,请修改相应数据后重新添加！");
            }
            return false;
        }

        return true;
    }

    function submitPatent() {
        //更新
        var patentData = {};
        patentData['operate_code'] = 1;
        var data = {};
        data['id'] = g_id;
        data['project_code'] = $('#project_code').val();
        data['office_code'] = $('#office_code').val();
        data['name'] = $('#patent_name').val();
        data['type'] = $('#patent_type').val();
        data['country'] = $('#country').val();
        data['patent_code'] = $('#patent_code').val();
        data['submit_date'] = $('#submit_date').val();
        data['law_status'] = $('#law_status').val();
        data['is_early_public'] = $('#is_early_public').val()=='是'?1:0;
        data['submit_early_public_date'] = $('#submit_early_public_date').val();
        data['is_actual_audit'] = $('#is_actual_audit').val()=='是'?1:0;
        data['submit_actual_audit_date'] = $('#submit_actual_audit_date').val();
        data['actual_audit_notice_date'] = $('#actual_audit_notice_date').val();
        data['priority_code'] = $('#priority_code').val();
        data['priority_date'] = $('#priority_date').val();
        data['submit_user'] = $('#submit_user').val();
        data['invertor_user'] = $('#invertor_user').val();
        data['office_name'] = $('#office_name').val();
        data['level1'] = $('#level_list1_input').val();
        data['level2'] = $('#level_list2_input').val();
        data['level3'] = $('#level_list3_input').val();
        data['level4'] = $('#level_list4_input').val();
        data['notification_type'] = $('#notification_type').val();
        data['agent_answer_date'] = $('#agent_answer_date').val();
        data['agent'] = $('#patent_agent').val();
        data['agent_notice_date'] = $('#agent_notice_date').val();
        data['agent_submit_date'] = $('#agent_submit_date').val();

        data['is_authorization_notification'] = $('#is_authorization_notification').val()=='是'?1:0;
        data['authorization_notification_date'] = $('#authorization_notification_date').val();
        data['is_authorization_announcement'] = $('#is_authorization_announcement').val()=='是'?1:0;
        data['authorization_announcement_date'] = $('#authorization_announcement_date').val();
        data['is_has_certificate'] = $('#is_has_certificate').val()=='是'?1:0;
        data['certificate_date'] = $('#certificate_date').val();
        data['initiator_user'] = current_user_name;

        patentData['data'] = data;

        console.log(patentData);
        $.ajax({
            type: "POST",
            url: "add_patent_server.php",//请求的后台地址
            dataType: 'JSON',
            data: patentData,//前台传给后台的参数
            success: function (msg) {//msg:返回值
                var jsonObj = msg;

                if (jsonObj['result'] != 'success') {
                    noticeError(jsonObj['info']);
                    return;
                }

                console.debug(msg);

                //$("#myModal").modal();


                alert("更新专利信息成功");
                window.close();
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
            <h3>填写专利信息</h3>
        </div>
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <div class="row col-md-12">
                <div class="form-horizontal" role="form">
                    <fieldset>
                        <legend>申请信息</legend>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">方案号</label>
                            <div class="col-sm-3">
                                <input class="form-control" name="project_code"  id="project_code" type="text" readonly="readonly"
                                       placeholder="当前使用的最后一个方案号是:RMI15001" value="<?php echo $patentData['project_code'];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">事务所案号</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" name="office_code" id="office_code" placeholder="" value="<?php echo $patentData['office_code'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">专利名称</label>
                            <div class="col-sm-5">
                                <input class="form-control" type="text" name="name" id="patent_name" placeholder=""  value="<?php echo $patentData['name'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">国家</label>

                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="country" id="country"  placeholder="" value="<?php echo $patentData['country'];?>"/>
                            </div>
                            <label class="col-sm-1 control-label">类别</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="type" id="patent_type" type="text" placeholder="">
                                    <option <?php if($patentData['type'] === '未分类') echo 'selected="selected"';?>>未分类</option>
                                    <option <?php if($patentData['type'] === '发明') echo 'selected="selected"';?>>发明</option>
                                    <option <?php if($patentData['type'] === '实用新型') echo 'selected="selected"';?>>实用新型</option>
                                    <option <?php if($patentData['type'] === '外观设计') echo 'selected="selected"';?>>外观设计</option>
                                    <option <?php if($patentData['type'] === 'PCT') echo 'selected="selected"';?>>PCT</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">专利申请日</label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="submit_date" id="submit_date" type="date" placeholder="" value="<?php echo $patentData['submit_date'];?>"/>
                            </div>
                            <label class="col-sm-1 control-label">申请号</label>
                            <div class="col-sm-2">
                                <input class="form-control" name="patent_code" id="patent_code" type="text" placeholder="" value="<?php echo $patentData['patent_code'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">法律状态</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="law_status" id="law_status">
                                    <option <?php if($patentData['law_status'] === '未公开') echo 'selected="selected"';?>>未公开</option>
                                    <option <?php if($patentData['law_status'] === '已公开') echo 'selected="selected"';?>>已公开</option>
                                    <option <?php if($patentData['law_status'] === '进入实审') echo 'selected="selected"';?>>进入实审</option>
                                    <option <?php if($patentData['law_status'] === 'OA答复') echo 'selected="selected"';?>>OA答复</option>
                                    <option <?php if($patentData['law_status'] === '授权') echo 'selected="selected"';?>>授权</option>
                                    <option <?php if($patentData['law_status'] === '驳回') echo 'selected="selected"';?>>驳回</option>
                                    <option <?php if($patentData['law_status'] === '视撤') echo 'selected="selected"';?>>视撤</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">优先权日</label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="priority_date" id="priority_date" type="date" placeholder="" value="<?php echo $patentData['priority_date'];?>"/>
                            </div>
                            <label class="col-sm-1 control-label">优先权申请号</label>
                            <div class="col-sm-2">
                                <input class="form-control" name="priority_code" id="priority_code" type="text" placeholder="" value="<?php echo $patentData['priority_code'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >申请人</label>
                            <div class="col-sm-2">
                                <input class="form-control" name="submit_user" id="submit_user" type="text" placeholder="" value="<?php echo $patentData['submit_user'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >发明人</label>
                            <div class="col-sm-5">
                                <input class="form-control" name="invertor_user" id="invertor_user" type="text" placeholder="" value="<?php echo $patentData['invertor_user'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">事务所</label>
                            <div class="col-sm-5">
                                <input class="form-control" name="office_name" id="office_name" type="text" placeholder="" value="<?php echo $patentData['office_name'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">一级分类</label>
                            <div class="col-sm-2">
                                <input class="form-control"  type="text" placeholder="" list="level_list1" id="level_list1_input" value="<?php echo $patentData['level1'];?>"/>
                                <datalist class="form-control" id="level_list1" name="level1" style="display:none;">
                                    <option>机械</option>
                                    <option>电气</option>
                                    <option>软件</option>
                                    <option>生物</option>
                                </datalist>
                            </div>
                            <label class="col-sm-1 control-label" for="ds_password">二级分类</label>
                            <div class="col-sm-2">
                                <input class="form-control"  type="text" placeholder="" list="level_list2"  id="level_list2_input" value="<?php echo $patentData['level2'];?>"/>
                                <datalist class="form-control" id="level_list2" name="level2" style="display:none;">
                                    <option>打印机</option>
                                    <option>制备仪</option>
                                    <option>生物砖</option>
                                </datalist>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >三级分类</label>
                            <div class="col-sm-2">
                                <input class="form-control" name="level3"  id="level_list3_input" type="text" placeholder="" value="<?php echo $patentData['level3'];?>"/>
                            </div>
                            <label class="col-sm-1 control-label">四级分类</label>
                            <div class="col-sm-2">
                                <input class="form-control" name="level4"  id="level_list4_input" type="text" placeholder="" value="<?php echo $patentData['level4'];?>"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>提前公开</legend>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否提前公开</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="is_early_public" id="is_early_public">
                                    <option <?php if($patentData['is_early_public'] === '1') echo 'selected="selected"';?>>是</option>
                                    <option <?php if($patentData['is_early_public'] === '0') echo 'selected="selected"';?>>否</option>
                                </select>
                            </div>
                            <label class="col-sm-1 control-label">提前公开提出日</label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="submit_early_public_date" id="submit_early_public_date"  type="date" placeholder="" value="<?php echo $patentData['submit_early_public_date'];?>"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>实审请求</legend>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否提出实审</label>
                            <div class="col-sm-2" >
                                <select class="form-control" name="is_actual_audit" id="is_actual_audit">
                                    <option <?php if($patentData['is_actual_audit'] === '1') echo 'selected="selected"';?>>是</option>
                                    <option <?php if($patentData['is_actual_audit'] === '0') echo 'selected="selected"';?>>否</option>
                                </select>
                            </div>
                            <label class="col-sm-1 control-label">提前实审日</label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="submit_actual_audit_date" id="submit_actual_audit_date" type="date" placeholder="" value="<?php echo $patentData['submit_actual_audit_date'];?>"/>
                            </div>
                            <label class="col-sm-1 control-label" >提前实审提醒日</label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="actual_audit_notice_date" id="actual_audit_notice_date" type="date" placeholder="" value="<?php echo $patentData['actual_audit_notice_date'];?>"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>中间文件</legend>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >通知书类型</label>
                            <div class="col-sm-2">
                                <input class="form-control" name="notification_type" id="notification_type" type="text" placeholder="" value="<?php echo $patentData['notification_type'];?>"/>
                            </div>
                            <label class="col-sm-1 control-label" >答复期限</label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="agent_answer_date" id="agent_answer_date"  type="date" placeholder="" value="<?php echo $patentData['agent_answer_date'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >代理人</label>
                            <div class="col-sm-2">
                                <input class="form-control" name="agent" type="text" id="patent_agent" placeholder="" value="<?php echo $patentData['agent'];?>"/>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">提交日期</label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="agent_submit_date" id="agent_submit_date" type="date" placeholder="" value="<?php echo $patentData['agent_submit_date'];?>"/>
                            </div>
                            <label class="col-sm-1 control-label">提醒日期</label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="agent_notice_date" id="agent_notice_date" type="date" placeholder="" value="<?php echo $patentData['agent_notice_date'];?>"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>授权通知书</legend>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否发授权通知书</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="is_authorization_notification" id="is_authorization_notification">
                                    <option <?php if($patentData['is_authorization_notification'] === '1') echo 'selected="selected"';?>>是</option>
                                    <option <?php if($patentData['is_authorization_notification'] === '0') echo 'selected="selected"';?>>否</option>
                                </select>
                            </div>
                            <label class="col-sm-1 control-label">发文日期</label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="authorization_notification_date" id="authorization_notification_date" type="date" placeholder="" value="<?php echo $patentData['authorization_notification_date'];?>"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>授权公告</legend>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否授权公告</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="is_authorization_announcement" id="is_authorization_announcement">
                                    <option <?php if($patentData['is_authorization_announcement'] === '1') echo 'selected="selected"';?>>是</option>
                                    <option <?php if($patentData['is_authorization_announcement'] === '0') echo 'selected="selected"';?>>否</option>
                                </select>
                            </div>
                            <label class="col-sm-1 control-label" >授权公告日期</label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="authorization_announcement_date" id="authorization_announcement_date" type="date" placeholder="" value="<?php echo $patentData['authorization_announcement_date'];?>"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>专利证书</legend>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否有证书</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="is_has_certificate" id="is_has_certificate">
                                    <option <?php if($patentData['is_has_certificate'] === '1') echo 'selected="selected"';?>>是</option>
                                    <option <?php if($patentData['is_has_certificate'] === '0') echo 'selected="selected"';?>>否</option>
                                </select>
                            </div>
                            <label class="col-sm-1 control-label">纸质证书收到日</label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="certificate_date" id="certificate_date" type="date" placeholder="" value="<?php echo $patentData['certificate_date'];?>"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="row">
                            <span class="form-group col-md-12"></span>
                            <span class="form-group col-md-12"></span>
                        </div>
                        <div class="form-group-lg col-md-12 ">
                            <span class="col-md-4"></span>
                            <button class="btn btn-primary col-md-2" onclick="submitPatent()" type="submit">
                                更新专利信息
                            </button>
                            <span class="col-md-4"></span>
                        </div>
                    </fieldset>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>

