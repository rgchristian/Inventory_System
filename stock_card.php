<?php
$page_title = 'Stock Card Report';
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
  <div class="col-md-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          
          <span>Stock Card</span>
        </strong>
      </div>
      <div class="panel-body">
        <form class="clearfix" method="post" action="stock_card_process.php">

        <div class="form-group">
              <label class="form-label">Date</label>
                <div class="input-group">
                  <input type="text" class="datepicker form-control" name="start-date" placeholder="From">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                  <input type="text" class="datepicker form-control" name="end-date" placeholder="To">
                </div>
            </div>

            <div class="form-group">
                 <button type="submit" name="submit" class="btn btn-primary pull-right btn-sm"><span class="fa fa-check"></span> Generate Report</button>
            </div>
          </form>
      </div>

<?php include_once('layouts/footer.php'); ?>
