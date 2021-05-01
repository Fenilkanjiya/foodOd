<?php
include('../config/constants.php');
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    // echo "process to delete";

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // 2. remove th image the avalable
    if ($image_name != "") {
        $path = "../images/food" . $image_name;
        $remove = unlink($path);

        if ($remove == true) {                     //erroe show to th true = false karvu
            $_SESSION['upload'] = "<div class='error' >Failed remove image file.</div>";
            header('location:' . SITEURL . 'manage-food.php');
            die();
        }
    }

    // 3. delete food frome the dataase

    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Food deleted sucessfully</div>";
        header('location:' . SITEURL . 'manage-food.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
        header('location:' . SITEURL . 'manage-food.php');
    }
} else {
    // echo "REDirect";
    $_SESSION['unauthorize'] = "<div class = 'error'>Unauthorized acess.</div>";
    header('location:' . SITEURL . 'manage-food.php');
}
