<?php
session_start();
include "db.php";
if (!isset($_SESSION["uid"])) {
  header("location:index.php");
}

if (isset($_POST["submit"])) {

    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $error = "";

    $name = "/^[a-zA-Z ]+$/";
    $emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
    $number = "/^[0-9]+$/";

    if (empty($f_name) || empty($l_name) || empty($email) ||
        empty($mobile) ) {
            $error = "Please fill in all the fields";
        
    } else {
        if (!preg_match($name, $f_name)) {
            $error = "First name is not valid";
           
        }
        if (!preg_match($name, $l_name)) {
            $error = "Last name is not valid";
            
        }
        if (!preg_match($emailValidation, $email)) {
            $error = "email is invalid";
            
        }
      
        if (!preg_match($number, $mobile)) {
            $error = "number is invalid";
            
        }
	

            
         $sql = "INSERT INTO `services` 
		(`user_id`, `first_name`, `last_name`, `email`, 
		 `mobile`) 
		VALUES (NULL, '$f_name', '$l_name', '$email', 
		 '$mobile')";
            if (mysqli_query($con, $sql)) {
            $error = "You will be contacted in the next 5 minutes THANK Y0U!!!!";
		
                
            }else{
            $error = "Not able to reach customer care";
            }
        }
    }





?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
  <title>ExpressOrder</title>
</head>
<style>
.carousel-item {
  height: 450px;
}

.carousel-image-1 {
  background: url('img/catering.jpg');
  background-size: cover;
}

.carousel-image-2 {
  background: url('img/event.jpg');
  background-size: cover;
}



</style>

<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="index1.php" class="navbar-brand">ExpressOrder</a>
      
    </div>
  </nav>

  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-cog"></i>Our services</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- SHOWCASE SLIDER -->
  <section id="showcase">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item carousel-image-1 active">
          <div class="container">
            <div class="carousel-caption d-none d-sm-block text-right mb-5">
              <h1 class="display-3 text-primary">Catering</h1>
            </div>
          </div>
        </div>

        <div class="carousel-item carousel-image-2">
          <div class="container">
            <div class="carousel-caption d-none d-sm-block text-right mb-5">
              <h1 class="display-3 text-primary">Event Management</h1>
            </div>
          </div>
        </div>

        

      <a href="#myCarousel" data-slide="prev" class="carousel-control-prev">
        <span class="carousel-control-prev-icon"></span>
      </a>

      <a href="#myCarousel" data-slide="next" class="carousel-control-next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
  </section>

    <section class="mt-5">
    <div class="container">
        <div class="col-md-8 mx-auto">
        <div class="col-md-12" id="signup_msg">
                   <?php
                    if (isset($error)) {
                        echo "
			<div class='alert alert-warning'>
				<div  class='close' data-dismiss='alert' aria-label='close'>&times;</div>
				<b>" . $error . "</b>
			</div>
		";
                    }
                    ?>
                </div>
          <div class="card">
            <div class="card-header">
              <h4>Contact Us</h4>
            </div>
            
            <div class="card-body">
              <form method="post">
                <div class="form-group">
                  <label for="f_name">First Name</label>
                  <input type="text" id="f_name" name="f_name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="f_name">Last Name</label>
                <input type="text" id="l_name" name="l_name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                  <label for="mobile">Mobile</label>
                <input type="text" id="mobile" name="mobile" class="form-control">
                </div>
                <input style="width:100%;" value="Contact Us" type="submit" name="submit" class="btn btn-success btn-lg">
                 
			  </form>
            </div>
          </div>
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
            Copyright &copy;
            <span id="year"></span>
            ExpressOrder
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
  <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>

  <script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());
  </script>
</body>

</html>