<?php 
include "db.php";
session_start();
$user_id = $_SESSION["uid"];
if (!isset($user_id)) {
    header("location:index.php");
}

$sql = $con->query("SELECT * FROM user_info WHERE user_id = $user_id");
    $contain = mysqli_fetch_assoc($sql);
    $name = $contain['first_name'];
    $lname = $contain['last_name'];
    $email = $contain['email'];
    $location = $contain['address1'];
    $mobile = $contain['mobile'];

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $location = $_POST['location'];
    $phone_number = $_POST['phone_number'];
    $error = "";

    
    

    $sql_update = $con->query("UPDATE user_info SET first_name = '$firstname', last_name = '$lastname', address1 =' $location', mobile = '$location' WHERE user_id = $user_id");
    if($sql_update == true){
        $error = "account has been updated";
    }else{
        $error = "account not updated";
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="css/account.css" />
    <script src="main.js"></script>
</head>
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
        <div class="home-inner container">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <p class="display-3">My Account</p>
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
                if (isset($error)) {
                    echo '
                    <div class="w-2 bg-warning border rounded border-warning text-light text-center mb-5">
                    <h5 class="mt-2">' . $error . '</h5>
                    </div>
                    ';
                  }
                  ?>
                    <h4>Account settings</h4>
                    <p class="lead">This is your private area. Please keep your information up to date.</p>
                    <h5>personal information</h5>
                    <form method="post" enctype="multipart/form-data" class="mr-5 mt-5">
                        <div class="form-group">
                            <label for="fname">firstname</label>
                            <input type="text" name="firstname" class="form-control form-control-lg" value=" <?php echo $name; ?>" placeholder="John">
                        </div>
                        <div class="form-group">
                            <label for="lname">lastname</label>
                            <input type="text" name="lastname" class="form-control form-control-lg" value="<?php echo $lname; ?>">
                        </div>
                        <h5>contact details</h5>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="email" name="email" class="form-control form-control-lg" value="<?php echo $email; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="location">location</label>
                             <input type="text" name="location" class="form-control form-control-lg" value="<?php echo $location?>">
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="phone"name="phone_number" class="form-control form-control-lg" value="<?php echo $mobile ?>">
                        </div>
                        <input type="submit" value="Save Changes" name="submit" class="btn btn-outline-primary btn-block mt-4">
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