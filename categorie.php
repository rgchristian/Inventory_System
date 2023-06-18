<?php
  $page_title = 'Product Category';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  
  $all_categories = find_all('categories')
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('category-name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['category-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO categories (name)";
      $sql .= " VALUES ('{$cat_name}')";
      if($db->query($sql)){
        $session->msg("s", "Category successfully added.");
        redirect('categorie.php',false);
      } else {
        $session->msg("d", "Failed to add new category.");
        redirect('categorie.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('categorie.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

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
      <div class="panel panel-info">
        <div class="panel-heading">
          <strong>
            
            <span >Add New Tile Collection</span>
          </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="categorie.php">
          <div class="form-group">
          <label style="color: #7f7f7f;">Tile Collection</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-th-large" style="color: #666666;"></i>
    </span>
    <input type="text" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Input tile collection name" name="category-name" placeholder="Tile Collection Name"> 
  </div>
</div>

            <button type="submit" name="add_cat" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Done"><span class="fas fa-check"></span> Done</button>
        </form>
        </div>
      </div>
    </div>
    
    <div class="col-md-7">
    <div class="panel panel-info">
      <div class="panel-heading">
        <strong>
          
          <span >All Tile Collections</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered" style="color: #567189;">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Tile Collection</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>

            </thead>
            <tbody>
              <?php foreach ($all_categories as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a class="text-center" href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit tile type">
                          <span class="fas fa-pencil-square-o" style="color: #567189;"></span>
                        </a>
                        <a class="text-center" href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove tile type">
                          <span class="fas fa-trash" style="color: #567189;"></span>
                        </a>
                      </div>
                    </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          
       </div>
    </div>
    </div>
   </div>
  </div>
  
  <?php include_once('layouts/footer.php'); ?>
