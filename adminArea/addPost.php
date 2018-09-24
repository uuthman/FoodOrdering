<?php



if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirm_password = $_POST['confirm_password'];
    $error="";
    

    if (empty($name) or empty($email) or empty($password) or empty($confirm_password)) {
        $error = "all fields are required";
    }  else {
                $stmt = $pdo ->prepare("INSERT INTO admin(name,email,password) VALUES (:name, :email, :password)");
                $stmt->bindParam(':name',$name);
                $stmt->bindParam(':email',$email);
                $stmt->bindParam(':password',$password);
                if ($stmt->execute()) {
                  ?>
                        <script>
                            alert("New Admin Access");
                            window.location.href=('index.php');
                        </script>
                    <?php

                  } else {
                    ?>
                        <script>
                            alert("Error");
                            window.location.href=('index.php');
                        </script>
                    <?php

                  }
            }
          }

    
?>
<div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Add user</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
          <form method="post">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
              <label for="password2">Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control">
            </div>
             <div class="modal-footer">
          <input class="btn btn-warning" value="Save Changes" type="submit" name="signup"/>
        </div>
          </form>
        </div>
       
      </div>
    </div>
  </div>