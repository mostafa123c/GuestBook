<?php
session_start();
require('../includes/config.php');
require('../includes/products.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}

$idfromurl =(isset($_GET['id']))? (int)$_GET['id'] : 0;

$error='';
$success='';

$productobject=new products;

include('../templates/admin/header.html');
include('../templates/admin/menu.html');

if(count($_POST)>0)
{
    //update product
    $idfromform =$_POST['id'];
    $title= $_POST['title'];
    $description = $_POST['description'];
    $available = $_POST['available'];
    $price = $_POST['price'];

    //image
    $product = $productobject->getproduct($idfromform);

    $productimage = $product['image'];

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
            $newimagename =md5($name.date('u').rand(1000,10000)).$name ;
            //move
            if(move_uploaded_file($tmp,'../uploads/'.$newimagename))
            {
                if(file_exists('../uploads/'.$productimage))
                     unlink('../uploads/'.$productimage);

                 $productimage=$newimagename;
            }
               

        }
    }

    
if($productobject->updateproduct($idfromform,$title,$description,$productimage,$price,$available))
{
    $success = 'product updated successfully';
    include('../templates/admin/resultmessage.html');
}
else
{
   $error = 'invalid data submitted';
   include('../templates/admin/resultmessage.html');
}



}
else 
{
    $product = $productobject->getproduct($idfromurl);
if(!$product || count($product)==0)
{
    $error ='product not found';
    include('../templates/admin/resultmessage.html');
    include('../templates/admin/footer.html'); 
    exit;
}
    //show product in form
include('../templates/admin/updateproduct.html'); 
     

 } 
 
 include('../templates/admin/footer.html'); 
?>
