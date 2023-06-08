<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $delete_id = delete_by_id('suppliers',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Supplier successfully removed.");
      redirect('supplier.php');
  } else {
      $session->msg("d","Supplier failed to remove.");
      redirect('supplier.php');
  }
?>
