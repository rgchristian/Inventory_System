<?php
  $page_title = 'Product Photos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php $media_files = find_all('media');?>
<?php
  if(isset($_POST['submit'])) {
  $photo = new Media();
  $photo->upload($_FILES['file_upload']);
    if($photo->process_media()){
        $session->msg('s','Photo added successfully.');
        redirect('media.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('media.php');
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
        <div class="col-md-6">
          <?php echo display_msg($msg); ?>
        </div>

      <div class="col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading clearfix">
            <strong>
            <span >Product Photos</span>
            </strong>

            <div class="pull-right">
              <form class="form-inline" action="media.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <a href="product.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Inventory" style="margin-right: 10px;"><span class="fab fa-delicious"></span></a>
                <div class="input-group">
                  <span class="input-group-btn">
                    <label class="btn custom-primary-btn btn-sm btn-file d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="bottom" title="Select product photo">
                        <i class="fas fa-folder-open">&nbsp;</i> Browse Files <input type="file" name="file_upload" multiple="multiple" style="display: none;">
                    </label>
                  </span>
                 <button type="submit" name="submit" class="btn btn-default btn-sm" style="color: #666666;"data-toggle="tooltip" data-placement="bottom" title="Upload chosen photo"><span class="fas fa-upload"></span> Upload</button>
               </div>
              </div>
             </form>
            </div>
          </div>
          
          <div class="panel-body">
            <table class="table table-bordered" style="color: #567189;">
              <thead>
                <tr>
                  <th class="text-center" style="width: 50px;">#</th>
                  <th class="text-center">Product Photo</th>
                  <th class="text-center">Photo Name</th>
                  <th class="text-center" style="width: 20%;">Photo Type</th>
                  <th class="text-center" style="width: 50px;">Actions</th>
                </tr>
              </thead>
                <tbody>
                <?php foreach ($media_files as $media_file): ?>
                <tr class="list-inline">
                 <td class="text-center"><?php echo count_id();?></td>
                  <td class="text-center">
                      <img src="uploads/products/<?php echo $media_file['file_name'];?>" class="img-thumbnail" />
                  </td>
                <td class="text-center">
                  <?php echo $media_file['file_name'];?>
                </td>
                <td class="text-center">
                  <?php echo $media_file['file_type'];?>
                </td>
                <td class="text-center">
                  <a class="text-center" href="delete_media.php?id=<?php echo (int) $media_file['id'];?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Remove product photo" title="Remove">
                    <span class="fas fa-trash" style="color: #567189;"></span>
                  </a>
                </td>
               </tr>
              <?php endforeach;?>
            </tbody>
          </div>
        </div>
      </div>
</div>

<?php include_once('layouts/footer.php'); ?>


