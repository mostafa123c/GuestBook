<?php
session_start();
require('../includes/config.php');
require('../includes/messages.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}

$idfromurl =(isset($_GET['id']))? (int)$_GET['id'] : 0;

$messobject=new messages;
$error='';
$success='';

include('../templates/admin/header.html');
include('../templates/admin/menu.html');
if(count($_POST)>0)
    {
        $title =$_POST['title'];
        $content =$_POST['content'];
        $idfromform =$_POST['id'];
        if($messobject->updatemessage($idfromform,$title,$content))
        {
            $success ='message updated';

        }
        else
        {
            $error ='message not updated';

        }
        include('../templates/admin/resultmessage.html');
        include('../templates/admin/footer.html');
        exit;
    }
else 
    {
        //get mess from db 
        $message =$messobject->getmessage($idfromurl);
       
        if(!$message || count($message)==0)
          { 
             $error ='message not found';
             include('../templates/admin/resultmessage.html');
             include('../templates/admin/footer.html'); 
             exit;

         }  
         include('../templates/admin/updatemessage.html');
    }

    
    include('../templates/admin/updatemessage.html');
    
    
    
    


?>



