<?php
$page_title = 'Sales Report';
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
          
          <span >Sales Report</span>
        </strong>
      </div>
      <div class="panel-body">
        <form class="clearfix" method="post" action="sale_report_process.php">

        <div class="form-group">
              <label class="form-label" style="color: #7f7f7f;">Date</label>
                <div class="input-group">
                  <input type="text" class="datepicker form-control" name="start-date" data-toggle="tooltip" data-placement="bottom" title="Start date" placeholder="From">
                  <span class="input-group-addon"><i class="fas fa-long-arrow-alt-right" style="color: #666666;"></i></span>
                  <input type="text" class="datepicker form-control" name="end-date" data-toggle="tooltip" data-placement="bottom" title="End date" placeholder="To">
                </div>
            </div>

            <div class="form-group">
                 <button type="submit" name="submit" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Generate sales report"><span class="fas fa-check"></span> Generate Report</button>
            </div>
          </form>
      </div>

<?php include_once('layouts/footer.php'); ?>
