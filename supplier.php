<?php
  $page_title = 'Supplier';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);

  
   
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
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          
          <span>Suppliers</span>
          <a href="add_supplier.php" class="btn btn-primary pull-right btn-sm"><i class="fa fa-plus">&nbsp;</i> Add New Supplier</a>
       </strong>
         
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Supplier Name </th>
            <th>Company Name</th>
            <th class="text-center" style="width: 20%;">Address</th>
            <th class="text-center" style="width: 20%;">Email</th>
            <th class="text-center" style="width: 100px;">Phone</th>
            <th class="text-center" style="width: 100px;">Actions</th>
        </thead>
        
        <tbody>
        <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $database = "inventory_system";

              $connection = new mysqli($servername, $username, $password, $database);
              
              if($connection->connect_error){
                die("Connection failed: " . $connection->connect_error);
              }

              $sql = "SELECT * FROM suppliers";
              $result = $connection->query($sql);

              if(!$result){
                die("Invalid query: " . $connection->error);
              }

              while($row = $result->fetch_assoc()){
                echo "<tr>
                        <td class='text-center'>" . $row["id"] ."</td>
                        <td>" . $row["supp_name"] ."</td>
                        <td>" . $row["company_name"] ."</td>
                        <td class='text-center'>" . $row["address"] ."</td>
                        <td class='text-center'>" . $row["email"] ."</td>
                        <td class='text-center'>" . $row["phone"] ."</td>
                        <td class='text-center'>
                            <div class='btn-group'>
                                <a href='edit_supplier.php?id=" . $row["id"] . "' class='btn btn-xs btn-warning' data-toggle='tooltip' title='Edit'>
                                    <i class='fa fa-pencil-square-o'></i>
                                </a>
                                <a href='delete_supplier.php?id=" . $row["id"] . "' class='btn btn-xs btn-danger' data-toggle='tooltip' title='Remove'>
                                    <i class='fa fa-trash-o'></i>
                                </a>
                            </div>
                        </td>
                      </tr>";
              }
           ?>
       </tbody>
     </table>

     </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>









