<?php
require('includes/config.php');
require('includes/products.class.php');
$selected='products';

$prodobj =new products;
$products=$prodobj->getproducts();

include('templates/front/header.html');
include('templates/front/products.html');
include('templates/front/footer.html');

?>