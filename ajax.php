<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>

<?php
 // Auto suggetion
    $html = '';
   if(isset($_POST['product_name']) && strlen($_POST['product_name']))
   {
     $products = find_product_by_title($_POST['product_name']);
     if($products){
        foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['name'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'Not found';
        $html .= "</li>";

      }

      echo json_encode($html);
   }
   
 ?>
 <?php
 // find all product
  if(isset($_POST['p_name']) && strlen($_POST['p_name']))
  {
    $product_title = remove_junk($db->escape($_POST['p_name']));
    if($results = find_all_product_info_by_title($product_title)){
        foreach ($results as $result) {

          $html .= "<tr>";

          $html  .= "<td>";
          $html .= "<input type=\"text\" class=\"form-control\" id=\"s_name\" value=\"{$result['name']}\">";
          $html .= "</td>";

          $html .= "<input type=\"hidden\" class=\"form-control\" name=\"s_id\" value=\"{$result['id']}\">";
          $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"price\" value=\"{$result['sale_price']}\">";
          $html  .= "</td>";
          $html .= "<td id=\"s_qty\">";
          $html .= "<input type=\"text\" class=\"form-control\" name=\"quantity\" value=\"\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"total\" value=\"{$result['sale_price']}\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<input type=\"date\" class=\"form-control datePicker\" name=\"date\" data-date data-date-format=\"yyyy-mm-dd\">";
          $html  .= "</td>";

          $html .= "<td style=\"text-align: center;\">";
          $html  .= "<button type=\"submit\" name=\"add_sale\" class=\"btn custom-primary-btn btn-sm\ data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Sell product\">Sell</button>";
          $html  .= "</td>";
          $html  .= "</tr>";

        }
    } else {
        $html ='<tr><td>Product does not exist.</td>
        <td>Product price is unknown.</td>
        <td>Product quantity is unknown.</td>
        <td>Total is unknown.</td>
        <td>Product added is unknown.</td>
        <td>Product is unknown.</td>
        </tr>';
    }

    echo json_encode($html);
  }
 ?>
