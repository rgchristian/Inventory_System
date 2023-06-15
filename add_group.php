<?php
  $page_title = 'Add Role';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  if(isset($_POST['add'])){

   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);

   if(find_by_groupName($_POST['group-name']) === false ){
     $session->msg('d','<b>Sorry!</b> Entered role name already exist.');
     redirect('add_group.php', false);
   }elseif(find_by_groupLevel($_POST['group-level']) === false) {
     $session->msg('d','<b>Sorry!</b> Entered role level already exist.');
     redirect('add_group.php', false);
   }
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['group-name']));
          $level = remove_junk($db->escape($_POST['group-level']));
         $status = remove_junk($db->escape($_POST['status']));

        $query  = "INSERT INTO user_groups (";
        $query .="group_name,group_level,group_status";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$level}','{$status}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s',"Role added successfully.");
          redirect('add_group.php', false);
        } else {
          //failed
          $session->msg('d', 'Failed to add role.');
          redirect('add_group.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_group.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

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
</style>

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
            
            <span >Add New Role</span>
          </strong>

          <div class="pull-right">
          <a href="group.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
        </div>
      </div>
        

        <div class="panel-body">
          <form method="post" action="add_group.php">
          <div class="form-group">
          <label style="color: #567189;" for="status">Role Name</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-pencil-alt" style="color: #567189;"></i>
    </span>
    <input type="text" class="form-control" name="group-name" data-toggle="tooltip" data-placement="bottom" title="Input new role name" placeholder="Role Name">
  </div>
</div>

<div class="form-group">
<label style="color: #567189;" for="status">Access Level</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-key" style="color: #567189;"></i>
    </span>
    <input type="number" class="form-control" name="group-level" data-toggle="tooltip" data-placement="bottom" title="Input access role level (must be 1-3)" placeholder="Role Level">
  </div>
</div>

<div class="form-group">
  <label style="color: #567189;" for="status">Status</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-toggle-on" style="color: #567189;"></i>
    </span>
  <select class="form-control" data-toggle="tooltip" data-placement="bottom" title="Activate/Deactivate role" name="status">
    <option value="1">Active</option>
    <option value="0">Inactive</option>
  </select>
</div>
</div>

        <div class="form-group">
        <button type="submit" name="add" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Done"><span class="fas fa-check"></span> Done</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>

