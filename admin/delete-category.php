<?php
include('../config/constants.php');
    // echo "dghdf";
    // check the id and image_name value is et or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // get the value and delete
        // echo "value delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // remove the fisial image file available 
        if($image_name != "")
        {
            // image available
            $path = "../images/category/".$image_name;
            // remove the image
            $remove = unlink($path);

                // if faild to remove then error message and stop remove
            if($remove==false)
            {
                // set the session message
                $_SESSION['remove'] = "<div class='text-danger'>Faild to remove category Image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'manage-category.php');
                // stop the process
                die();
            }
        }

        // delete data
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // execute query
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='text-success'>Category deleted successfully</div>";
            header('location:'.SITEURL.'manage-category.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='text-danger'>Failed to delete category</div>";
            header('location:'.SITEURL.'manage-category.php');
        }

      
    }
    else
    {
        // redirect to maange ctegory page
        header('location:'.SITEURL.'manage-category.php');
    }
?> 