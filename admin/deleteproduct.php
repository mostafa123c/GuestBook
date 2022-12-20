<?php
session_start();
require('../includes/config.php');
require('../includes/products.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}

$id =(isset($_GET['id']))? (int)$_GET['id'] : 0;

$error='';
$success='';

$productobject=new products;
$product = $productobject->getproduct($id);

include('../templates/admin/header.html');
include('../templates/admin/menu.html');
if( $productobject->deleteproduct($id))      //deleted from db 
    {
        if(file_exists('../uploads/'.$product['image']))
            unlink('../uploads/'.$product['image']);  // deleting image 
        $success='product deleted';
    }
else 
    $error = 'product not deleted'   ;


include('../templates/admin/resultmessage.html');
include('../templates/admin/footer.html');



?>