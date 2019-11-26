<?php 

session_start();
$connect = mysqli_connect("localhost", "root", "", "cart");
 
if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
		$count = count($_SESSION["shopping_cart"]);
		$item_array = array(
		'item_id'		=>	$_GET["id"],
		'item_name'		=>	$_POST["hidden_name"],
		'item_price'		=>	$_POST["hidden_price"],
		'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
		echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
		'item_id'		=>	$_GET["id"],
		'item_name'		=>	$_POST["hidden_name"],
		'item_price'		=>	$_POST["hidden_price"],
		'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}
 
if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
		if($values["item_id"] == $_GET["id"])
		{
		unset($_SESSION["shopping_cart"][$keys]);
		echo '<script>alert("Item Removed")</script>';
		echo '<script>window.location="order.php"</script>';
		}
		}
	}
}


?>


<html>
    <head>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body class="container">
       <div class="row">
       
       <?PHP
        $con = mysqli_connect('localhost','root');
        mysqli_select_db($con,'cart');
        $query = "SELECT * FROM `cake` ORDER BY id ASC";
        $queryfire = mysqli_query($con,$query);
        $num = mysqli_num_rows($queryfire);
        if($num > 0){
        
                
            while($product = mysqli_fetch_array($queryfire)){
           
            ?>
           
           <div class="col-md-4">
		<form method="post" action="order.php?action=add&id=<?php echo $product["id"]; ?>">
		<div style="border:3px solid #5cb85c; background-color:whitesmoke; border-radius:5px; padding:16px;" align="center">
		<img src="<?php echo $product["image"]; ?>" class="img-responsive" /><br />
 
		<h4 class="text-info"><?php echo $product["name"]; ?></h4>
 
		<h4 class="text-danger">$ <?php echo $product["price"]; ?></h4>
 
		<input type="text" name="quantity" value="1" class="form-control" />
 
		<input type="hidden" name="hidden_name" value="<?php echo $product["name"]; ?>" />
 
		<input type="hidden" name="hidden_price" value="<?php echo $product["price"]; ?>" />
 
		<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
</div>

               
                </form>
            </div>
           
           
           
           <?php

            }
        }

        ?>
        
      
		
		</table>
		</div>
	<br >
    </body>
    </html>
    