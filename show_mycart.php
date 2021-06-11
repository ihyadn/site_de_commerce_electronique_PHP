<?php 
session_start();

$total = 0;
    
$to = 0;

$output = "";

$output .= "
  <table class='table table-bordered table-striped'>
    <tr >
       <th>ID</th>
       <th>NAME</th>
       <th>TYPE</th>
       <th>PRICE</th>
       <th>shipping</th>
       <th>QUANTITY</th>
       <th>Total</th>
       <th>ACTION</th>
    </tr>
";

//session_destroy();
if (!empty($_SESSION['mycart'])) {


	foreach ($_SESSION['mycart'] as $key => $value) {
		$output .= "
           <tr>
             <td>".$value['id']."</td>
             <td>".$value['name']."</td>
             <td>$ ".$value['type']."</td>
             <td>$ ".$value['price']."</td>
             <td>$ ".$value['ship']."</td>
             <td>".$value['quantity']."</td>
             <td>$".$value['quantity'] * ($value['price']+$value['ship'])."</td>
             <td>
               <button class='btn btn-danger remove' id='".$value['id']."'>Remove</button>
             </td>
		";

		

		$total = $total + $value['quantity'] * ($value['price']+$value['ship']);


    $_SESSION['total_price'] = $total;


		
	}

	$output .= "
         <tr>
         
         <td colspan="."3"."><b>Total Price</b></td>
         <td colspan="."3"."><b>$".$total."</b></td>
         
            <td>
              <a href='validation.php'><button class='btn btn-info btn-block valider'>Valider</button></a>
            </td>
            <td>
              <button class='btn btn-warning btn-block clearall' id='".$value['id']."'>Clear All</button>
            </td>
            
         </tr>
   
	";



	$to = count($_SESSION['mycart']);
	
}else{


}
$output .= '</table>';
$data['da'] = $to;
$data['out'] = $output;

echo json_encode($data);


 ?>