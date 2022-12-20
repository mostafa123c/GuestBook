<?php

class products
{
    private $connection;

    public function __construct()
    {
        $this->connection=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        
    }

    public function addproduct($title,$description,$image,$price,$available,$userid)
    {
        $this->connection->query("INSERT INTO `product`( `title`, `description`,`image`,`price`,`available`,`user_id`) VALUES ('$title','$description','$image',$price,$available,$userid)");
        if($this->connection->affected_rows >0)
             return true;

        echo $this->connection->error;
        return false;    
        
    }

    public function updateproduct($id,$title,$description,$image,$price,$available)
    {
        $sql = "UPDATE `product` SET";

        if(strlen($title)>0)
           $sql.="`title`='$title'";

        if(strlen($description)>0)
           $sql.=",`description`='$description'";

        if(strlen($image)>0)
           $sql.=",`image`='$image'";


        $sql.=",`price`='$price',`available`='$available' WHERE `id`=$id";


        $this->connection->query($sql);
        if($this->connection->affected_rows >0)
             return true;

        return false;  
        
    }
    
    public function deleteproduct($id)
    {
        $this->connection->query("DELETE FROM `product` WHERE `id`=$id");
        if($this->connection->affected_rows >0)
             return true;

        return false; 
    }

    public function getproducts($extra='')
    {
        $result = $this->connection->query("SELECT * FROM `product` $extra");
        if($result->num_rows >0)
        {
           $products =array();
           while($row=$result->fetch_assoc())
           {
            $products[] =$row ;
           } 
           return $products;
        }
        return null;
        
    }

    public function getproduct($id)
    {
        $products =$this->getproducts("WHERE `id` = $id");
        if($products && count($products)>0)
            return $products[0];
        else 
        
        return null;  
    }

    public function searchproduct($keyword)
    {
        return $this->getproducts("WHERE `title` LIKE '%$keyword%'");
        
    }


    public function __destruct()
    {
        $this->connection->close();
    }



}


?>