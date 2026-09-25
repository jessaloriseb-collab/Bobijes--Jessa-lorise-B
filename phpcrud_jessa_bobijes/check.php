<?php

session_start();

$Username = $_POST['Username'] ?? '';
$Password = $_POST['Password'] ?? '';

$username = trim($Username);
$password = trim($Password);

if ($username === "lorise" && $password === "123") {

    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;

    header("Location: index.php");
    exit();

} else {

    echo "
    <script>
        alert('Invalid username or password!');
        window.location.href='login.php';
    </script>
    ";

    exit();
}

?>