<?php
  $page_title = 'Product Category';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
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
        $session->msg("s", "Successfully added new category.");
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
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            
            <span>Category</span>
          </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="categorie.php">
            <div class="form-group">
                <input type="text" class="form-control" name="category-name" placeholder="Category Name">
            </div>
            <button type="submit" name="add_cat" class="btn btn-primary pull-right btn-sm"><span class="fa fa-check"></span> Done</button>
        </form>
        </div>
      </div>
    </div>
    
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          
          <span>All Categories</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Categories</th>
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
                        <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="fa fa-pencil-square-o"></span>
                        </a>
                        <a href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="fa fa-trash"></span>
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
