<?php 

session_start();
					
		// include('../connection.php');
 	//   	 $connection = new Connection(); 
  //   	 $conn=$connection->connect();



if (isset($_POST['submit'])) {

//data attribute
$target="images/".basename($_FILES['myimage']['name']);
$image=$_FILES['myimage']['name'];
$product_title=$_POST['product_title'];
$product_price=$_POST['product_price'];
$product_detail=$_POST['product_detail'];
$date=date('Y-m-d H:i:s');
 $admin=$_SESSION['admin'];

//creating product object to access its function

include('../product.php');
$product=new Product();


 	//sql rough
 	$sql="INSERT INTO `product` (`product_id`, `product_title`, `product_price`, `product_detail`, `image`, `admin_username`, `last_modified`) VALUES (NULL, '$product_title', '$product_price', '$product_detail', '$image', '$admin', '$date');";


if($product->productQuery($sql)){

	echo "query executed sucessfully";


if (move_uploaded_file($_FILES['myimage']['tmp_name'], $target)) {

	echo "file moved sucessfully";
}

}
else{
	echo mysqli_error($conn);
}

	


}


 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>product</title>

<!--bootstrap css-->
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">


<link href="//maxcdn.bootstrapcdn.0com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../include/css/font-awesome.css">

<!--external css -->
<link rel="stylesheet" href="../include/css/admin_panel_style.css">


<!-- Include Modernizr in the head, before any other Javascript -->
<script src="../include/js/modernizr-2.6.2.min.js"></script>
 </head>
 <body>
 	<div class="container">
 		
 	

		<div class="table-responsive">
	
		<table class="table-striped table">
 		<thead>
 			<tr>
 				<th>product id</th>
 				<th>product title</th>
 				<th>product price</th>
 				<th>product detail</th>
 				<th>image</th>
 				<th>admin</th>
 				<th>date</th>
 			</tr>
 			
 		</thead> <!-- end of table header -->
<?php $results=$product->fetchProduct(); ?>
 		<tbody>
 			<?php while ($products=mysqli_fetch_array($results,MYSQLI_ASSOC)) { ?>
 			<tr>
 				<td> <?php echo $products['product_id']; ?> </td>
 				<td> <?php echo $products['product_title']; ?> </td>
 				<td> <?php echo $products['product_price']; ?> </td>
 				<td> <?php echo $products['product_detail']; ?> </td>
 				<td>      <?php echo '<img  class="img-rounded"src="images/'.$products['image'].'"  style="width:100px;height:100px" />';
 ?>
 				</td> 
 				<td> <?php echo $products['admin_username']; ?> </td>
 				<td> <?php echo $products['last_modified']; ?> </td>


 			</tr> <!-- end of row -->
 			<?php } ?>
 			
 		</tbody> <!-- end of table body -->
 		
 	</table> <!-- end of product detail table -->

		

		</div> <!-- end of table-responsive -->
		</div> <!-- end ofcontainer -->

		<!-- All Javascript at the bottom of the page for faster page loading --> 

<!-- First try for the online version of jQuery--> 
<script src="http://code.jquery.com/jquery.js"></script> 

<!-- If no online access, fallback to our hardcoded version of jQuery --> 
<script>window.jQuery || document.write('<script src="../includes/js/jquery-1.8.2.min.js"><\/script>')</script> 

<!-- Bootstrap JS --> 
<script src="../bootstrap/js/bootstrap.min.js"></script> 
 	
 </body>
 </html>