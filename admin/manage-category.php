<?php include('partial/menu.php') ?>
<!-- <?php include('../config/constants.php'); ?> -->

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
  <div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1> 
      
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']); // remove sessioin message
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }
            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }
            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }
        ?>
          <br>
        <a href="add-category.php" class="btn btn-primary">Add Admin</a>
        <br/><br/><br/>
 <table class="tbl-full">
     <tr>
     <th>S.N</th>
        <th>Full Name</th>
        <th>User name</th>
        <th>Action</th>  
    </tr>
    <?php
        // query to get all admin
        $sql = 'SELECT * FROM tbl_admin';
        //Execute the query
        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $count = mysqli_num_rows($res);
            $sn=1;
            if($count>0)
            {
                while($rows=mysqli_fetch_assoc($res))
                {
                    // using while loop to get all the data from database
                    //and while loop will run as long as we have date in database

                    $id=$rows['id'];
                    $full_name=$rows['full_name'];
                    $username=$rows['username'];
                    ?>

                        <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                <a href="<?php echo SITEURL; ?>update-password.php?id=<?php echo $id; ?>" class="btn btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>update-admin.php?id=<?php echo $id; ?>" class="btn btn-success">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>delete-admin.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete Admin</a></td>
                            </tr>
                    <?php
                }
            }
            else
            {
                 // do not data have in database
            }
        }
    ?>
   
   
 </table>
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