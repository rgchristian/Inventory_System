<?php $user = current_user(); ?>
<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "Login";?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
  </head>
  <body>

  <?php  if ($session->isUserLoggedIn(true)): ?>
    
    <header id="header" style="background-color: #FFFFFF;">
      <div class="logo pull-left" style="background-color: #58748c;"><i class="fas fa-stream">&nbsp;</i> Inventory System</div>
      <div class="header-content">
      <div class="header-date pull-left">
        
      <?php
        date_default_timezone_set('Asia/Manila');
        $dateTime = date ('D, F j, Y - g:ia');
      ?>

        <strong style="color: #7f7f7f;">
         <?php echo $dateTime; ?>
        </strong>
      </div>
      
      <div class="pull-right clearfix">
  
  <ul class="info-menu list-inline list-unstyled" style="margin-left: 10px;">
  <!-- <a href="admin.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Admin Dashboard"><span class="fas fa-tachometer-alt"></span></a> -->
  <!-- <a href="users.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="User Management"><span class="glyphicon glyphicon-user"></span></a> -->
  <!-- <a href="employee.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Employee Dashboard"><span class="fa fa-tasks"></span></a> -->
  <!-- <a href="group.php"  data-toggle="tooltip" data-placement="bottom" title="Role Management"><span class="fas fa-key"></span></a> -->
  <!-- <a href="product.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Inventory"><span class="fab fa-delicious"></span></a> -->
  <!-- <a href="sales.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Sales History"><span class="fab fa-wpforms"></span></a> -->
  <!-- <a href="stock_card.php" class="btn custom-primary-btn btn-sm"><span class="far fa-file-alt"></span></a> -->
  
    <li class="dropdown profile">
      <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
        <img src="uploads/users/<?php echo $user['image']; ?>" alt="user-image" class="img-circle img-inline">
        <span style="color: #7f7f7f;"><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret" style="color: #7f7f7f"></i></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
        <li>
          <a style="color: #7f7f7f" href="profile.php?id=<?php echo (int)$user['id']; ?>">
            <i class="fas fa-user-circle" style="color: #567189;"></i>&nbsp; Profile
          </a>
        </li>
        <li>
          <a style="color: #7f7f7f" href="edit_account.php" title="edit account">
            <i class="fas fa-cog" style="color: #567189;"></i>&nbsp; Settings
          </a>
        </li>
        <li>
          <a style="color: #7f7f7f" href="group.php">
            <i class="fas fa-key" style="color: #567189;"></i>&nbsp; Roles
          </a>
        </li>
        <li>
          <a style="color: #7f7f7f" href="about.php">
            <i class="fas fa-question-circle" style="color: #567189;"></i>&nbsp; About
          </a>
        </li>
        <li class="last">
          <a style="color: #7f7f7f" href="logout.php">
            <i class="fas fa-sign-out-alt" style="color: #567189;"></i>&nbsp; Logout
          </a>
        </li>
      </ul>
    </li>
  </ul>
</div>

    </header>
    <div class="sidebar">
      <?php if($user['user_level'] === '1'): ?>
        <!-- admin menu -->
      <?php include_once('admin_menu.php');?>

      <?php elseif($user['user_level'] === '2'): ?>
        <!-- Special user -->
      <?php include_once('special_menu.php');?>

      <?php elseif($user['user_level'] === '3'): ?>
        <!-- User menu -->
      <?php include_once('user_menu.php');?>

      <?php endif;?>

   </div>
<?php endif;?>

<style>
  body {
    background-color: #DDDDDD;
    }

  .custom-primary-btn {
    background-color: #567189;
    color: white;
    
  }
  .custom-primary-btn:hover {
    background-color: white;
    border-color: black;
  }
  .form-control[readonly] {
    background-color: #ffffff; /* Set your desired background color for readonly state */
    color: ; /* Set your desired text color for readonly state */
  }
</style>


<div class="page">
  <div class="container-fluid">
