<?php
  $page_title = 'Edit categorie';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  //Display all catgories.
  $categorie = find_by_id('categories',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Missing categorie id.");
    redirect('categorie.php');
  }
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('categorie-name');
  validate_fields($req_field);
  $cat_name = remove_junk($db->escape($_POST['categorie-name']));
  if(empty($errors)){
        $sql = "UPDATE categories SET name='{$cat_name}'";
       $sql .= " WHERE id='{$categorie['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Category updated successfully.");
       redirect('categorie.php',false);
     } else {
       $session->msg("d", "Failed to update category.");
       redirect('categorie.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('categorie.php',false);
  }
}
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-4">
     <div class="panel panel-info">
       <div class="panel-heading clearfix">
         <strong>
           
           <span >Edit Tile Type</span>
        </strong>
        <div class="pull-right">
          <a href="categorie.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
        </div>
      </div>


       <div class="panel-body">
         <form method="post" action="edit_categorie.php?id=<?php echo (int)$categorie['id'];?>">
         <div class="form-group">
         <label style="color: #7f7f7f;">Tile Type</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-pencil-alt" style="color: #666666;"></i>
    </span>
    <input type="text" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Edit tile type name" name="categorie-name" value="<?php echo remove_junk(ucfirst($categorie['name']));?>">
  </div>
</div>

           <button type="submit" name="edit_cat" class="btn custom-primary-btn btn-sm pull-right" data-toggle="tooltip" data-placement="bottom" title="Save changes"><span class="fas fa-check"></span> Save Changes</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
