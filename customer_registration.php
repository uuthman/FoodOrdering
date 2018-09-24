

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
	<script src="js/jquery2.js"></script>
  <title>registration</title>
</head>

<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="index.php" class="navbar-brand">ExpressOrder</a>
    </div>
    
  </nav>

  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-user"></i> Registration</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="actions" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">

      </div>
    </div>
  </section>

  <!-- LOGIN -->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card">
            <div class="card-header">
              <h4>sign up</h4>
            </div>
            
            <div class="card-body">
              <form id="signup_form" onsubmit="return false">
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
                <div class="form-group">
                  <label for="access">Role</label>
                    <select name="access" class="form-control">
                        <option>Staff</option>
                        <option>Student</option>
                    </select>
                  </div>
                <div class="form-group">
                  <label for="address1">Address</label>
                <input type="text" id="address1" name="address1" class="form-control">
                </div>
                <div class="form-group">
                  <label for="password">password</label>
                <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                  <label for="repassword">Re-enter Password</label>
                <input type="password" id="repassword" name="repassword" class="form-control">
                </div>
                <input style="width:100%;" value="Sign Up" type="submit" name="signup_button" class="btn btn-success btn-lg">
                 <div class="col-md-12" id="signup_msg">
            <!--Alert from signup form-->
                </div>
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
            Blogen
          </p>
        </div>
      </div>
    </div>
  </footer>
  <script src="main.js"></script>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>


  <script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());
  </script>
</body>

</html>























