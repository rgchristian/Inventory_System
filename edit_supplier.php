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
        $session->msg('s', "Supplier details updated.");
        redirect('edit_supplier.php?id=' . (int)$e_supplier['id'], false);
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
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="fa fa-pencil-square-o"></span>
          Edit Supplier Details
        </strong>
       </div>
       <div class="panel-body">
        <form method="post" action="edit_supplier.php?id=<?php echo (int)$e_supplier['id']; ?>" class="clearfix">
            <div class="form-group">
                  <label for="name" class="control-label"><span class="fa fa-pencil"></span> Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Supplier Name" value="<?php echo $e_supplier['supp_name']; ?>">
            </div>
            <div class="form-group">
                  <label for="username" class="control-label"><span class="fa fa-suitcase"></span></span> Company Name</label>
                  <input type="text" class="form-control" name="company-name" placeholder="Company Name" value="<?php echo $e_supplier['company_name']; ?>">
            </div>
            <div class="form-group">
                  <label for="username" class="control-label"><span class="fa fa-map-marker"></span> Address</label>
                  <input type="text" class="form-control" name="address" placeholder="Supplier Address" value="<?php echo $e_supplier['address']; ?>">
            </div>
            <div class="form-group">
                  <label for="username" class="control-label"><span class="fa fa-envelope-o"></span> Email</label>
                  <input type="text" class="form-control" name="email" placeholder="Company Email" value="<?php echo $e_supplier['email']; ?>">
            </div>
            <div class="form-group">
                  <label for="username" class="control-label"><span class="fa fa-phone"></span> Phone</label>
                  <input type="text" class="form-control" name="phone" placeholder="Company Phone Number" value="<?php echo $e_supplier['phone']; ?>">
            </div>
            
            <div class="form-group clearfix">
                    <button type="submit" name="update" class="btn btn-primary pull-right btn-sm"><span class="fa fa-check"></span> Save Changes</button>
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
