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
        <h1>Update Category</h1>

        <?php
            // check the id is or not
            if(isset($_GET['id']))
            {
                    // echo "gettingthe data";
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM tbl_category WHERE id=$id";

                    // execute the query
                    $res = mysqli_query($conn, $sql);

                    // count the rows to check the id is valid or not
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        $_SESSION['no-category-found'] = "<div class='text-danger'>Category Not Found.</div>";
                        header('location:'.SITEURL.'manage-category.php');
                    }
            }
            else
            {
                header('location:'.SITEURL.'manage-category.php');
            }
        ?>

      <form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
  </div>
  <br>
  <div class="form-group">
  <label >Current Image :</label> 
  <label> <?php 
                if($current_image != "")
                {
                    ?>
                    <img src="<?php echo SITEURL; ?>../images/category/<?php echo $current_image; ?>" width="70px" height="70px">

                    <?php
                }
                else
                {
                    echo "<div class='text-danger'>Image Not Added</div>";
                }
            ?>
  </label>
</div>
 <br>
  <div class="form-group">
    <label >New Image :</label>
    <input type="file" class="form-control-file" id="image" name="image">
  </div>
  <br>
  <label>Featured :</label>
  <div class="form-check form-check-inline">
  
  <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" id="featured" value="Yes">
  <label class="form-check-label" >Yes</label>
</div>
<div class="form-check form-check-inline">
  <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" id="featured" value="No">
  <label class="form-check-label" >No</label>
</div>
  <br>
<br>
<label>Active :</label>
  <div class="form-check form-check-inline">
  
  <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" id="active" value="Yes">
  <label class="form-check-label" >Yes</label>
</div>
<div class="form-check form-check-inline">
  <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" id="active" value="No">
  <label class="form-check-label" >No</label>
</div>
  <br>
  <br>
  <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <button type="submit" name="submit" class="btn btn-success">Update Category</button>
</form>
<?php
   //check the submit button click or not
   if(isset($_POST['submit']))
   {
       // echo "button clicked";
       //get all the value form update
      $id = $_POST['id'];
      $title = $_POST['title'];
      $current_image = $_POST['current_image'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];

      // updating new image
      // check the image selected or no 
      if(isset($_FILES['image']['name']))
      {
          //get the image details
          $image_name = $_FILES['image']['name'];

          // check image aailable or not
          if($image_name != "")
          {
              // image available
              // upload the new image

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
                header('location:'.SITEURL.'manage-category.php');

                // stop the process

                die();
              }
              // remove the current image if available
              if($current_image != "")
              {
                $remove_path = "../images/category/".$current_image;

                $remove = unlink($remove_path);
  
                // check the image is removed or not
                // if failed to remove then diaplay message and stop the process
                if($remove==false)
                {
                    $_SESSION['failed-remove'] = "<div class='text-danger'>Faild to remove current image.</div>";
                    header('location:'.SITEURL.'manage-category.php');
                    die(); // stop the process
                }
              }   
          }
          else
          {
              $image_name = $current_image;
          }
      }
      else
      {
          $image_name = $current_image;
      }

       // create query
       $sql2 = "UPDATE tbl_category SET
       title = '$title',
       image_name = '$image_name',
       featured = '$featured',
       active = '$active'
       WHERE id='$id'
       ";

       $res2 = mysqli_query($conn, $sql2);

       if($res2==true)
       {
           $_SESSION['update'] = "<div class='text-success'>Category updated successfully</div>";
           // redirect
           header('location:'.SITEURL.'manage-category.php');
       }
       else
       {
           $_SESSION['update'] = "<div class='text-danger'>Faild to update Category</div>";
           // redirect
           header('location:'.SITEURL.'manage-category.php');
       }
   }
?>
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

