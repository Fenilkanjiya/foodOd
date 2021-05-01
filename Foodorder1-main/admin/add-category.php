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
        ?>
      <form action="" method="POST">
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Category Title">
  </div>
  <br>
  <div class="form-group">
    <label>Featured</label>
    <input type="radio" class="form-control" id="featured" name="featured">yes
    <input type="radio" class="form-control" id="featured" name="featured">no
  </div>
  
  <br>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <br>
  
  <button type="submit" name="submit" class="btn btn-success">Add Admin</button>
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
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];
         $password = md5($_POST['password']); // incripted password with md5

         // SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
            ";

        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // check whether the (querybis executed) data is inserted or not and dispaly approriate message
        if($res==TRUE){
          $_SESSION['add']="<div class='text-success'>Admin Added Successfully</div>";
          header("location:".SITEURL.'manag-admin.php');
        }
        else
        {
            $_SESSION['add']="<div class='text-danger'>Failed to Add Admin</div>";
            header("location:".SITEURL.'add-admin.php');
        }
    }
   
?>