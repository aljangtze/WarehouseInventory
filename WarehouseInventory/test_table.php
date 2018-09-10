<?php
$page_title = '入库信息';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);

#$rule_result_list = page_rule_list($_SESSION['user_id']);

$exists = isExists($result, "0001");
if(false == $exists)
{
    redirect('index.php', false);
}
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12" id="head_msg_info">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row">
    <div class="panel panel-default">
        <table id="example" class="table table-striped table-bordered" >
            <thead>
            <tr>
                <th>序号</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<?php include_once('layouts/footer.php'); ?>

<script>
    var vm = new Vue({
        el: '#example',
        data:
            {
                first: "这是首页",
                pageLength:10
            }
    });

    $(document).ready(function () {
        var table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                pagingType: 'full',
                ajax: {
                    "url": "server_processing.php",
                    "type": "POST"
                },
                language: {
                    paginate: {
                        first: vm.$data.first,
                        previous: '上一页',
                        next: '下一页',
                        last: '尾页'
                    },
                    aria: {
                        paginate: {
                            first: 'First',
                            previous: 'Previous',
                            next: 'Next',
                            last: 'Last'
                        }
                    }
                },
                /*select: {
                    style: 'multi',
                },*/
                dom: 'Bfrtip',
                buttons: [
                    {extend: 'copy', attr: {id: 'allan'}}, 'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {
                        data: null, defaultContent: "", orderable: false, render: function (data, type, row) {
                            return '<input type="checkbox" style="width: 18px;height:18px;" id="row_' + name + '" >';
                        }
                    },
                    {data: null, checkbox: true},
                    {data: 'name2'},
                    {data: 'Position'},
                    {data: 'Office'},
                    {data: 'start'}
                ],

            });
        $('#example tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#button').click(function () {
            table.row('.selected').remove().draw(false);
        });

        /*
        t.on( 'draw', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();*/
    })
    ;
</script>
