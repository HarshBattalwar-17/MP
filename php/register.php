<?php
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
        $email = $_POST['email'];
        $phoneNumber = $_POST['phone'];
        $pass = $_POST['password'];
        $checkQuery = "SELECT * FROM user WHERE username='$username' OR email='$email' OR phone='$phoneNumber'";
        $result = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($result) > 0) {
            echo "Username, email, or phone number is already taken. Please choose a different one.";
        } else {
            $insertQuery = "INSERT INTO user (email, username, phone, password) VALUES ('$email', '$username', '$phoneNumber', '$pass')";
            if (mysqli_query($conn, $insertQuery)) {
                echo "Registration successful!";
                header("location: ../html/Login.html");
            } else {
                echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
            }
        }
        mysqli_close($conn);
    }
?>
