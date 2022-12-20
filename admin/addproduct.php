<?php
session_start();
require('../includes/config.php');
require('../includes/products.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}



$success='';
$error ='';

if(count($_POST)>0)
{
    $title= $_POST['title'];
    $description = $_POST['description'];
    $available = $_POST['available'];
    $price = $_POST['price'];
    $userid=$_SESSION['user']['id'];

    //image

    $image='';
    if(isset($_FILES['image']))
    {
        //info
        $name=$_FILES['image']['name'];
        $type=$_FILES['image']['type'];
        $tmp=$_FILES['image']['tmp_name'];
        $size=$_FILES['image']['size'];
        $error=$_FILES['image']['error'];

        if( $error ==0 && $type=='image/png' || $type=='image/jpg' || $type=='image/jpeg')
        {
            //rename
            $image =md5($name.date('u').rand(1000,10000)).$name ;
            //move
           move_uploaded_file($tmp,'../uploads/'.$image);
               

        }
    }



$productobject=new products;
if($productobject->addproduct($title,$description,$image,$price,$available,$userid))
{
    $success = 'product added successfully';
}
else
{
   $error = 'invalid data submitted';
}
}    

include('../templates/admin/header.html');
include('../templates/admin/menu.html');
include('../templates/admin/add-product.html');
include('../templates/admin/footer.html');


?>