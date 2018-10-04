<?php
session_start();
if (!isset($_SESSION["uid"])) {
	header("location:index.php");
}
?>

<?php
include_once("db.php");

if (isset($_GET['cart_id'])) {
    $tranx_id = $_GET['cart_id'];
    $sql = $con->query("SELECT * FROM cart WHERE uniq_id = '$tranx_id'");
    while ($row = mysqli_fetch_array($sql)) {
    $product_id[] = $row['p_id'];
    $quantity[] = $row['qty'];
    $user_id = $row['user_id'];
    }
    for ($i = 0; $i < count($product_id); $i++) {
        $sql1 = $con->query("SELECT * FROM products WHERE product_id = $product_id[$i]");
        while ($row = mysqli_fetch_array($sql1)) {
            $name[] = $row['product_title'];
            $price[] = $row['product_price'];
        }
        
    }

    for ($i = 0; $i < count($product_id); $i++) {
        
        $sql2 = "INSERT INTO `orders` (`user_id`, `product_id`,`product_title`,`product_price`,`qty`,`trx_id`) VALUES ('$user_id','".$product_id[$i]."','".$name[$i]."','".$price[$i]."','".$quantity[$i]."','$tranx_id')";
        if (mysqli_query($con, $sql2)) {
            $sql3 = "DELETE FROM cart WHERE uniq_id = '$tranx_id'";
            mysqli_query($con, $sql3);
            header("Location: order_success.php");
            unset($_SESSION['cart_id']);
           
        } 
    }
   

}    
    




?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ExpressOrder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="css/account.css" />
    <script src="main.js"></script>
	<script src="js/jquery2.js"></script>
</head>
<style>
table tr td {padding:10px;}
</style>
<body>
     <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container">
            <a href="resturant.php" class="navbar-brand">ExpressOrder</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown mr-3">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-user"></i>  <?php echo "Hi," . $_SESSION["name"]; ?>
                            </a>
                            <div class="dropdown-menu">
                                
                                <a href="logout.php" class="dropdown-item">
                                    <i class="fas fa-user-times"></i> Logout
                                </a>
                            </div>
                        </li>
                </ul>
            </div>
        </div>
    </nav>


    <header id="main-header" class="py-5 mt-1 bg-primary text-white">
        <div class="home-inner rower">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <p class="display-3">Recent Order</p>
                </div>
            </div>
        </div>
    </header>

    <section id="side-bar">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4 account-setting">
                    <h4>Account settings</h4>
                    <ul class="list-group mr-5 mt-5">
                        <a href="customer_order.php"><li class="list-group-item"><i class="fas fa-cart-plus"></i> Recent Order</li></a>
                        <a href="account.php"><li class="list-group-item"><i class="fas fa-user"></i> Account Settings</li></a>
                        <a href="change_password.php"><li class="list-group-item"><i class="fas fa-key"></i> Change Password</li></a>
                    </ul>
                </div>
                <div class="col-md-8">
                <div class="col-md-12" id="signup_msg">
                   <?php
                    if (isset($error)) {
                        echo "
			<div class='alert alert-warning'>
				<div  class='close' data-dismiss='alert' aria-label='close'>&times;</div>
				<b>" . $msg . "</b>
			</div>
		";
                    }
                    ?>
                </div>
                    <?php
					include_once("db.php");
					$user_id = $_SESSION["uid"];
					$orders_list = "SELECT * FROM orders WHERE user_id = '$user_id' ";
					$query = mysqli_query($con, $orders_list);
					if (mysqli_num_rows($query) > 0) {
						while ($row = mysqli_fetch_array($query)) {
							?>
										<div class="row">
											
											<div class="col-md-6">
												<table>
													<tr><td>Product Name</td><td><b><?php echo $row["product_title"]; ?></b> </td></tr>
													<tr><td>Product Price</td><td><b><?php echo "₦ " . $row["product_price"]; ?></b></td></tr>
													<tr><td>Quantity</td><td><b><?php echo $row["qty"]; ?></b></td></tr>
													<tr><td>Transaction Id</td><td><b><?php echo $row["trx_id"]; ?></b></td></tr>
												</table>
                                                <hr>
											</div>
										</div>
									<?php
						      } 
							}
							?>
                </div>
            </div>
        </div>

    </section>

    <!-- FOOTER -->
    <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
        <div class="rower">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">
                        Copyright &copy; 2018 ExpressOrder
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
</body>

</html>
	