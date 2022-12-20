<?php

class messages
{
    private $connection;

    public function __construct()
    {
        $this->connection=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        
    }

    public function addmessage($title,$content,$name,$email)
    {
        $this->connection->query("INSERT INTO `messages`( `title`, `content`,`name`,`email`) VALUES ('$title','$content','$name','$email')");
        if($this->connection->affected_rows >0)
             return true;

        echo $this->connection->error;
        return false;    
        
    }


    public function updatemessage($id,$title,$content)
    {
        $this->connection->query("UPDATE `messages` SET `title`='$title',`content`='$content' WHERE `id`=$id");
        if($this->connection->affected_rows >0)
             return true;

        echo $this->connection->error;
        return false;    



    }

    public function deletemessage($id)
    {
        $this->connection->query("DELETE FROM `messages` WHERE `id`=$id");
        if($this->connection->affected_rows >0)
             return true;

        return false; 



    }

    public function getmessages($extra='')
    {
        $result = $this->connection->query("SELECT * FROM `messages` $extra");
        if($result->num_rows >0)
        {
           $messages =array();
           while($row=$result->fetch_assoc())
           {
            $messages[] =$row ;
           } 
           return $messages;
        }
        return null;



    }

    public function getmessage($id)
    {
        $message = $this->getmessages("WHERE `id`=$id");
        if($message && count($message)>0)
            return $message[0];
        
         return null;
    }





    public function __destruct()
    {
        $this->connection->close();
    }





}


?>