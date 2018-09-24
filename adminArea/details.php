<?php 
include 'core/init.php';
$user_id = $_SESSION['id'];
$user = $getFromU->adminUserData($user_id);
if ($getFromU->isUserLoggedIn() == false) {
  header('Location: index.php');
}


if (!empty($_GET['product'])) {
  $id = intval($_GET['product']);
}
try {
  $stmt = $pdo->prepare('SELECT * FROM products WHERE product_id = ?');
  $stmt->bindparam(1, $id);
  $stmt->execute();
} catch (Exception $e) {
  echo $e->getMessage();
  die();
}
$ps = $stmt->fetch(PDO::FETCH_ASSOC);


if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $stmt = $pdo->prepare('DELETE FROM products WHERE product_id = ?');
  $stmt->bindParam(1,$id);
  if ($stmt->execute()) {
    ?>
    <script>
    alert("record deleted successfully");
    window.location.href=('details.php');
    </script>
    <?php
  }else{
    ?>
    <script>
    alert("error occurred");
    window.location.href=('details.php');
    </script>
    <?php
  }
}



?>

<?php
if (isset($_POST['submit'])) {
 $title = $_POST['title'];
 $id = $_POST['id'];
 $category = $_POST['category'];
 $price = $_POST['price'];
  

 $sql = "UPDATE products SET product_title = '$title', category = '$category', product_price = $price WHERE product_id = $id";
 $stmt = $pdo->prepare($sql);
  $stmt->bindparam(":title", $title, PDO::PARAM_STR);
  $stmt->bindparam(":category", $category, PDO::PARAM_STR);
  $stmt->bindparam(":price", $price, PDO::PARAM_INT);
 

  if($stmt->execute())
    $msg = "Record Updated Successfully!";  
  else
    $msg =  "Error Occurs...Try again!";   
  header("location:posts.php?msg=".$msg);

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
            Post One</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="actions" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="#" class="btn btn-light btn-block">
            <i class="fas fa-arrow-left"></i> Back To Dashboard
          </a>
        </div>
        <div class="col-md-3">
        <?php
          echo '<a href="detai.php?update='.$ps["product_id"] .'" class="btn btn-success btn-block"   name="update">
            <i class="fas fa-check"></i> Save Changes
          </a>
        </div>';
        ?>
        <div class="col-md-3">
        <?php
          echo '<a href="details.php?delete='.$ps["product_id"] .'" class="btn btn-danger btn-block" type="submit" name="delete">
            <i class="fas fa-trash"></i> Delete Post
          </a>';
          ?>
        </div>
      </div>
    </div>
  </section>

  <!-- DETAILS -->
  <section id="details">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Edit Post</h4>
            </div>
            <div class="card-body">
              <form method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $ps['product_id'] ?>" />
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title"  value="<?php echo $ps['product_title'];?>">
                </div>
                <div class="form-group">
                  <label for="category">Category</label>
                  <input type="text" class="form-control" name="category" value="<?php echo $ps['category'];?>">
                </div>
                <div class="form-group">
                  <label for="category">Price</label>
                  <input type="text"  class="form-control" name="price" value="<?php echo $ps['product_price']; ?>">
                </div>
                <div class="form-group">
                  <label for="body">Body</label>
                  <textarea name="editor1" class="form-control">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat culpa nam cumque voluptatum. Possimus recusandae porro architecto officiis illo dignissimos ratione aut officia reprehenderit! Iure cum numquam fugit doloremque quis ullam illo odit, odio voluptates non quisquam laboriosam consectetur quasi perspiciatis! Sapiente minus aperiam nobis molestias autem ut praesentium laudantium?</textarea>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="update"/>
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


  <!-- MODALS -->

  <!-- ADD POST MODAL -->
  <div class="modal fade" id="addPostModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Add Post</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select class="form-control">
                <option value="">Web Development</option>
                <option value="">Tech Gadgets</option>
                <option value="">Business</option>
                <option value="">Health & Wellness</option>
              </select>
            </div>
            <div class="form-group">
              <label for="image">Upload Image</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image">
                <label for="image" class="custom-file-label">Choose File</label>
              </div>
              <small class="form-text text-muted">Max Size 3mb</small>
            </div>
            <div class="form-group">
              <label for="body">Body</label>
              <textarea name="editor1" class="form-control"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Save Changes</button>
        </div>
      </div>
    </div>
  </div>




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