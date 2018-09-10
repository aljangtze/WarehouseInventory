<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) 
  { redirect('admin.php', false);}
?>
<?php include_once('layouts/header.php'); ?>

<div class="login-page">
    <div class="text-center">
       <h1>欢迎</h1>
       <p>请登录后开始使用</p>
     </div>
     <?php 
     echo display_msg($msg); 
     ?>
      <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
              <label for="username" class="control-label">用户名</label>
              <input type="name" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">密码</label>
            <input type="password" name= "password" class="form-control" placeholder="password">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-info  pull-right">登录</button>
        </div>
    </form>
</div>
<?php include_once('layouts/footer.php'); ?>
