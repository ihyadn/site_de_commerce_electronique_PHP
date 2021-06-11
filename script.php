<?php
$db = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8','root','');
$json_file=file_get_contents("products.json");
$products = json_decode($json_file, true);
$s=0;

foreach($products as $row)
    {
        $s=$s+1;
        $ref=$row["ref"];
        $name=$row["name"];
        $type=$row["type"];
        $price=$row["price"];
        $shipping=$row["shipping"];
        $description=$row["description"];
        $manufacturer=$row["manufacturer"];
        $image=$row["image"];
        $sql="INSERT INTO products (ref,name,type,price,shipping,description,manufacturer,image) VALUES (?,?,?,?,?,?,?,?)";
        $stmt= $db->prepare($sql);
        $stmt->execute([$ref,$name,$type,$price,$shipping,$description,$manufacturer, $image]);
        $n=count($row["category"]);
        for($i=0;$i<$n;$i++)
        {
        $id=$row["category"][$i]["id"];
        $name=$row["category"][$i]["name"];

        $sql2 = "INSERT INTO products_categories VALUES(?,?,?)";
        $stmt2= $db->prepare($sql2);
        $stmt2->execute([$ref,$id,$name]);
        }
    }
    print_r($id);
?>