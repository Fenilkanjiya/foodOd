<!DOCTYPE html>
<html lang="en">

<head>
    <title>H F Restorant</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript">
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
    </script>
</head>

<body>
    <!-- <img src="../img/background.jpg" alt="" style= width:100%;> -->

    <div class="container mt-5">


        <div class="col-md-6" style="margin:0 auto">
            <div class="card shadow">
                <div class="card-header text-center"><b>Login</b></div>
                <div class="card-body">
                    <form action="login_query.php" method="POST" onsubmit="return validateForm();">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control " id="name" placeholder="Enter user ID" name="username">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control " id="password" placeholder="Enter password" name="u_password">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary form-control " name="login" type="submit" value="Submit">Login</button>
                        </div>

                    </form>

                </div>
                <div class="card-footer">
                    <a href="registration.php" class="float-right btn btn-primary">SignUp</a>
                </div>
            </div>
        </div>


    </div>

</body>

</html>