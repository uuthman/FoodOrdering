<?php
session_start();
if(isset($_SESSION["uid"])){
	header("location:resturant.php");
}
?>                    
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ExpressOrder</title>
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">
		<script src="js/jquery2.js"></script>
		<script src="main.js"></script>
		<style>
			
		</style>
	</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
		<div class="container">	
				<a href="index1.php" class="navbar-brand">ExpressOrder</a>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="navbar-nav">
				<li class="nav-item px-2">
					<a href="index1.php" class="nav-link active">Home</a>
				</li>
				<li class="nav-item px-2">
					<a href="index1.php" class="nav-link">Product</a>
				</li>
				<li class="nav-item px-2">
					<a href="services.php" class="nav-link">Services</a>
				</li>
			</ul>
			
			
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mr-3">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#cart_container">
                                <i class="fas fa-cart-plus"></i> Cart<span class="badge bg-primary">0</span>
                            </a>
                        </li>
						<li class="nav-item mr-3">
                            <a href="login_form.php" class="nav-link">
                                <i class="fa fa-user"></i> login
                            </a>
                        </li>
						
						
                    </ul>
                </div>
		</div>
	</nav>
	
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>

	<div class="row">
	<div class="col-md-3">
	</div>
	<div class="col-md-4">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="Search" id="search">
				<div class="input-group-append">
				<button type="submit" class="btn btn-outline-secondary" id="search_btn"><span class="fa fa-search"></span></button>
			    </div>
			 </div>
    
	<div class="col-md-5">

	</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div id="get_category">
				</div>
				<!--<div class="nav nav-pills nav-stacked">
					<li class="active"><a href="#"><h4>Categories</h4></a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
				</div> -->
				<div id="get_brand">
				</div>
				<!--<div class="nav nav-pills nav-stacked">
					<li class="active"><a href="#"><h4>Brand</h4></a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
				</div> -->
			</div>
			<div class="col-md-9">	
				<div class="row">
					<div class="col-md-12 col-xs-12" id="product_msg">
					</div>
				</div>
				<div class="card" id="scroll">
					<div class="card-header">Products</div>
					<div class="card-body">
						<div id="get_product">
							<!--Here we get product jquery Ajax Request-->
						</div>
						<!--<div class="col-md-4">
							<div class="panel panel-info">
								<div class="panel-heading">Samsung Galaxy</div>
								<div class="panel-body">
									<img src="product_images/images.JPG"/>
								</div>
								<div class="panel-heading">₦.500.00
									<button style="float:right;" class="btn btn-danger btn-xs">AddToCart</button>
								</div>
							</div>
						</div> -->
					</div>
					<div class="card-footer">&copy; 2018</div>
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-12">
				
					<ul class="pagination" id="pageno">
						<li class="page-item"><a class="page-link" href="#">1</a></li>
					</ul>
				
			</div>
		</div>
	</div>

	<div class="modal fade text-dark" id="cart_container">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title lead">list of order</h5>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
						<div class="col-md-4">No</div>
						<div class="col-md-4">Product Name</div>
						<div class="col-md-4">Price in ₦</div>
					</div>
					<hr>
                        <div id="cart_product">
						
								<!--<div class="row">
									<div class="col-md-3">Sl.No</div>
									<div class="col-md-3">Product Image</div>
									<div class="col-md-3">Product Name</div>
									<div class="col-md-3">Price in $.</div>
								</div>-->
						</div>
						<div class="panel-footer"></div>
                      </div>
                      <hr>
                    </div>

	<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
</body>
</html>

















































