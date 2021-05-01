<?php
require_once 'conn.php';

if (isset($_POST['register'])) {
    if ($_POST['firstname'] != "" || $_POST['username'] != "" || $_POST['U_password'] != "") {
        try {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $u_password = $_POST['u_password'];
            $number = $_POST['number'];
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `member` VALUES ('', '$firstname', '$lastname', '$username', '$u_password', '$number')";
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        header('location:index.html');
    } else {
        echo "
				<script>alert('Please fill up the required field!')</script>
				<script>window.location = 'registration.php'</script>
			";
    }
}
