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

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql2 = "SELECT * FROM  tbl_food WHERE id=$id";
        $res2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($res2);

        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    } else {
        header("location:" . SITEURL . 'manage-food.php');
    }

    ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>

            <br>
            <br>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $title; ?> ">
                </div>
                <br>
                <div class="form-group">
                    <label>Discription</label>
                    <!-- <textarea name="discription" placeholder="Discription"></textarea> -->
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
                </div>
                <br>
                <div class="form-group">
                    <label>Price:</label>
                    <input type="number" class="form-control" name="price" value="<?php echo $price ?>">
                </div>
                <br>

                <div class="form-group">
                    <label>Current Image : </label>
                    <?php
                    if ($current_image == "") {
                        echo "<div class='text-denger'>imge is not avelable</div>";
                    } else {

                    ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">

                    <?php

                    }
                    ?>
                </div>
                <br>
                <div class="form-group">
                    <label>Select New Image : </label>
                    <input type="file" name="image">
                </div>
                <br>
                <div class="form-group">
                    <label>Category:</label>
                    <select name="category">
                        <?php
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        if ($count > 0) {
                            //we have categorys
                            while ($row = mysqli_fetch_assoc($res)) {
                                $category_title = $row['title'];
                                $category_id = $row['id'];


                                // echo "<option value='$category_id'>$category_title</option>";
                        ?>
                                <option <?php if ($current_category == $category_id) {
                                            echo "Selected";
                                        } ?>value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                        <?php
                            }
                        } else {
                            //we do not have category

                            echo "<option value='0'>Category not avalable</option>";
                        }


                        ?>


                    </select>
                </div>
                <br>
                <br>
                <label>Featured :</label>
                <div class="form-check form-check-inline">

                    <input <?php if ($featured == "Yes") {
                                echo "checked";
                            } ?> type="radio" name="featured" id="featured" value="Yes">
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input <?php if ($featured == "No") {
                                echo "checked";
                            } ?> type="radio" name="featured" id="featured" value="No">
                    <label class="form-check-label">No</label>
                </div>
                <br>
                <br>
                <label>Active :</label>
                <div class="form-check form-check-inline">

                    <input <?php if ($active == "Yes") {
                                echo "checked";
                            } ?> type="radio" name="active" id="active" value="Yes">
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input <?php if ($active == "No") {
                                echo "checked";
                            } ?> type="radio" name="active" id="active" value="No">
                    <label class="form-check-label">No</label>
                </div>
                <br>
                <br>
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" name="submit" class="btn btn-success">Update Category</button>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];


                $featured = $_POST['featured'];
                $active = $_POST['active'];


                if (isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];

                    if ($image_name != "") {
                        $ext = end(explode('.', $image_name));

                        $image_name = "food_name_" . rand(000, 999) . '.' . $ext;
                        $source_path = $_FILES['image']['emp_image'];
                        $destination_path = "../images/food/" . $image_name;

                        $upload = move_uploaded_file($src_path, $dest_path);

                        if ($upload == true) {
                            $_SESSION['upload'] = "<div class='error'>File to upload to new image</div>";
                            header("location:" . SITEURL . 'manage-food.php');
                            die();
                        }

                        if ($current_image != "") {
                            $current_path = "../images/food/" . $current_image;

                            $remove = unlink($remove_path);

                            if ($remove == false) {
                                $_SESSION['remove-failed'] = "<div class='erroe'>faile to remove the current image</div>";
                                header('location:' . SITEURL . 'manage-food.php');
                                die();
                            }
                        }
                    } else {
                        $image_name = $current_image;
                    }
                } else {
                    $image_name = $current_image;
                }

                $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description ='$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured ='$featured',
                    active = '$active',

                    WHERE id=$id
                ";

                $res3 = mysqli_query($conn, $sql3);
                if ($res3 == true) {
                    $_SESSION['update'] = "<div class='success'>food updatted sucessfully.</div>";
                    header('location:' . SITEURL . 'manage-food.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>failed to food updatted .</div>";
                    header('location:' . SITEURL . 'manage-food.php');
                }
            }
            ?>
        </div>
    </div>
</body>

</html>
<?php include('partial/footer.php') ?>