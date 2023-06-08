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
          $session->msg("s", 'Supplier successfully added.');
          redirect('add_supplier.php', false);
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
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            
            <span>Add New Supplier</span>
          </strong>
        </div>

        <div class="panel-body">
          <form method="post" action="add_supplier.php">

          <form method="post" action="add_supplier.php">
  <div class="form-group">
    <label for="">Name</label>
    <input type="text" class="form-control" name="supplier-name" placeholder="Supplier Name">
  </div>

  <div class="form-group">
    <label for="">Company Name</label>
    <input type="text" class="form-control" name="company-name" placeholder="Company Name">
  </div>

  <div class="form-group">
    <label for="">Address</label>
    <input type="text" class="form-control" name="supplier-address" placeholder="Company Address">
  </div>

  <div class="form-group">
    <label for="">Email</label>
    <input type="text" class="form-control" name="email" placeholder="Company Email">
  </div>

  <div class="form-group">
    <label for="">Phone</label>
    <input type="text" class="form-control" name="phone" placeholder="Company Phone Number">
  </div>

  <div class="form-group clearfix">
    <button type="submit" name="add_supplier" class="btn btn-primary pull-right btn-sm">
      <span class="fa fa-check"></span> Done
    </button>
  </div>
</form>


        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>


