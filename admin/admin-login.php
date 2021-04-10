<?php include("../config/constants.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>H F Restorant</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

    <!-- <script type="text/javascript">
        function validateForm() {

            if (document.getElementById('name').value == "") {
                alert("Plese enter the name");
                return false;
            }

            if (document.getElementById('pwd').value == "") {
                alert("Plese enter the password");
                return false;
            }
        }
    </script> -->
</head>

<body>
    <!-- <img src="../img/background.jpg" alt="" style= width:100%;> -->

    <div class="container mt-5">


        <div class="col-md-6" style="margin:0 auto">
            <div class="card shadow">
                <div class="card-header text-center"><b>Login</b></div>
                <div class="card-body">

                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']); // remove sessioin message
                    }
                    if(isset( $_SESSION['no-login-message']))
                    {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }
                 ?>
                   <form action="" method="POST">
                        <div class="form-group">
                            <label>Username:</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter username" >
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary form-control " name="submit" type="submit" value="Login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    if(isset($_POST['submit']))
    {
       $username = $_POST['username'];
       $password = md5($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class='text-success'>Login successfull</div>";
            $_SESSION['user'] = $username;  //  authentication
            // redirect
            header('location:'.SITEURL.'index.php');
        }
        else
        {
            $_SESSION['login'] = "<div class='text-danger'>Username and Password did not match</div>";
            // redirect
            header('location:'.SITEURL.'admin-login.php');
        }
    }
?>