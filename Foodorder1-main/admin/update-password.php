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
        <h1>Change Password</h1>
        <br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label>Old Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Old Password">
            </div>
            <br>
            <div class="form-group">
            <label>New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
            </div>
            <br>
            <div class="form-group">
            <label>Conform Password</label>
                <input type="password" class="form-control" id="conform_password" name="conform_password" placeholder="Conform Password">
            </div>
            <br>
            
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" name="submit" class="btn btn-success">Change Password</button>
        </form>
    </div>
</div>

<?php

    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $current_password= md5($_POST['current_password']);
        $new_password= md5($_POST['new_password']);
        $conform_password= md5($_POST['conform_password']);

        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        $res=mysqli_query($conn, $sql);

        if($res==true)
        {
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                    // user exit
                    // echo "user found";
                    // check the new password and conform password match or noy
                    if($new_password==$conform_password)
                    {
                        // echo " ffkjdshfdskjf";
                        $sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id";

                        $res2 = mysqli_query($conn, $sql2);

                        if($res2==true)
                        {
                            $_SESSION['change-pwd'] =  "<div class='text-success'>Password change successfully</div>";
                            header('location:'.SITEURL.'manag-admin.php');
                        }
                        else
                        {
                            $_SESSION['change-pwd'] =  "<div class='text-danger'>Failed to Password change</div>";
                            header('location:'.SITEURL.'manag-admin.php');
                        }
                    }
                    else
                    {
                        $_SESSION['pwd-not-match'] = "<div class='text-danger'>Password not match</div>";
                         header('location:'.SITEURL.'manag-admin.php'); 
                    }
            }
            else
            {
                // user dose not exit
                $_SESSION['user-not-found'] = "<div class='text-danger'>User Not Found</div>";
                header('location:'.SITEURL.'manag-admin.php');
            }
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