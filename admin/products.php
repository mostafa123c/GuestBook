<?php
session_start();
require('../includes/config.php');
require('../includes/products.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}

$productobject=new products;
$allproducts= $productobject->getproducts();



include('../templates/admin/header.html');
include('../templates/admin/menu.html');
include('../templates/admin/all-products.html');
include('../templates/admin/footer.html');




?>

