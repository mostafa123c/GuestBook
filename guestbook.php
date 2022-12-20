<?php
require('includes/config.php');
require('includes/messages.class.php');
$selected='gb';

include('templates/front/header.html');
$success='';
$error ='';

$gbobject=new messages;

if(count($_POST)>0)
{
    $title=$_POST['title'];
    $content=$_POST['content'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    
   
    if($gbobject->addmessage($title,$content,$name,$email))
    {
        $success='message added successfully';
    }
    else
    {
        $error='invalid data submitted';
    }
    $messages = $gbobject->getMessages('ORDER BY `id` DESC');


}
else
{
    $messages = $gbobject->getMessages('ORDER BY `id` DESC');

}

include('templates/front/guestbook.html');
include('templates/front/footer.html');



?>