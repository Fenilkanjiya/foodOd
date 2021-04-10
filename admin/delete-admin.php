<?php
include("../config/constants.php");

    // $id = $_GET['id'];
    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    // chehk whare the query execute successfully
    if($res==TRUE){
        // echo "admin deleted";
        $_SESSION['delete'] = "<div class='text-success'>Admin Deleted Successfully</div>";
        header('location:'.SITEURL.'manag-admin.php');
    }
    else
    {
        // echo "faild to delete admin";
        $_SESSION['delete'] = "<div class='text-danger'>Faild to delete admin. Try Again later.</div>";
        header('location:'.SITEURL.'manag-admin.php');
    }
?>