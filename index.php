<?php
  ob_start();
  require_once('includes/load.php');
  if ($session->isUserLoggedIn(true)) { redirect('index.php', false); }
?>
<?php include_once('layouts/header.php'); ?>

<style>
    body {
        background-color: #DDDDDD;
        display: center;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    
    .login-page {
        width: 490px;
        margin: 1 auto;
    }
</style>

<div class="login-page">
    <div class="text-center">
        
        <h3><span class="fa fa-cubes"></span> Tile Inventory Management System</h3>
    <hr></div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
            <label for="username" class="control-label">Username</label>
            <input type="name" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" style="border-radius:0%"><span class="fa fa-sign-in"></span> Login</button>
        </div>
        </div>
    </form>
</div>

