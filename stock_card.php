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
    <div class="panel panel-info">
      <div class="panel-heading">
        <strong>
          
          <span >Stock Report</span>
        </strong>
      </div>
      <div class="panel-body">
        <form class="clearfix" method="post" action="stock_card_process.php">

        <div class="form-group">
              <label style="color: #7f7f7f;"class="form-label">Date</label>
                <div class="input-group">
                  <input type="text" class="datepicker form-control" name="start-date" data-toggle="tooltip" data-placement="bottom" title="Start date" placeholder="From">
                  <span class="input-group-addon"><i class="fas fa-long-arrow-alt-right" style="color: #666666;"></i></span>
                  <input type="text" class="datepicker form-control" name="end-date" data-toggle="tooltip" data-placement="bottom" title="End date" placeholder="To">
                </div>
            </div>

            <div class="form-group">
                 <button type="submit" name="submit" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Generate stock report"><span class="fas fa-check"></span> Generate Report</button>
            </div>
          </form>
      </div>

<?php include_once('layouts/footer.php'); ?>
