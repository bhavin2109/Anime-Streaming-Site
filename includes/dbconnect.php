<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "anime_streaming_site";

    // Create connection
    $conn = mysqli_connect($server, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>