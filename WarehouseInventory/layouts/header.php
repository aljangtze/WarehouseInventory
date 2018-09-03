<?php $user = current_user(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <title><?php if (!empty($page_title))
            echo remove_junk($page_title);
        elseif (!empty($user))
            echo ucfirst($user['name']);
        else echo "Revotek inventory System"; ?>
    </title>

    <link rel="stylesheet" href="libs/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="libs/css/datepicker3.min.css"/>
    <link rel="stylesheet" href="libs/css//bootstrap-table.min.css"/>
    <link rel="stylesheet" href="libs/css/main.css"/>
    <link rel="stylesheet" href="libs/css/bootstrap-editable.css"/>

</head>
<body>
<script type="text/javascript" src="libs/js/jquery.min.js"></script>
<script src="libs/js/bootstrap.min.js"></script>
<script src="libs/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="libs/js/bootstrap-table.js"></script>
<script type="text/javascript" src="libs/js/bootstrap-table-editable.js"></script>
<script type="text/javascript" src="libs/js/bootstrap-table-zh-CN.min.js"></script>
<script type="text/javascript" src="libs/js/bootstrap-editable.js"></script>
<script type="text/javascript" src="libs/js/bootstrap-table-multiple-sort.js"></script>
<script src="http://open.sojson.com/common/html5/html5shiv.js"></script>
<script src="http://open.sojson.com/common/html5/respond.min.js"></script>

<script src="libs/js/spin.min.js"></script>
<script src="libs/js/vue.min.js"></script>

<script type="text/javascript" src="libs/js/jszip.js"></script>
<script type="text/javascript" src="libs/js/xlsx.full.min.js"></script>
<script type="text/javascript" src="libs/js/functions.js"></script>
<?php if ($session->isUserLoggedIn(true)): ?>
    <header id="header">
        <div class="logo pull-left"> REVOTEK - Inventory</div>
        <div class="header-content">
            <div class="header-date pull-left">
                <strong><?php echo date("Y年m月j日, g:i a"); ?></strong>
            </div>
            <div class="pull-right clearfix">
                <ul class="info-menu list-inline list-unstyled">
                    <li class="profile">
                        <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                            <img src="uploads/users/<?php echo $user['image']; ?>" alt="user-image"
                                 class="img-circle img-inline">
                            <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="edit_account.php" title="edit account">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    设置
                                </a>
                            </li>
                            <li class="last">
                                <a href="logout.php">
                                    <i class="glyphicon glyphicon-off"></i>
                                    注销
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="sidebar">
        <?php if ($user['user_level'] === '1'): ?>
            <!-- admin menu -->
            <?php include_once('admin_menu.php'); ?>

        <?php elseif ($user['user_level'] === '2'): ?>
            <!-- Special user -->
            <?php include_once('special_menu.php'); ?>

        <?php elseif ($user['user_level'] === '3'): ?>
            <!-- User menu -->
            <?php include_once('user_menu.php'); ?>

        <?php endif; ?>

    </div>
<?php endif; ?>
<script>
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

    function hideModal() {
        $('#myModal').modal('hide');
    }

    function showModal() {
        $('#myModal').modal({backdrop: 'static', keyboard: false});
    }

    function isEmpty(a) {
        if (a == "" || a == null || a == undefined) {
            return true;
        }
        else {
            return false;
        }
    }

    var current_user_name = '<?php echo ucfirst($user['name']);?>';
</script>
<div class="page">
    <div class="container-fluid">
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-sm">
                <img alt=""
                     src="data:image/gif;base64,R0lGODlhGQAZAJECAK7PTQBjpv///wAAACH/C05FVFNDQVBFMi4wAwEAAAAh/wtYTVAgRGF0YVhNUDw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo5OTYyNTQ4Ni02ZGVkLTI2NDUtODEwMy1kN2M4ODE4OWMxMTQiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RUNGNUFGRUFGREFCMTFFM0FCNzVDRjQ1QzI4QjFBNjgiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RUNGNUFGRTlGREFCMTFFM0FCNzVDRjQ1QzI4QjFBNjgiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjk5NjI1NDg2LTZkZWQtMjY0NS04MTAzLWQ3Yzg4MTg5YzExNCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5OTYyNTQ4Ni02ZGVkLTI2NDUtODEwMy1kN2M4ODE4OWMxMTQiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4B//79/Pv6+fj39vX08/Lx8O/u7ezr6uno5+bl5OPi4eDf3t3c29rZ2NfW1dTT0tHQz87NzMvKycjHxsXEw8LBwL++vby7urm4t7a1tLOysbCvrq2sq6qpqKempaSjoqGgn56dnJuamZiXlpWUk5KRkI+OjYyLiomIh4aFhIOCgYB/fn18e3p5eHd2dXRzcnFwb25tbGtqaWhnZmVkY2JhYF9eXVxbWllYV1ZVVFNSUVBPTk1MS0pJSEdGRURDQkFAPz49PDs6OTg3NjU0MzIxMC8uLSwrKikoJyYlJCMiISAfHh0cGxoZGBcWFRQTEhEQDw4NDAsKCQgHBgUEAwIBAAAh+QQFCgACACwAAAAAGQAZAAACTpSPqcu9AKMUodqLpAb0+rxFnWeBIUdixwmNqRm6JLzJ38raqsGiaUXT6EqO4uIHRAYQyiHw0GxCkc7l9FdlUqWGKPX64mbFXqzxjDYWAAAh+QQFCgACACwCAAIAFQAKAAACHYyPAsuNH1SbME1ajbwra854Edh5GyeeV0oCLFkAACH5BAUKAAIALA0AAgAKABUAAAIUjI+py+0PYxO0WoCz3rz7D4bi+BUAIfkEBQoAAgAsAgANABUACgAAAh2EjxLLjQ9UmzBNWo28K2vOeBHYeRsnnldKBixZAAA7"/>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
