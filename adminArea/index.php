<?php
include 'core/init.php';
$user_id = $_SESSION['id'];
$user = $getFromU->adminUserData($user_id);
 if ($getFromU->isUserLoggedIn() == false) {
   header('Location: login.php');
 }


    
    
?>





<?php
try{
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY cat_id ASC");
}catch(Exception $e){
    echo $e->message();
}
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<?php
try{
  $stmt = $pdo->query("SELECT * FROM orders ORDER BY order_id ASC LIMIT 10");
}catch(Exception $e){
  echo $e->message();
}

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php
$stmt = $pdo->query("SELECT count(cat_title) as counter FROM categories");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  extract($row);
  $counter = $row['counter'];
}
?>

<?php
$sql = "SELECT * FROM user_info";
$stmt =$pdo->query($sql);
$rowCount = $stmt->rowCount();
?>

<?php
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$count = $stmt->rowCount();
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
            <a href="index.php" class="nav-link active">Dashboard</a>
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
          <li class="nav-item px-2">
            <a href="services.php" class="nav-link active">service</a>
          </li>
        </ul>
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
            <i class="fas fa-cog"></i> Dashboard</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="actions" class="py-4 mb-4 bg-light">

    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#addPostModal">
            <i class="fas fa-plus"></i> Add Post
          </button>
        </div>
        <div class="col-md-3">
          <button class="btn btn-success btn-block" data-toggle="modal" data-target="#addCategoryModal">
            <i class="fas fa-plus"></i> Add Category
          </button>
        </div>
        <div class="col-md-3">
          <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#addUserModal">
            <i class="fas fa-plus"></i> Add Admin
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- POSTS -->
  <section id="posts">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
              <h4>Latest Orders</h4>
            </div>
            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>product id</th>
                  <th>transaction id</th>
                  <th>status</th>
                </tr>
              </thead>
              <?php
              foreach($orders as $order){
              echo '<tbody>
                <tr>
                  <td>' . $order['order_id'] . '</td>
                  <td>'. $order['product_id'] . '</td>
                  <td>' . $order['trx_id'] . '</td>
                  <td>' . $order['p_status'] . '</td>
                  <td>
                </tr>
              </tbody>';
              }
              ?>
            </table>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center bg-primary text-white mb-3">
            <div class="card-body">
              <h3>Posts</h3>
              <h4 class="display-4">
                <i class="fas fa-pencil-alt"></i> <?php echo $count; ?>
              </h4>
              <a href="posts.php" class="btn btn-outline-light btn-sm">View</a>
            </div>
          </div>

          <div class="card text-center bg-success text-white mb-3">
            <div class="card-body">
              <h3>Categories</h3>
              <h4 class="display-4">
                <i class="fas fa-folder"></i> <?php if (isset($counter)) echo $counter;
                                            else echo "0"; ?>
              </h4>
              <a href="categories.php" class="btn btn-outline-light btn-sm">View</a>
            </div>
          </div>

          <div class="card text-center bg-warning text-white mb-3">
            <div class="card-body">
              <h3>Users</h3>
              <h4 class="display-4">
                <i class="fas fa-users"></i> <?php echo $rowCount; ?>
              </h4>
              <a href="users.php" class="btn btn-outline-light btn-sm">View</a>
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

  <!-- ADD POST MODAL -->
 <?php
include_once("product_post.php");
?>

  <?php
  include_once("category.php");
  ?>
  <!-- ADD USER MODAL -->
  <?php
  include_once("addPost.php");
  ?>
 

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