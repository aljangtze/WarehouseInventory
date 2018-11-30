<?php require_once('includes/load.php'); ?>

<?php
$page_title = '专利详情';
page_require_level("60000");

function get_patent_details()
{
    global $db;
    $sql = "select * from patent";

    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    $jarr = array();
    foreach ($result_set as $result) {
        $count = count($result);//不能在循环语句中，由于每次删除 row数组长度都减小
        for ($i = 0; $i < $count; $i++) {
            unset($result[$i]);//删除冗余数据
        }
        array_push($jarr, $result);
    }

    /*
    $result_array = array();
    foreach ($jarr as $data)
    {
        $y = $data;
        $cur_arr = array();
        foreach($data as $datax)
        {
            array_push($cur_arr, $datax);
        }

        array_push($result_array, $cur_arr);
    }
    //$x = json_encode($result_array);

    //$x = var_dump($result_array);
    */

    //$result_info = array("data" => $jarr);

    return $jarr;
}

//$product_types = find_all('product_type');

//$units = find_all('units');
?>

<?php include_once('layouts/header.php'); ?>

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


    var ds = '<?php $user_id = $_SESSION['user_id']; $requestion_infos = get_patent_details(); echo str_replace('"', '"', json_encode($requestion_infos)); ?>';
    console.log('stop');
    //console.log(ds);

    var requestion_data = JSON.parse(ds);

    console.log(requestion_data);

    //详细信息
    //var g_reqeustionData = {};
    //g_reqeustionData['items'] = {};

    function deletePatent(id) {
        //var id = row.id;
        var data = {};
        data['operate_type'] = 'del';
        var item = {};
        item['id'] = id;
        data['data'] = item;

        $.ajax({
            type: "POST",
            url: "manage_patent_server.php",//请求的后台地址
            data: data,
            success: function (msg) {//msg:返回值
                var jsonObj = JSON.parse(msg);
                var result = jsonObj.result;


                if (result != 'success') {
                    noticeError("删除物料信息失败！");
                    return;
                }

                for(var i=0;i<requestion_data.length;i++)
                {
                    var rowData = requestion_data[i];
                    if(rowData['id'] == id)
                    {
                        requestion_data.splice(i, 1);

                        console.log(requestion_data);
                        var table =$('#example').DataTable();
                        table.data = requestion_data;

                        break;
                    }
                }

                alert('删除专利信息成功');
                location.reload();


            },
            error: function (request) {
                alert('error');
            }
        });

        return;

    }

    function  updatePatent(id) {

        window.open("update_patent.php?id="+id);
    }

</script>

