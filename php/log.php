<?php
    session_start();
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "data";
    $conn = mysqli_connect($hostname, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;
            header("location: ../html/Courses.html");
        } else {
            echo "Invalid username or password. Please try again.";
        }
        mysqli_close($conn);
    }
?>