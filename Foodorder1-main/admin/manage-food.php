<?php include('partial/menu.php') ?>
<!-- Main content section start -->
<html>

<head>

    <style>
        .tbl-full {
            width: 100%;
        }

        .tbl-full tr th {
            border-bottom: 1px solid black;
            padding: 1%;
            text-align: left
        }

        table tr td {
            padding: 1%;
        }

        .btn-primary {
            background-color: #1e90ff;
            padding: 1%;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #3742fa
        }

        .btn-secondary {
            background-color: #7bed9f;
            padding: 1%;
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-secondary:hover {
            background-color: #2ed573
        }

        .btn-denger {
            background-color: #ff6b81;
            padding: 1%;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-denger:hover {
            background-color: #ff4757
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br />
            <!-- button to add admin -->
            <a href="<?php echo SITEURL; ?>add-food.php" class="btn-primary">Add Food</a>
            <br /><br /><br />
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']); // remove session
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }


            if (isset($_SESSION['unauthorize'])) {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }
            ?>


            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM tbl_food";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                                <?php if ($image_name == "") {
                                    echo "<div class='error'>Image is not add</div>";
                                } else {
                                ?>
                                    <img src="<?php echo SITEURL; ?>image/food<?php echo $image_name; ?>" width="100px">

                                <?php
                                }
                                ?>

                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>update-food.php?id=<?php echo $id; ?>" class="btn btn-primary">Update Food</a>
                                <a href="<?php echo SITEURL; ?>delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn btn-denger">Delete Food</a>

                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-danger'>Food noy added yet.</td></tr>";
                }
                ?>

            </table>
        </div>


    </div>

    <!-- Main content section end -->
    <?php include('partial/footer.php') ?>
</body>

</html>