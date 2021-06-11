<?php
$db = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8','root','');
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page

?>
<!DOCTYPE html>
<html>
<head>
	<title>E-COMMERCE WEBSITE</title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<style>
body, html {
    height:100%;
    /*overflow: hidden;*/
    width:100%;
    padding:0;
    padding-top: 40px;
    background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}
#sidebar{
    overflow-y: auto;
    position: fixed;
    margin-bottom:200px;
}
</style>
<body>

	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark mb-5">
		<h1 class="text-white">BOUTIQUE</h1>
		<div class="mr-auto"></div>
    <ul class="text-white navbar-nav">
    	
      <li class="nav-item">
        <a class="nav-link text-white" href="index.php">Home</a>
      </li>
      <li class="nav-item cart_show">
        <button type="button" class="btn btn-dark cart_show"  data-toggle="modal" data-target="#exampleModal">
  Cart<span id="cart" class="badge badge-warning mx-2"></span>
</button>
     </li>
      <?php
      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      echo "<a class='btn btn-danger' href='logout.php'>LogOut</a>";
      };
      ?>
       
    </ul>
	</nav>
  

<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">My Carte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="carte_content">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

    <div class="container-fluid">
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-4">

                  
<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left vh-100">
        <div class="col-md-3 col-lg-3 sidebar-offcanvas h-100 overflow-auto bg-light pl-0" id="sidebar" role="navigation">
            <h2 class="text-left">Categories</h2>
            <ul class="nav flex-column sticky-top pl-0 pt-5 mt-3">
                 <?php
                   $stmt=$db->query("SELECT DISTINCT name FROM products_categories");
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach($rows as $categorie)
                    {
                        $name=$categorie["name"];
                        $text = str_replace(' ', '_', $name);
                        $stmt = $db->prepare("SELECT count(*) FROM products_categories WHERE name = ?");
                        $stmt->execute([$name]);
                        $count = $stmt->fetchColumn();
                        echo "<li class="."nav-item"."><a class="."nav-link"." href="."index.php?name=".$text.">".$name."(".$count.")"."</a></li>";
                    }

                  ?>
                
            </ul>
        </div>
        <!--/col-->
        <!--/main col-->
    </div>

</div>
               </div>
               <div class="col-lg-8 products overflow-hidden" id="products">
                  <main class="overflow-scroll d-flex flex-column justify-content-around flex-wrap">
                  <?php
                  $name="Recording Equipment";
                  if (isset($_GET["name"]))
                  {
                      $name=$_GET["name"];
                      $name = str_replace('_',' ', $name);
                  }
                  $stmt = $db->prepare("SELECT * FROM products WHERE ref in (SELECT ref FROM products_categories WHERE name = ?)");
                  $stmt->execute([$name]);
                  $products=$stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach($products as $product)
                  {?>
                  <div class="ml-5 mb-5 d-flex">
                     <img src="<?php echo $product["image"];?>" class=" col-md-3 mr-5 ml-5 w-75 h-75 "><br/><br/>
                     <form method="post" class="d-flex flex-column justify-content-between col-md-8 ">
                        <h4 class="text-danger"> <?php echo $product["name"];?></h4><br/>
                        <h6 class="text"> <?php echo $product["description"];?></h6><br/>
                        <h6 class="text-danger"> <?php echo $product["price"]."$";?></h6>
                        <input type="text" name="quantity" class="form-control" value="1" id="<?php echo "quantity".$product["ref"];?>">
                        <input type="hidden" name="name"  value="<?php echo $product["name"];?>" id="<?php echo "name".$product["ref"];?>">
                        <input type="hidden" name="type"  value="<?php echo $product["type"];?>" id="<?php echo "type".$product["ref"];?>">
                        <input type="hidden" name="price" value="<?php echo $product["price"];?>" id="<?php echo "price".$product["ref"];?>">
                        <input type="hidden" name="shipping" value="<?php echo $product["shipping"];?>" id="<?php echo "shipping".$product["ref"];?>">
                        <input action="add" type="submit" id=<?php echo $product["ref"]?> name="add_to_carte" class = "btn btn-success flex-end add_cart" value="Add to Carte">
                     </form>
                 </div>
                 <?php
                  }
                 ?>
                  </main>
               </div>

            </div>
         </div>

    </div>

    <script type="text/javascript">
           $(document).ready(function(){
            
            show_mycart();
           function show_mycart(){
              $.ajax({
              url: "show_mycart.php",
              method:"POST",
              dataType:"JSON",
              success:function(data){
                $(".get_cart").html(data.out);
                $("#cart").text(data.da);
              }
           });
           }

           setInterval(show_mycart,1000);

    });
       $(document).on("click",".add_cart", function(event){
       	event.preventDefault();
           var id = $(this).attr("id");
           console.log(id);
           var name = $("#name"+id+"").val();
           console.log(name);
           var type = $("#type"+id+"").val();
           console.log(type);
           var price = $("#price"+id+"").val();
           console.log(price);
           var quantity = $("#quantity"+id+"").val();
           var ship = $("#shipping"+id+"").val();
           console.log(ship);
           var action = "add";


           $.ajax({
              url: "cart_action.php",
              method:"POST",
              dataType:"JSON",
              data: {id:id,name:name,type:type,price:price,ship:ship,quantity:quantity,action:action},
              success:function(data){
                 
              }
           });
       });
      
      $(document).on("click",".cart_show", function(event){
        
        function show_mycart(){
        $.ajax({
              url:"show_mycart.php",
              method:"POST",
              dataType:"JSON",
              complete:function(data){
                console.log(data);
                document.getElementById("carte_content").innerHTML=data.responseJSON.out;
                $("#cart").text(data.responseJSON.da);
                $("#total").text(data.total);
              	
              }
           
           });
        };
           setInterval(show_mycart,1000);
       });
       $(document).on("click",".remove",function(){
             var id = $(this).attr("id");
             console.log("fin");
             var action = "delete";

              $.ajax({
              url: "cart_action.php",
              method:"POST",
              data:{id:id,action:action},
              dataType:"JSON",
              success:function(data){
              
              }
           });
	 	});

	 		$(document).on("click",".clearall",function(){
             var id = $(this).attr("id");

             var action = "clearall";

              $.ajax({
              url: "cart_action.php",
              method:"POST",
              data:{id:id,action:action},
              dataType:"JSON",
              success:function(data){
              
              }
           });
	 	});
    
	</script>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
  integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
  integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>