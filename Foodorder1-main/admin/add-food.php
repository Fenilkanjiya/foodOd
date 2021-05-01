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
    <style>
        .card-body {
            width: 644px;
            height: 540px;


        }

        .card {
            width: 50%;
            margin-left: 320px;
            border-radius: 5px;

        }
    </style>
</head>

<body>
    <div class="container">
        <div class="wapper">



            <!-- <div class="card">
                <div class="shadow">
                    <div class="card-header"> -->
            <h1 style="text-align: center;">Add Food</h1>
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']); // remove session
            }
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']); // remove session
            }
            ?>
            <!-- </div> -->


            <!-- <div class="card-body"> -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title of the food">
                </div>
                <br>
                <div class="form-group">
                    <label>Discription</label>
                    <!-- <textarea name="discription" placeholder="Discription"></textarea> -->
                    <input type="text" class="form-control" name="description" placeholder="discription">
                </div>

                <br>
                <div class="form-group">
                    <label>Price:</label>
                    <input type="number" class="form-control" id="password" name="price">
                </div>
                <br>

                <div class="form-group">
                    <label>Select Image : </label>
                    <!-- <input type="file" name="image"> -->
                    <input type="file" class="form-control-file" id="image" name="image">
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
                                $id = $row['id'];
                                $title = $row['title'];

                        ?>
                                <option value="<?php echo $id ?>"><?php echo $title; ?></option>

                            <?php
                            }
                        } else {
                            //we do not have category
                            ?>
                            <option value="0">No Category Food</option>
                        <?php                                          }

                        ?>


                    </select>
                </div>


                <br>
                <label>Featured: </label>
                <div class="form-check form-check-inline">
                    <!-- <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> -->
                    <!-- <label class="form-check-label" for="inlineRadio1">Yes</label> -->
                    <input class="form-check-input" type="radio" name="featured" id="featured" value="Yes">
                    <label class="form-check-label">Yes</label>
                </div>

                <div class="form-check form-check-inline">
                    <!-- <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">No</label> -->
                    <input class="form-check-input" type="radio" name="featured" id="featured" value="No">
                    <label class="form-check-label">No</label>
                </div><br><br>

                <label>Active: </label>
                <div class="form-check form-check-inline">
                    <!-- <input class="form-check-input" type="radio" name="Active" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">Yes</label> -->

                    <input class="form-check-input" type="radio" name="active" id="active" value="Yes">
                    <label class="form-check-label">Yes</label>
                </div>

                <div class="form-check form-check-inline">
                    <!-- <input class="form-check-input" type="radio" name="Active" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">No</label> -->
                    <input class="form-check-input" type="radio" name="active" id="active" value="No">
                    <label class="form-check-label">No</label>
                </div><br><br>

                <button type="submit" name="submit" class="btn btn-success" style="margin-left: 504px;">Add Food</button>
            </form>


            <!-- </div> -->
            <!-- </div> -->
            <!-- </div> -->
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

<?php
if (isset($_POST['submit'])) {
    // echo "Clicked";$title = $_POST['title'];

    // 1. get the data from Form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    // redaio button for featrued  and active  are checked or not 
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "No";
    }
    // active 
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "No";
    }

    // 2. uploding to the image 
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        // chacke the image selected or not selected 
        if ($image_name != "") {
            $ext = end(explode('.', $image_name));
            // Create a new image name
            $image_name = "Food_Name_" . rand(000, 999) . "." . $ext;

            // B. uplode the image
            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/food/" . $image_name;
            // upload the food image
            $upload = move_uploaded_file($source_path, $destination_path);
            // chack uplode image or not
            if ($upload == false) {
                //  Add food withe error message
                $_SESSION['upload'] = "<div class='text-success' >Failed to uploade the image</div>";
                header('location:' . SITEURL . 'add-food.php');
                // stop the process
                die();
            }
        }
    } else {
        $image_name = ""; //Defaulet value
    }

    // 3 insert into database
    $sql2 = "INSERT INTO tbl_food SET
                            title = '$title',
                            description ='$description',
                            price = $price,
                            image_name ='$image_name',
                            category_id = '$category',
                            featured = '$featured',
                            active = '$active',
                            ";
    // Execute query
    $res2 = mysqli_query($conn, $sql2);
    if ($res2 == true) {
        $_SESSION['add'] = "<div class='text-success'>Admin Added Successfully</div>";
        header("location:" . SITEURL . 'manage-food.php');
    }
    // if ($res2 == true) {
    //     $_SESSION['add'] = "<div class='success'> Food Added Sucessfuly.</div>";
    //     header("location:" . SITEURL . 'manage-food.php');
    else {
        $_SESSION['add'] = "<div class='text-success'>Admin failed Successfully</div>";
        header("location:" . SITEURL . 'mansge-food.php');
    }
}

?>