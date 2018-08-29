<?php $user = current_user(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title><?php if (!empty($page_title))
            echo remove_junk($page_title);
        elseif (!empty($user))
            echo ucfirst($user['name']);
        else echo "Revotek inventory System"; ?>
    </title>

    <link rel="stylesheet" href="libs/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="libs/css/datepicker3.min.css"/>
    <link rel="stylesheet" href="libs/css//bootstrap-table.min.css">
    <link rel="stylesheet" href="libs/css/main.css"
    <link rel="stylesheet" href="libs/css/bootstrap-editable.css"

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
                            <!--<li>
                  <a href="profile.php?id=<?php echo (int)$user['id']; ?>">
                      <i class="glyphicon glyphicon-user"></i>
                      Profile
                  </a>
              </li>-->
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

<div class="page">
    <div class="container-fluid">
