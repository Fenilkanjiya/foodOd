<?php include('partial/menu.php') ?>

<!-- Main content section start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashbord</h1>

        <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']); // remove sessioin message
                    }
                 ?>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            category
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            category
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            category
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            category
        </div>
    </div>


</div>
<!-- Main content section end -->

<?php include('partial/footer.php') ?>