<<?php

$host = "localhost";
$user = "root";
$password = "";
$databaseName = "bsis3b";

$connection = new mysqli($host, $user, $password, $databaseName);

$query = "SELECT * FROM students";
$result = mysqli_query($connection, $query);

$username = $_POST['username'];
$password = $_POST['password'];

while ($row = mysqli_fetch_array($result)) {

    if ($username == $row['username'] && $password == $row['password']) {
        echo "<script>alert('Correct')</script>";
        header('location: home.php');
    } else {
        echo "<script>alert('Incorrect')</script>";
    }
}
?>