<?php
  $page_title = 'Add Supplier';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $suppliers = find_suppliers('suppliers');
?>

<?php
  if(isset($_POST['add_supplier'])){

   $req_fields = array('supplier-name','company-name','supplier-address', 'email', 'phone');
   validate_fields($req_fields);

   if(empty($errors)){
           $supp_name   = remove_junk($db->escape($_POST['supplier-name']));
        $company_name   = remove_junk($db->escape($_POST['company-name']));
        $address   = remove_junk($db->escape($_POST['supplier-address']));
        $email   = remove_junk($db->escape($_POST['email']));
        $phone   = remove_junk($db->escape($_POST['phone']));
        $query = "INSERT INTO suppliers (";
        $query .="supp_name,company_name,address,email,phone";
        $query .=") VALUES (";
        $query .=" '{$supp_name}', '{$company_name}', '{$address}', '{$email}', '{$phone}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg("s", 'Supplier added successfully.');
          redirect('supplier.php', false);
        } else {
          //failed
          $session->msg("d", "Failed to add supplier.");
          redirect('add_supplier.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_supplier.php',false);
   }
 }
?>

<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<?php include_once('layouts/header.php'); ?>

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
            
            <span >Add New Supplier</span>
          </strong>
          <div class="pull-right">
          <a href="supplier.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
        </div>
      </div>

        <div class="panel-body">
          <form method="post" action="add_supplier.php">

          <form method="post" action="add_supplier.php">
  <div class="form-group">
    <label style="color: #7f7f7f;" for="">Name</label>
    <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-pencil-alt" style="color: #666666;"></i>
    </span>
    <input type="text" class="form-control" name="supplier-name" data-toggle="tooltip" data-placement="bottom" title="Input supplier's name" placeholder="Supplier Name">
  </div>
  </div>

  <div class="form-group">
    <label style="color: #7f7f7f;" for="">Company Name</label>
    <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-suitcase" style="color: #666666;"></i>
    </span>
    <input type="text" class="form-control" name="company-name" data-toggle="tooltip" data-placement="bottom" title="Input supplier's company name" placeholder="Company Name">
  </div>
  </div>

  <div class="form-group">
    <label style="color: #7f7f7f;" for="">Address</label>
    <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-location-arrow" style="color: #666666;"></i>
    </span>
    <input type="text" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Input supplier's comapny address" name="supplier-address" placeholder="Company Address">
  </div>
  </div>

  <div class="form-group">
    <label style="color: #7f7f7f;" for="">Email</label>
    <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-envelope" style="color: #666666;"></i>
    </span>
    <input type="text" class="form-control" name="email" data-toggle="tooltip" data-placement="bottom" title="Input supplier's contact email" placeholder="Company Email">
  </div>
  </div>

  <div class="form-group">
    <label style="color: #7f7f7f;" for="">Phone</label>
    <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-phone-alt" style="color: #666666;"></i>
    </span>
    <input type="text" class="form-control" name="phone" data-toggle="tooltip" data-placement="bottom" title="Input supplier's contact number" placeholder="Company Phone Number">
  </div>
  </div>

  <div class="form-group">
    <button type="submit" name="add_supplier" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Done">
      <span class="fas fa-check"></span> Done
    </button>
  </div>
</form>


        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>


