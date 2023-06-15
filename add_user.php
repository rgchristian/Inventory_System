<?php
  $page_title = 'Add User';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $groups = find_all('user_groups');
?>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<?php
  if(isset($_POST['add_user'])){

   $req_fields = array('full-name','username','password','level' );
   validate_fields($req_fields);

   if(empty($errors)){
           $name   = remove_junk($db->escape($_POST['full-name']));
       $username   = remove_junk($db->escape($_POST['username']));
       $password   = remove_junk($db->escape($_POST['password']));
       $user_level = (int)$db->escape($_POST['level']);
       $password = sha1($password);
        $query = "INSERT INTO users (";
        $query .="name,username,password,user_level,status";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$username}', '{$password}', '{$user_level}','1'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg("s", 'User added successfully.');
          redirect('users.php', false);
        } else {
          //failed
          $session->msg("d", "Failed to add user.");
          redirect('add_user.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_user.php',false);
   }
 }
?>

<?php include_once('layouts/header.php'); ?>


  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>

   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-info">
        <div class="panel-heading clearfix">
          <strong>
            
            <span >Add New User</span>
          </strong>
          <div class="pull-right">
          <a href="users.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
        </div>
      </div>

        <div class="panel-body">
          <form method="post" action="add_user.php">

          <div class="form-group">
    <label style="color: #7f7f7f;" for="name">Name</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-pencil-alt" style="color: #666666;"></i></span>
        <input type="text" class="form-control" name="full-name" data-toggle="tooltip" data-placement="bottom" title="Input user's full name" placeholder="Full Name">
    </div>
</div>

<div class="form-group">
    <label style="color: #7f7f7f;" for="username">Username</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-user" style="color: #666666;"></i></span>
        <input type="text" class="form-control" name="username" data-toggle="tooltip" data-placement="bottom" title="Input user's username" placeholder="Username">
    </div>
</div>

<div class="form-group">
    <label style="color: #7f7f7f;" for="password">Password</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-lock" style="color: #666666;"></i></span>
        <input type="password" class="form-control" name="password" data-toggle="tooltip" data-placement="bottom" title="Input user's password" placeholder="Password">
    </div>
</div>

<div class="form-group">
    <label style="color: #7f7f7f;" for="level">User Role</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-user-check" style="color: #666666;"></i></span>
        <select class="form-control" data-toggle="tooltip" data-placement="bottom" title="Select the user's access level" name="level">
            <?php foreach ($groups as $group ):?>
                <option value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
            <?php endforeach;?>
        </select>
    </div>
</div>

            
            <div class="form-group">
              <button type="submit" name="add_user" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Done"><span class="fas fa-check"></span> Done</button>
            </div>
        </form>
        </div>
        </div>
      
      
   
  

<?php include_once('layouts/footer.php'); ?>


