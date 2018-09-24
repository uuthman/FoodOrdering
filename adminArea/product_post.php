<?php


if (isset($_POST['submit_post'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $cate = $_POST['category'];
    $decription = $_POST['editor1'];
    $keyword = $_POST['keyword'];
    $cat_id =$_POST['cat_id'];

    $images = $_FILES['avatar']['name'];
    $tmp_dir = $_FILES['avatar']['tmp_name'];
    $imageSize = $_FILES['avatar']['size'];
    

    $upload_dir = 'products/';
    $imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf');
    $picprofile = rand(1000, 1000000) . "." . $imgExt;
    move_uploaded_file($tmp_dir, $upload_dir . $picprofile);
    

    $stmt= $pdo->prepare("INSERT INTO products (product_title,product_price,category,product_image,product_desc,product_keywords,product_cat) VALUES (:product_name,:price,:cate,:avatar,:decription,:keyword,:cat_id)");
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':cate', $cate);
    $stmt->bindParam(':avatar', $picprofile);
    $stmt->bindParam(':decription', $decription);
    $stmt->bindParam(':keyword', $keyword);
    $stmt->bindParam(':cat_id', $cat_id);

    if ($stmt->execute() === true) {
        ?>
    <script>
    alert("record added successfully");
    window.location.href=('index.php');
    </script>

    <?php

} else {
    ?>
    <script>
    alert("error occurred");
    window.location.href=('index.php');
    </script>
   
    <?php

}
}
?>

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
          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">product name</label>
              <input type="text" name="product_name" class="form-control">
            </div>
            <div class="form-group">
              <label for="price">price</label>
              <input type="text" name="price" class="form-control">
            </div>
            <div class="form-group">
              <label for="price">Category ID</label>
              <input type="text" name="cat_id" class="form-control">
              <small class="form-text text-muted">please check the id of the category you want to pick from category page</small>
            </div>
            <div class="form-group">
              <label for="category_1">Category</label>
                <select name="category" class="form-control">
                <?php foreach ($categories as $cat) { ?>
                  <option value = <?php echo $cat["cat_title"]; ?> > <?php echo $cat["cat_title"] ?> </option>
              
             <?php 
        } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="image">Upload Image</label>
              <div class="custom-file">
                <input type="file" name="avatar" class="custom-file-input" id="image" required>
                <label for="image" class="custom-file-label">Choose File</label>
              </div>
              <small class="form-text text-muted">Max Size 3mb</small>
            </div>
            <div class="form-group">
              <label for="body">Keyword</label>
              <textarea name="keyword" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="body">Description</label>
              <textarea name="editor1"  class="form-control"></textarea>
            </div>
            
            <div class="modal-footer">
          <input class="btn btn-primary" type="submit" name="submit_post" value="SUBMIT" />
         </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>