<div class="row">
    <div class="col-md-12" id="head_msg_info">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div>
            <div class="panel-body">
                <div id="toolbar1">
                    <strong>
                        <span class="glyphicon glyphicon-pencil"></span>
                        <span>专利信息列表</span>
                    </strong>
                </div>
                <table id="example" class="display">
                    <thead>
                    <tr>
                        <th class="text-center" >#</th>
                        <th class="text-center" data-field="id" style="width:50px;">操作</th>
                        <th class="text-center" data-field="project_code" style="width:100px;">我方案号</th>
                        <th class="text-center" data-field="office_code" style="width:100px;">事务所案号</th>
                        <th class="text-center" data-field="name" style="width:100px;">专利名称</th>
                        <th class="text-center" data-field="type" style="width:60px;">类别</th>
                        <th class="text-center" data-field="country" style="width:60px;">国家</th>
                        <th class="text-center" data-field="patent_code" style="width:100px;">申请号/专利号</th>
                        <th class="text-center" data-field="submit_date" style="width:100px;">专利申请日</th>
                        <th class="text-center" data-field="law_status" style="width:100px;">法律状态</th>
                        <th class="text-center" data-field="is_early_public" style="width:100px;">是否提前公开</th>
                        <th class="text-center" data-field="submit_early_public_date" style="width:100px;">提前公开日期</th>
                        <th class="text-center" data-field="is_actual_audit" style="width:100px;">是否提出实审</th>
                        <th class="text-center" data-field="submit_actual_audit_date" style="width:100px;">提前实审日</th>
                        <th class="text-center" data-field="actual_audit_notice_date" style="width:100px;">提前实审日提醒</th>
                        <th class="text-center" data-field="priority_date" style="width:60px;">优先权日</th>
                        <th class="text-center" data-field="priority_code" style="width:90px;">优先权申请号</th>
                        <th class="text-center" data-field="submit_user" style="width:60px;">申请人</th>
                        <th class="text-center" data-field="invertor_user" style="width:60px;">发明人</th>
                        <th class="text-center" data-field="office_name" style="width:70px;">事务所名称</th>
                        <th class="text-center" data-field="level1" style="width:60px;">一级分类</th>
                        <th class="text-center" data-field="level2" style="width:60px;">二级分类</th>
                        <th class="text-center" data-field="level3" style="width:60px;">三级分类</th>
                        <th class="text-center" data-field="level4" style="width:60px;">四级分类</th>
                        <th class="text-center" data-field="notfication_type" style="width:100px;">通知书类型</th>
                        <th class="text-center" data-field="agent_answer_date" style="width:100px;">答复期限</th>
                        <th class="text-center" data-field="agent" style="width:100px;">代理人</th>
                        <th class="text-center" data-field="agent_notice_date" style="width:100px;">代理提醒日</th>
                        <th class="text-center" data-field="agent_submit_date" style="width:100px;">代理提交日期</th>
                        <th class="text-center" data-field="is_authorization_notification" style="width:120px;">
                            是否发授权通知书
                        </th>
                        <th class="text-center" data-field="authorization_notification_date" style="width:130px;">
                            授权通知书发文日期
                        </th>
                        <th class="text-center" data-field="is_authorization_announcement" style="width:100px;">是否授权公告
                        </th>
                        <th class="text-center" data-field="authorization_announcement_date" style="width:100px;">
                            授权公告日期
                        </th>
                        <th class="text-center" data-field="is_has_certificate" style="width:70px;">是否有证书</th>
                        <th class="text-center" data-field="certificate_date" style="width:120px;">纸质证书收到日期</th>

                    </tr>
                    <tr>
                        <th class="text-center" >#</th>
                        <th class="text-center" data-field="id" style="width:50px;">操作</th>
                        <th class="text-center" data-field="project_code" style="width:100px;">我方案号</th>
                        <th class="text-center" data-field="office_code" style="width:100px;">事务所案号</th>
                        <th class="text-center" data-field="name" style="width:100px;">专利名称</th>
                        <th class="text-center" data-field="type" style="width:60px;">类别</th>
                        <th class="text-center" data-field="country" style="width:60px;">国家</th>
                        <th class="text-center" data-field="patent_code" style="width:100px;">申请号/专利号</th>
                        <th class="text-center" data-field="submit_date" style="width:100px;">专利申请日</th>
                        <th class="text-center" data-field="law_status" style="width:100px;">法律状态</th>
                        <th class="text-center" data-field="is_early_public" style="width:100px;">是否提前公开</th>
                        <th class="text-center" data-field="submit_early_public_date" style="width:100px;">提前公开日期</th>
                        <th class="text-center" data-field="is_actual_audit" style="width:100px;">是否提出实审</th>
                        <th class="text-center" data-field="submit_actual_audit_date" style="width:100px;">提前实审日</th>
                        <th class="text-center" data-field="actual_audit_notice_date" style="width:100px;">提前实审日提醒</th>
                        <th class="text-center" data-field="priority_date" style="width:60px;">优先权日</th>
                        <th class="text-center" data-field="priority_code" style="width:90px;">优先权申请号</th>
                        <th class="text-center" data-field="submit_user" style="width:60px;">申请人</th>
                        <th class="text-center" data-field="invertor_user" style="width:60px;">发明人</th>
                        <th class="text-center" data-field="office_name" style="width:70px;">事务所名称</th>
                        <th class="text-center" data-field="level1" style="width:60px;">一级分类</th>
                        <th class="text-center" data-field="level2" style="width:60px;">二级分类</th>
                        <th class="text-center" data-field="level3" style="width:60px;">三级分类</th>
                        <th class="text-center" data-field="level4" style="width:60px;">四级分类</th>
                        <th class="text-center" data-field="notfication_type" style="width:100px;">通知书类型</th>
                        <th class="text-center" data-field="agent_answer_date" style="width:100px;">答复期限</th>
                        <th class="text-center" data-field="agent" style="width:100px;">代理人</th>
                        <th class="text-center" data-field="agent_notice_date" style="width:100px;">代理提醒日</th>
                        <th class="text-center" data-field="agent_submit_date" style="width:100px;">代理提交日期</th>
                        <th class="text-center" data-field="is_authorization_notification" style="width:120px;">
                            是否发授权通知书
                        </th>
                        <th class="text-center" data-field="authorization_notification_date" style="width:130px;">
                            授权通知书发文日期
                        </th>
                        <th class="text-center" data-field="is_authorization_announcement" style="width:100px;">是否授权公告
                        </th>
                        <th class="text-center" data-field="authorization_announcement_date" style="width:100px;">
                            授权公告日期
                        </th>
                        <th class="text-center" data-field="is_has_certificate" style="width:70px;">是否有证书</th>
                        <th class="text-center" data-field="certificate_date" style="width:120px;">纸质证书收到日期</th>

                    </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th data-field="id" style="width:50px;"></th>
                        <th data-field="project_code">我方案号</th>
                        <th data-field="office_code" >事务所案号</th>
                        <th data-field="name" >专利名称</th>
                        <th data-field="type">类别</th>
                        <th data-field="country" >国家</th>
                        <th data-field="patent_code" >申请号/专利号</th>
                        <th data-field="submit_date" >专利申请日</th>
                        <th data-field="law_status">法律状态</th>
                        <th data-field="is_early_public" >是否提前公开</th>
                        <th data-field="submit_early_public_date">提前公开日期</th>
                        <th data-field="is_actual_audit">是否提出实审</th>
                        <th data-field="submit_actual_audit_date" style="width:100px;">提前实审日</th>
                        <th data-field="actual_audit_notice_date" style="width:100px;">提前实审日提醒</th>
                        <th data-field="priority_date" style="width:60px;">优先权日</th>
                        <th data-field="priority_code" style="width:90px;">优先权申请号</th>
                        <th data-field="submit_user" style="width:60px;">申请人</th>
                        <th data-field="invertor_user" style="width:60px;">发明人</th>
                        <th data-field="office_name" style="width:70px;">事务所名称</th>
                        <th data-field="level1" style="width:60px;">一级分类</th>
                        <th data-field="level2" style="width:60px;">二级分类</th>
                        <th data-field="level3" style="width:60px;">三级分类</th>
                        <th data-field="level4" style="width:60px;">四级分类</th>
                        <th data-field="notfication_type" style="width:100px;">通知书类型</th>
                        <th data-field="agent_answer_date" style="width:100px;">答复期限</th>
                        <th data-field="agent" style="width:100px;">代理人</th>
                        <th data-field="agent_notice_date" style="width:100px;">代理提醒日</th>
                        <th data-field="agent_submit_date" style="width:100px;">代理提交日期</th>
                        <th data-field="is_authorization_notification" style="width:120px;">是否发授权通知书</th>
                        <th data-field="authorization_notification_date" style="width:130px;">授权通知书发文日期</th>
                        <th data-field="is_authorization_announcement" style="width:100px;">是否授权公告</th>
                        <th data-field="authorization_announcement_date" style="width:100px;">授权公告日期</th>
                        <th data-field="is_has_certificate" style="width:70px;">是否有证书</th>
                        <th data-field="certificate_date" style="width:120px;">纸质证书收到日期</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
