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
                unset ($_SESSION['add']); // remove session
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset ($_SESSION['remove']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
            }
            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset ($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset ($_SESSION['failed-remove']);
            }
          
        ?>
          <br>
        <a href="add-category.php" class="btn btn-primary">Add Admin</a>
        <br/><br/><br/>
 <table class="tbl-full">
     <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Image</th>
        <th>Feature</th>  
        <th>Active</th>  
        <th>Action</th>  
    </tr>
    <?php
        // query to get all admin
        $sql = 'SELECT * FROM tbl_category';
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
                    $title=$rows['title'];
                    $image_name=$rows['image_name'];
                    $featured=$rows['featured'];
                    $active=$rows['active'];

                    ?>

                        <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php 
                                        // check image
                                        if($image_name!=="")
                                        {
                                                ?>

                                                <img src="<?php echo SITEURL; ?>../images/category/<?php echo $image_name; ?>" width="70px" height="70px">

                                                <?php
                                        }
                                        else
                                        {
                                            // dispaly message
                                            echo "<div class='text-danger'>Image not added.</div>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                
                                <td>
                                <!-- <a href="<?php echo SITEURL; ?>update-password.php?id=<?php echo $id; ?>" class="btn btn-primary">Change Password</a> -->
                                <a href="<?php echo SITEURL; ?>update-category.php?id=<?php echo $id; ?>" class="btn btn-success">Update Category</a>
                                <a href="<?php echo SITEURL; ?>delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn btn-danger">Delete Category</a></td>
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