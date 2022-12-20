<?php
require('includes/config.php');
require('includes/products.class.php');
$selected='products';

$id =(isset($_GET['id']))? (int)$_GET['id']:0;
$prodobj =new products;
$product =$prodobj->getproduct($id);

include('templates/front/header.html');
if($product && count($product)>0 )
{
    include('templates/front/product-info.html');
}
else
{
    include('templates/front/404.html');

}















include('templates/front/footer.html');

?>