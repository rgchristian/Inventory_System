<?php
  $page_title = 'Edit Supplier';
  require_once('includes/load.php');
  // Check the user's permission level to view this page
  page_require_level(1);  
?>

<?php
  $e_supplier = find_by_id('suppliers', (int)$_GET['id']);
  if (!$e_supplier) {
    $session->msg("d", "Missing supplier ID.");
    redirect('suppliers.php');
  }
?>

<?php
if (isset($_POST['update'])) {
    $req_fields = array('name', 'company-name', 'address', 'email', 'phone');
    validate_fields($req_fields);
    if (empty($errors)) {
      $id = (int)$e_supplier['id'];
      $supp_name = remove_junk($db->escape($_POST['name']));
      $company_name = remove_junk($db->escape($_POST['company-name']));
      $address = remove_junk($db->escape($_POST['address']));
      $email = remove_junk($db->escape($_POST['email']));
      $phone = remove_junk($db->escape($_POST['phone']));
      $sql = "UPDATE suppliers SET supp_name = '{$supp_name}', company_name = '{$company_name}', address = '{$address}', email = '{$email}', phone = '{$phone}' WHERE id = '{$db->escape($id)}'";
      $result = $db->query($sql);
      if ($result && $db->affected_rows() === 1) {
        $session->msg('s', "Supplier details updated successfully.");
        redirect('supplier.php?id=' . (int)$e_supplier['id'], false);
      } else {
        $session->msg('d', 'Failed to update supplier details.');
        redirect('edit_supplier.php?id=' . (int)$e_supplier['id'], false);
      }
    } else {
      $session->msg("d", $errors);
      redirect('edit_supplier.php?id=' . (int)$e_supplier['id'], false);
    }
  }
?>

<?php include_once('layouts/header.php'); ?>

 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-info">
       <div class="panel-heading clearfix">
        <strong >
          
          Edit Supplier Details
        </strong>
        <div class="pull-right">
          <a href="supplier.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
        </div>
        </div>
       <div class="panel-body">
        <form method="post" action="edit_supplier.php?id=<?php echo (int)$e_supplier['id']; ?>" class="clearfix">
            <div class="form-group">
                  <label style="color: #7f7f7f;" for="name" class="control-label">Name</label>
                  <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-pen" style="color: #666666;"></i></span>
                  <input type="text" class="form-control" name="name" placeholder="Supplier Name" data-toggle="tooltip" data-placement="bottom" title="Edit supplier's name" value="<?php echo $e_supplier['supp_name']; ?>">
            </div>
            </div>
            <div class="form-group">
                  <label style="color: #7f7f7f;" for="username" class="control-label">Company Name</label>
                  <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-suitcase" style="color: #666666;"></i></span>
                  <input type="text" class="form-control" name="company-name" placeholder="Company Name" data-toggle="tooltip" data-placement="bottom" title="Edit supplier's company name" value="<?php echo $e_supplier['company_name']; ?>">
            </div>
            </div>
            <div class="form-group">
                  <label style="color: #7f7f7f;" for="username" class="control-label">Address</label>
                  <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-location-arrow" style="color: #666666;"></i></span>
                  <input type="text" class="form-control" name="address" placeholder="Supplier Address" data-toggle="tooltip" data-placement="bottom" title="Edit supplier's address" value="<?php echo $e_supplier['address']; ?>">
            </div>
            </div>
            <div class="form-group">
                  <label style="color: #7f7f7f;" for="username" class="control-label">Email</label>
                  <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-envelope" style="color: #666666;"></i></span>
                  <input type="text" class="form-control" name="email" placeholder="Company Email" data-toggle="tooltip" data-placement="bottom" title="Edit supplier's contact email" value="<?php echo $e_supplier['email']; ?>">
            </div>
            </div>
            <div class="form-group">
                  <label style="color: #7f7f7f;" for="username" class="control-label"> Phone</label>
                  <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-phone-alt" style="color: #666666;"></i></span>
                  <input type="text" class="form-control" name="phone" placeholder="Company Phone Number" data-toggle="tooltip" data-placement="bottom" title="Edit supplier's contact number" value="<?php echo $e_supplier['phone']; ?>">
            </div>
            </div>
            
            <div class="form-group">
                    <button type="submit" name="update" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Save changes"><span class="fas fa-check"></span> Save Changes</button>
            </div>
        </form>
       </div>
     </div>
  </div>
  
      </div>
    </div>
  </div>

 </div>
<?php include_once('layouts/footer.php'); ?>
