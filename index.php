<?php
require('includes/config.php');
require('includes/products.class.php');
$selected='home';
$prodobj =new products;
$products=$prodobj->getproducts("ORDER BY `id` DESC LIMIT 3");



include('templates/front/header.html');
include('templates/front/index.html');
include('templates/front/footer.html');
 
 


?>