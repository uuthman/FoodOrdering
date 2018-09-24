<?php
include 'core/init.php';
$user_id = $_SESSION['id'];
$user = $getFromU->adminUserData($user_id);
if ($getFromU->isUserLoggedIn() == false) {
  header('Location: login.php');
}


if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $error = "";


  $sql = "UPDATE admin SET name= '$name', email = '$email' WHERE id = $user_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindparam(":name", $title, PDO::PARAM_STR);
  $stmt->bindparam(":email", $email, PDO::PARAM_STR);
  
  

  if ($stmt->execute()){
   $error = "admin record updated succesfully";
   header("Location: profile.php");
  }else{
    $error = "An error occured";
  }
   

}

?>
<?php
if (isset($_POST['change_pass'])) {
  $new_pass = md5($_POST['new_pass']);
  $old_pass = md5($_POST['old_pass']);
  $con_pass = md5($_POST['con_pass']);
  $msg = "";

  $stmt = $pdo->query("SELECT * FROM admin WHERE id = $user_id");
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $dPass = $row['password'];
  
    if ($dPass == $old_pass) {
       if($new_pass == $con_pass){
         $stmt = $pdo->prepare("UPDATE admin SET password='$new_pass' WHERE id= $user_id");
         if ($stmt->execute()) {
           $msg = "password updated";
         }else{
           $msg = "password update failed";
         }
       }else{
         $msg = "password do not match try again!";
       }
    }else{
      $msg = "incorrect password";
    }
}
?>

<?php
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $msg = "";
  $stmt = $pdo->prepare('DELETE FROM admin WHERE id = ?');
  $stmt->bindParam(1, $id);
  if ($stmt->execute()) {
    header("Location:login.php");
  }else{
    $msg = "error occured";
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
  <link rel="stylesheet" href="css/style.css">
  <title>AdminArea</title>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="index.php" class="navbar-brand">ExpressOrder</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav">
          <li class="nav-item px-2">
            <a href="index.php" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item px-2">
            <a href="posts.php" class="nav-link">Posts</a>
          </li>
          <li class="nav-item px-2">
            <a href="categories.php" class="nav-link">Categories</a>
          </li>
          <li class="nav-item px-2">
            <a href="users.php" class="nav-link">Users</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item mr-3">
            <a href="profile.php" class="nav-link ">
              <i class="fas fa-user"></i> Welcome, <?php echo $user->name; ?>
            </a>
          </li>
          <li class="nav-item">
           <a href="profile.php" class="nav-link ">
                <i class="fas fa-user-circle"></i> Profile
              </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="fas fa-user-times"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-user"></i> Edit Profile</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="actions" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="index.php" class="btn btn-light btn-block">
            <i class="fas fa-arrow-left"></i> Back To Dashboard
          </a>
        </div>
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
        <div class="col-md-3">
          <button class="btn btn-success btn-block" data-toggle="modal" data-target="#changePassword">
            <i class="fas fa-lock"></i> Change Password
          </button>
        </div>
        <div class="col-md-3">
          <button href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteModal">
            <i class="fas fa-trash"></i> Delete Account
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- PROFILE -->
  <section id="profile">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
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
          <div class="card">
            <div class="card-header">
              <h4>Edit Profile</h4>
            </div>
            <div class="card-body">
              <form method="post">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" value="<?php echo $user->name; ?>">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" value="<?php echo $user->email; ?>">
                </div>
                <input type="submit" name="submit" value="Update Account" class="btn btn-primary">
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


  <!-- MODALS -->

  <!-- CHABGE PASSWORD MODAL -->
  <div class="modal fade" id="changePassword">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Change Password</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
          <form method="post">
            <div class="form-group">
              <label for="title">Old Password</label>
              <input type="password" name="old_pass" class="form-control">
            </div>
            <div class="form-group">
              <label for="title">New Password</label>
              <input type="password" name="new_pass" class="form-control">
            </div>
            <div class="form-group">
              <label for="title">Old Password</label>
              <input type="password" name="con_pass" class="form-control">
            </div>
            <div class="modal-footer">
          <input class="btn btn-primary" type="submit" name="change_pass" value="Change Password"> 
        </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>

  <!-- DELETE ACCOUNT -->
  <div class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Delete pop up</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <h4 class="lead">Are you sure you want to delete your account?</h4>
        </div>
        <div class="modal-footer">
         <?php echo '<a href="profile.php?delete='.$user_id.'" class="btn btn-danger">Yes</a> '; ?>
          <a href="profile.php" class="btn btn-success">No</a>
        </div>
      </div>
    </div>
  </div>

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

    CKEDITOR.replace('editor1');
  </script>
</body>

</html>