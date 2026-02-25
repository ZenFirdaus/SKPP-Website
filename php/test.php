<?php
require "koneksi.php";

$result = mysqli_query($conn, "SELECT * FROM user");

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['username'] . "<br>";
    echo $row['email'] . "<br>";
    echo $row['password'] . "<br>";
}


?>