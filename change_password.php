<?php
include "db.php";
session_start();
$user_id = $_SESSION["uid"];
if (!isset($user_id)) {
    header("location:index.php");
}

if (isset($_POST['old_pass'])){
	$old_pass = md5($_POST['old_pass']);
	$new_pass = md5($_POST['new_pass']);
    $re_pass = md5($_POST['re_pass']);
    $msg = "";
	$password_query = $con->query("select * from user_info where user_id=$user_id");
	$password_row = mysqli_fetch_assoc($password_query);
	$database_password = $password_row['password'];
	if ($database_password == $old_pass){
		if ($new_pass == $re_pass)
			{
			mysqli_query($con,"UPDATE user_info SET password='$new_pass' WHERE user_id= $user_id");
            $msg="password updated";
			}
		  else
			{
            $msg = "password do not match";
        
            }
           
		}
	  else
		{
        $msg = "password do not match";
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

<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
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
        <div class="home-inner container">
            <div class="row">
                <div class="col-md-6">
                    <p class="display-3">Change Password</p>
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
                <?php
                if (isset($msg)) {
                    echo "
			<div class='alert alert-warning'>
				<div  class='close' data-dismiss='alert' aria-label='close'>&times;</div>
				<b>" . $msg . "</b>
			</div>
		";
                }
                ?>
                    <h4>change password</h4>
                    <form method="post">
                        <div class="form-group">
                            <label for="cpassword">current password</label>
                            <input type="password" name="old_pass" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="npassword">new password</label>
                            <input type="password" name="new_pass" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="copassword">confirm password</label>
                            <input type="password" name="re_pass" class="form-control form-control-lg">
                        </div>
                        <input type="submit" name="change" class="btn btn-success" style="float:right;" Value="Change Password">
                         <div class="panel-footer"><div id="e_msg"></div></div>
			  </div>
                  </form>
                </div>
            </div>
        </div>

    </section>
    <!-- FOOTER -->
    <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
        <div class="container">
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