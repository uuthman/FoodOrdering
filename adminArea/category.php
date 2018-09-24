  <?php
    if (isset($_POST['submitCategory'])) {
        $category = $_POST['category'];
        $error = '';

        if (empty($category)) {
            $error = "field is empty";
        } else {
            $getFromU->create('categories', array('cat_title' => $category));
            ?>
            <script>
                alert("new category added successul");
                window.location.href=('index.php');
            </script>
        <?php

    }
}
  ?>
  <!-- ADD CATEGORY MODAL -->
  <div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Add Category</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <?php
        if (isset($error)) {
            echo '
            <div class=" bg-danger border rounded border-danger text-light text-center mb-5">
            <h5 class="mt-2">' . $error . '</h5>
            </div>
            ';
        }
        ?>
                        
        <div class="modal-body">
          <form method="post">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="category" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="submitCategory"  value="Save Changes" class="btn btn-success"/>
        </div>
      </div>
    </div>
    </form>
  </div>