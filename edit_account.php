<?php
  $page_title = 'Edit Account';
  require_once('includes/load.php');
   page_require_level(3);
?>
<?php
//update user image
  if(isset($_POST['submit'])) {
  $photo = new Media();
  $user_id = (int)$_POST['user_id'];
  $photo->upload($_FILES['file_upload']);
  if($photo->process_user($user_id)){
    $session->msg('s','Profile Picture changed successfully.');
    redirect('edit_account.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('edit_account.php');
    }
  }
?>

<?php
 //update user other info
  if(isset($_POST['update'])){
    $req_fields = array('name','username' );
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$_SESSION['user_id'];
           $name = remove_junk($db->escape($_POST['name']));
       $username = remove_junk($db->escape($_POST['username']));
            $sql = "UPDATE users SET name ='{$name}', username ='{$username}' WHERE id='{$id}'";
    $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s', "Account updated successfully.");
            redirect('edit_account.php', false);
          } else {
            $session->msg('d', 'Failed to update account.');
            redirect('edit_account.php', false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_account.php',false);
    }
  }
?>

<?php include_once('layouts/header.php'); ?>

<style>
  body {
    background-color: #DDDDDD;
    }
</style>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"">
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-6">
      <div class="panel panel-info">
        
          <div class="panel-heading clearfix">
            
            <strong>
              <span >Edit Profile Picture</span>
            </strong>
          </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
                <img class="img-circle img-size-2" src="uploads/users/<?php echo $user['image'];?>" alt="">
            </div>
            <div class="col-md-8">
              <form class="form" action="edit_account.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
              <label for="file_upload" class="btn btn-default btn-file btn-block" data-toggle="tooltip" data-placement="bottom" title="Select profile picture" style="color: #666666;">
                  <i class="fas fa-upload"></i> Upload Picture
                    <input type="file" name="file_upload" id="file_upload" multiple="multiple" style="display: none;">
              </label>
              </div>
              <div class="form-group">
                <input type="hidden" name="user_id" value="<?php echo $user['id'];?>">
                 <button type="submit" name="submit" class="btn custom-primary-btn btn-block" data-toggle="tooltip" data-placement="bottom" title="Save changes"><span class="fas fa-check"></span> Save Changes</button>
              </div>
             </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-info">
      <div class="panel-heading clearfix">
        
        <strong>
          <span >Edit Display Information</span>
        </strong>
      </div>
      <div class="panel-body">
          <form method="post" action="edit_account.php?id=<?php echo (int)$user['id'];?>" class="clearfix">
          <div class="form-group">
  <label style="color: #7f7f7f;" for="name" class="control-label">Name</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-pencil-alt" style="color: #666666;"></i>
    </span>
    <input type="name" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Edit your full name" name="name" value="<?php echo remove_junk(ucwords($user['name'])); ?>">
  </div>
</div>
<div class="form-group">
  <label style="color: #7f7f7f" for="username" class="control-label">Username</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-user" style="color: #666666;"></i>
    </span>
    <input type="text" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Edit your username" name="username" value="<?php echo remove_junk(ucwords($user['username'])); ?>">
  </div>
</div>
            <div class="form-group">
                    <a href="change_password.php" data-toggle="tooltip" data-placement="bottom" title="Change password" class="btn custom-primary-btn btn-sm"><span class="fas fa-lock"></span> Change Password</a>
                    <button type="submit" name="update" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Save changes"><span class="fas fa-check"></span> Save Changes</button>
            </div>
        </form>
      </div>
      
    
  


<?php include_once('layouts/footer.php'); ?>
