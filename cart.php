<!DOCTYPE html>
<html>
<head>
	<title>MY SHOPPING CART</title>
</head>
<body>

	<?php 
     include("header.php");


	 ?>

	 <div class="container">
	 	<div class="col-md-12 get_cart my-5">
	 		
	 	</div>
	 </div>


	 <script type="text/javascript">
	 	$(document).ready(function(){
            
           show_mycart();
           function show_mycart(){
              console.log("hi");
              $.ajax({
              url:"show_mycart.php",
              method:"POST",
              dataType:"JSON",
              complete:function(data){
                console.log(data);
                
              	$(".get_cart").html(data.responseJSON.out);
                $("#cart").text(data.responseJSON.da);
                $("#total").text(data.total);
              }
           
           });
           }

           //setInterval(show_mycart,1000);
	 	});

	 	$(document).on("click",".remove",function(){
             var id = $(this).attr("id");

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

</body>
</html>