<?php
  $page_title = 'Change Password';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php $user = current_user(); ?>
<?php
  if(isset($_POST['update'])){

    $req_fields = array('new-password','old-password','id' );
    validate_fields($req_fields);

    if(empty($errors)){

             if(sha1($_POST['old-password']) !== current_user()['password'] ){
               $session->msg('d', "Your old password not match");
               redirect('change_password.php',false);
             }

            $id = (int)$_POST['id'];
            $new = remove_junk($db->escape(sha1($_POST['new-password'])));
            $sql = "UPDATE users SET password ='{$new}' WHERE id='{$db->escape($id)}'";
            $result = $db->query($sql);
                if($result && $db->affected_rows() === 1):
                  $session->logout();
                  $session->msg('s', "Password changed successfully.");
                  redirect('index.php', false);
                else:
                  $session->msg('d', 'Failed to change password.');
                  redirect('change_password.php', false);
                endif;
    } else {
      $session->msg("d", $errors);
      redirect('change_password.php',false);
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
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-info">
        <div class="panel-heading clearfix">
          <strong>
            
            <span >Change Password</span>
          </strong>

          <div class="pull-right">
          <a href="edit_account.php" class="btn custom-primary-btn btn-sm pull-right" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
        </div>
        </div>

        <div class="panel-body">
          <form method="post" action="change_password.php">
          <div class="form-group">
  <label style="color: #7f7f7f;" for="newPassword" class="control-label">Input New password</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-lock" style="color: #666666;"></i>
    </span>
    <input type="password" data-toggle="tooltip" data-placement="bottom" title="Input new password" class="form-control" name="new-password" placeholder="New password">
  </div>
</div>

<div class="form-group">
  <label style="color: #7f7f7f;" for="oldPassword" class="control-label">Input Old password</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-lock-open" style="color: #666666;"></i>
    </span>
    <input type="password" data-toggle="tooltip" data-placement="bottom" title="Input old password" class="form-control" name="old-password" placeholder="Old password">
  </div>
</div>

        <div class="form-group">
               <input type="hidden" name="id" value="<?php echo (int)$user['id'];?>">
                <button type="submit" name="update" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Save changes"><span class="fas fa-check"></span> Save Changes</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>





            
