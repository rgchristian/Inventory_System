<?php
require_once('includes/load.php');
page_require_level(2);

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $product = find_by_id('products', $product_id);
    if (!$product) {
        $_SESSION['warning'] = "Product not found.";
        redirect('product.php');
    }

    $sql = "UPDATE products SET deleted = 1 WHERE id = {$product_id}";
    $result = $db->query($sql);

    if ($result && $db->affected_rows() === 1) {
        $_SESSION['success'] = "Product soft deleted successfully.";
    } else {
        $_SESSION['danger'] = "Failed to delete product.";
    }
    redirect('product.php');
} else {
    $_SESSION['danger'] = "Missing product ID parameter.";
    redirect('product.php');
}
?>