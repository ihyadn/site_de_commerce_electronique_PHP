<?php
$db = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8','root','');
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
</head>
<style>
body, html {
    height:100%;
    /*overflow: hidden;*/
    padding-top: 40px;
}
#sidebar{
    overflow-y: scroll;
    position: fixed;
    margin-bottom:200px;
}
</style>
<body>

	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark mb-5">
		<h1 class="text-white">E-COMMERCE</h1>
		<div class="mr-auto"></div>
    <ul class="text-white navbar-nav">
    	
      <li class="nav-item">
        <a class="nav-link text-white" href="index.php">Home</a>
      </li>
         <li class="nav-item">
        <a class="nav-link text-white" href="cart.php" >Cart<span id="cart" class="badge badge-warning mx-2"></span></a>
      </li>
         <li class="nav-item">
        
      </li>

    </ul>
		
	</nav>
  
</body>
</html>