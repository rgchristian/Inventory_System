<style>
  .menu-list li a:hover,
  .menu-list li a.active 
  .menu-list li a.clicked {
    border: 2px solid #567189;
    border-radius: 3px;
  }
</style>



<ul class="menu-list">
  <li>
    <a href="admin.php"> 
      <i class="fa fa-tasks"></i>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>

  <li>
    <a href="product.php" class="submenu-toggle">
      <i class="fab fa-delicious"></i>
      <span class="menu-title">Tile Products</span>
    </a>
    <ul>
      <!-- <li><a href="add_product.php"><i class="fa fa-cart-arrow-down"></i>Add Product</a></li> -->
      <!-- <li><a href="sales.php"><i class="fa fa-history"></i>Sales History</a></li> -->
    </ul>
  </li>

  <li>
    <a href="categorie.php">
      <i class="glyphicon glyphicon-th-large"></i>
      <span class="menu-title">Tile Types</span>
    </a>
  </li>

  <li>
    <a href="media.php">
      <i class="glyphicon glyphicon-picture"></i>
      <span class="menu-title">Product Photos</span>
    </a>
  </li>

  <li>
    <a href="sales_report.php" class="submenu-toggle">
      <i class="fa fa-bar-chart-o"></i>
      <span class="menu-title">Sales Report</span>
    </a>
  </li>

  <li>
    <a href="stock_card.php"> 
      <i class="fa fa-cube"></i>
      <span class="menu-title">Stock Report</span>
    </a>
  </li>
</ul>
