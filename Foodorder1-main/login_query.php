<?php
session_start();

require_once 'conn.php';

if (isset($_POST['login'])) {
    if ($_POST['username'] != "" || $_POST['u_password'] != "") {
        $username = $_POST['username'];
        $u_password = $_POST['u_password'];
        $sql = "SELECT * FROM `member` WHERE `username`=? AND `u_password`=? ";
        $query = $conn->prepare($sql);
        $query->execute(array($username, $u_password));
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if ($row > 0) {
            $_SESSION['user'] = $fetch['username'];
            header("location: index.html");
        } else {
            echo "
				<script>alert('Invalid username or password')</script>
				<script>window.location = 'login.php'</script>
				";
        }
    } else {
        echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'login.php'</script>
			";
    }
}
