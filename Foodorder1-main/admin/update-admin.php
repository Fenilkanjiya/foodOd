<?php include('partial/menu.php') ?>
<!-- <?php include("../config/constants.php"); ?> -->

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
        <h1>update Admin</h1>
        <br>

        <?php

                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_admin WHERE id=$id";

                $res=mysqli_query($conn, $sql);

                // check whether the query id executed
                if($res==true)
                {
                    $count = mysqli_num_rows($res);
                    //admin data or not
                    if($count==1)
                    {
                        // echo "Admin Available";
                        $row=mysqli_fetch_assoc($res);
                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }
                    else{
                        //redirect to manage admin
                        header('location:'.SITEURL.'manag-admin.php');
                    }
                }
        ?>

        <form action="" method="POST">
  <div class="form-group">
    <label>Full Name</label>
    <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $full_name; ?>">
  </div>
  <br>
  <div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
  </div>
  <br>
 
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <button type="submit" name="submit" class="btn btn-success">Update Admin</button>
</form>
    </div>
</div>

<?php  
    //check the submit button click or not
    if(isset($_POST['submit']))
    {
        // echo "button clicked";
        //get all the value form update
       $id = $_POST['id'];
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];

        // create query
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id='$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['update'] = "<div class='text-success'>Admin updated successfully</div>";
            // redirect
            header('location:'.SITEURL.'manag-admin.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='text-danger'>Faild to update Admin</div>";
            // redirect
            header('location:'.SITEURL.'manag-admin.php');
        }
    }
?>
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