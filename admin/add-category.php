<?php include('partial/menu.php') ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="../css/manage-admin.css" rel="stylesheet" type="text/css">

    <title>Hello, world!</title>
  </head>
  <body>
<div class="container">
    <div class="wapper">
        <h1>Add Category</h1>

        <?php
          if(isset($_SESSION['add']))
          {
              echo $_SESSION['add'];
              unset ($_SESSION['add']); // remove session
          }
          if(isset($_SESSION['upload']))
          {
              echo $_SESSION['upload'];
              unset ($_SESSION['upload']); 
          }
        ?>
      <form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Category Title">
  </div>
  <br>
  <div class="form-group">
    <label >Select Image</label>
    <input type="file" class="form-control-file" id="image" name="image">
  </div>
  <br>
  <label>Featured :</label>
  <div class="form-check form-check-inline">
  
  <input class="form-check-input" type="radio" name="featured" id="featured" value="Yes">
  <label class="form-check-label" >Yes</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="featured" id="featured" value="No">
  <label class="form-check-label" >No</label>
</div>
  <br>
<br>
<label>Active :</label>
  <div class="form-check form-check-inline">
  
  <input class="form-check-input" type="radio" name="active" id="active" value="Yes">
  <label class="form-check-label" >Yes</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="active" id="active" value="No">
  <label class="form-check-label" >No</label>
</div>
  <br>
  <br>
  <button type="submit" name="submit" class="btn btn-success">Add Category</button>
</form>
    </div>
</div>
   <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>

<?php include('partial/footer.php') ?>

<?php
    // process the value from form and save it in database
    // check whether the button is clicked or not

    if(isset($_POST['submit']))
    {
         $title = $_POST['title'];

         if(isset($_POST['featured']))
         {
          $featured = $_POST['featured'];
         }
         else
         {
            $featured = "No";
         }
      
         if(isset($_POST['active']))
         {
            $active = $_POST['active'];
         }
         else
         {
            $active = "No";
         }
          // check image is selected ro not and sit the value for image name
          // print_r($_FILES['image']);

          // die(); // breack cosw here

          if(isset($_FILES['image']['name']))
          {
            // upload image
              // to upload image name, source, destiantion path
              $image_name = $_FILES['image']['name'];
              // upload the image
              if($image_name != "")
              {

              // auto rename image
              // get the extension our image (jpg, png)
              $ext = end(explode('.',$image_name));

              // rename the image
              $image_name = "Food_Category_".rand(000, 999).'.'.$ext;  // ee.g. food_category_


              $source_path = $_FILES['image']['tmp_name'];
              $destination_path = "../images/category/".$image_name;

              // upload image
              $upload = move_uploaded_file($source_path, $destination_path);

              // check image uploaded or not
              // if the image is not upload then eill stop the redirec with error message
              if($upload==false)
              {
                $_SESSION['upload'] = "<div class='text-success'>Faild to upload image.</div>";
                header('location:'.SITEURL.'add-category.php');

                // stop the process

                die();
              }
            }
          }
          else
          {
            // don't upload image and save
            $image_name="";
          }
         // create sql query to insert into database

         $sql = "INSERT INTO tbl_category SET
         title='$title',
         image_name='$image_name',
         featured='$featured',
         active='$active'
         ";

         // execute query
         $res = mysqli_query($conn, $sql);

         // check the query executed or not data added

         if($res==true)
         {
           // executed
           $_SESSION['add'] = "<div class='text-success'>Category Added successfully</div>";
           header('location:'.SITEURL.'manage-category.php');
         }
         else
         {
          $_SESSION['add'] = "<div class='text-danger'>Faild to Add category</div>";
          header('location:'.SITEURL.'add-category.php');
         }
    }
   
?>