<script type="text/javascript">

    $(document).ready(function () {

        var id=0;
        $('#example thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            /*if(id==0 || id == 4 || id==5 || id == 9 || id == 11 || id==8 ||
                id==18 || id==19 || id==20 || id==21 || id==22 || id==23 || id==28 || id==30 || id==32 || id==34)*/
            if(id==0 || id== 1)
            {
                id=id+1;
                return "";
            }
            else
                id=id+1;

            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            //$(this).html('<select><option value="1">x</option><option value="1">x</option></select>');

            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        });

        var table = $('#example').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            dom: 'Bfrtip',
            lengthMenu: [
                [15, 25, 50, -1],
                ['15 rows', '25 rows', '50 rows', 'Show all']
            ],
            "order": [[2, 'asc']],
            buttons: [
                'excel',
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed four-column'
                },
                {
                    text: 'Show All Columns',
                    action: function (e, dt, node, config) {

                        var id=0;
                        $('#example thead th').each(function () {
                            var column = table.column(id);
                            if(column.visible() != true)
                                column.visible(true);

                            id=id+1;
                        });
                    }
                },
                'pageLength'
            ],
            "paging": true,
            "ordering": true,
            "info": true,
            "scrollY": true,
            "scrollX": true,
            "audtoWidth": false,
            select: true,
            data: requestion_data,
            fixedColumns:   {
                leftColumns: 0
            },
            columns: [{"data": "id"},
                {"data": "id"},
                {"data": "project_code"},
                {"data": "office_code"},
                {"data": "name"},
                {"data": "type"},
                {"data": "country"},
                {"data": "patent_code"},
                {"data": "submit_date"},
                {"data": "law_status"},
                {"data": "is_early_public"},
                {"data": "submit_early_public_date"},
                {"data": "is_actual_audit"},
                {"data": "submit_actual_audit_date"},
                {"data": "actual_audit_notice_date"},
                {"data": "priority_date"},
                {"data": "priority_code"},
                {"data": "submit_user"},
                {"data": "invertor_user"},
                {"data": "office_name"},
                {"data": "level1"},
                {"data": "level2"},
                {"data": "level3"},
                {"data": "level4"},
                {"data": "notification_type"},
                {"data": "agent_answer_date"},
                {"data": "agent"},
                {"data": "agent_notice_date"},
                {"data": "agent_submit_date"},
                {"data": "is_authorization_notification"},
                {"data": "authorization_notification_date"},
                {"data": "is_authorization_announcement"},
                {"data": "authorization_announcement_date"},
                {"data": "is_has_certificate"},
                {"data": "certificate_date"}
            ],
            columnDefs: [
                {
                    "searchable": false,
                    targets: 0,
                },
                {
                    width: "50px",
                    "render": function (data, type, row) {
                        var id = row.id;
                        return '<div class="btn-group" > \
                                <a style="height:20px;" onclick="updatePatent(' + id + ')" class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit">\
                                <i class="glyphicon glyphicon-edit"></i>\
                                </a>\
                                <a style="height:20px;" id="delrow" onclick="deletePatent(' + id  + ')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">\
                                <i class="glyphicon glyphicon-remove"></i>\
                                </a>\
                                </div>';
                        //
                    },
                    "searchable": false,
                    targets: 1,
                },
                {
                    width: "100px",
                    targets: 2
                },
                {
                    width: "100px",
                    targets: 3,

                },
                {
                    width: "100px",
                    targets: 4
                },
                {
                    width: "60px",
                    targets: 5,

                },
                {
                    width: "60px",
                    targets: 6
                },
                {
                    width: "100px",
                    targets: 7,

                },
                {
                    width: "100px",
                    targets: 8
                },
                {
                    width: "100px",
                    targets: 9,

                },
                {
                    width: "100px",
                    "render": function (data, type, row) {
                        if (data == 0) {
                            return '否';
                        }
                        else {
                            return '是';
                        }
                    },
                    targets: 10
                },
                {
                    width: "100px",
                    targets: 11,

                },
                {
                    width: "100px",
                    "render": function (data, type, row) {
                        if (data == 0) {
                            return '否';
                        }
                        else {
                            return '是';
                        }
                    },
                    targets: 12
                },
                {
                    width: "100px",
                    targets: 13,

                },
                {
                    width: "100px",
                    targets: 14
                },
                {
                    width: "60px",
                    targets: 15,

                },
                {
                    width: "90px",
                    targets: 16
                },
                {
                    width: "60px",
                    targets: 17
                },
                {
                    width: "60px",
                    targets: 18,

                },
                {
                    width: "70px",
                    targets: 19
                },
                {
                    width: "60px",
                    targets: 20,

                },
                {
                    width: "60px",
                    targets: 21
                },
                {
                    width: "60px",
                    targets: 22,

                },
                {
                    width: "60px",
                    targets: 23
                },
                {
                    width: "110px",
                    targets: 24
                },
                {
                    width: "100px",
                    targets: 25,

                },
                {
                    width: "100px",
                    targets: 26
                },
                {
                    width: "100px",
                    targets: 27,

                },
                {
                    width: "100px",
                    targets: 28
                },
                {
                    width: "120px",
                    "render": function (data, type, row) {
                        if (data == 0) {
                            return '否';
                        }
                        else {
                            return '是';
                        }
                    },
                    targets: 29,

                },
                {
                    width: "130px",
                    targets: 30
                },
                {
                    width: "100px",
                    "render": function (data, type, row) {
                        if (data == 0) {
                            return '否';
                        }
                        else {
                            return '是';
                        }
                    },
                    targets: 31
                },
                {
                    width: "100px",
                    targets: 32,
                },
                {
                    width: "70px",
                    "render": function (data, type, row) {
                        if (data == 0) {
                            return '否';
                        }
                        else {
                            return '是';
                        }
                    },
                    targets: 33,

                },
                {
                    width: "120px",
                    targets: 34
                }
            ],
            initComplete: function () {
                var columnId= 0;
                this.api().columns().every( function () {
                    if(columnId == 5 || columnId==6 || columnId == 9 || columnId == 10 || columnId==12 || columnId==19 || columnId==20 || columnId==21 || columnId==22 || columnId==23 || columnId==24 || columnId==29 || columnId==31 || columnId==33)
                    {
                        columnId=columnId+1;
                    }
                    else
                    {
                        columnId=columnId+1;
                        return;
                    }

                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {

                        if(d === '0')
                        {
                            console.log('d=',d);
                            d='否';
                        }
                        else if(d == 1)
                        {
                            d='是';
                        }
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        });

        // Apply the search
        table.columns().every(function () {
            var that = this;
            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });

        table.on('order.dt search.dt', function () {
            table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        $('#example tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
    });

    $('.example tbody').on( 'click', 'a#delrow', function () {
        alert("del success");
        table.row( $(this).parents('tr') ).remove().draw();
        alert("del success");
    });

    $(window).resize(function () {
        $('#example').bootstrapTable('resetView');
    });

    function rowIndex(value, row, index) {
        return index + 1;
    }



    //操作
    function formatter_operator(value, row, index) {
        var id = row.id;
        return '<div class="btn-group" > \
        <a style="height:20px;" onclick="updatePatent(' + id + ')" class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit">\
        <i class="glyphicon glyphicon-edit"></i>\
        </a>\
        <a style="height:20px;" onclick="deletePatent(' + id + ')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">\
        <i class="glyphicon glyphicon-remove"></i>\
        </a>\
        </div>';
    }

    function formatter_favorite(value, row, index) {
        var id = row.id;
        if (id > 10)
            return '<div class="btn-group" > \
            <a style="height:20px;" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">\
            <i class="glyphicon glyphicon-star"></i>\
            </a></div>';
        else
            return '<div class="btn-group" > \
                <a style="height:20px;"  class="btn btn-xs btn-info" data-toggle="tooltip" title="Remove">\
                <i class="glyphicon glyphicon-star-empty"></i>\
                </a></div>';
    }

    function formatter_charge(value, row, index) {
        if (value == 0) {
            return '否';
        }
        else {
            return '是';
        }
    }
</script>



