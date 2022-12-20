<?php
session_start();
require('../includes/config.php');
require('../includes/messages.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}

$id =(isset($_GET['id']))? (int)$_GET['id'] : 0;

$success='';
$error ='';
 
include('../templates/admin/header.html');
include('../templates/admin/menu.html');

$messobject=new messages;
if($messobject->deletemessage($id))
{
    $success ='message deleted successfully';

}
else
{
   $error = 'message not deleted';
}

include('../templates/admin/resultmessage.html');
include('../templates/admin/footer.html');