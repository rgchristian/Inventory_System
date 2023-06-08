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
          $session->msg('s',"Role successfully added.");
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
</style>

<div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            
            <span>Add New Role</span>
          </strong>
        </div>

        <div class="panel-body">
          <form method="post" action="add_group.php">
          <div class="form-group">
              <label for="name" class="control-label"> Role Name</label>
              <input type="name" class="form-control" name="group-name" placeholder="Role Name">
        </div>

        <div class="form-group">
              <label for="level" class="control-label"> Role Level</label>
              <input type="number" class="form-control" name="group-level" placeholder="Role Level">
        </div>

        <div class="form-group">
          <label for="status">Status</label>
            <select class="form-control" name="status">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
        </div>
        <div class="form-group clearfix">
                <button type="submit" name="add" class="btn btn-primary pull-right btn-sm"><span class="fa fa-check"></span> Done</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>

