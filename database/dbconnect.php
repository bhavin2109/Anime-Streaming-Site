<?php
    $server = "sql303.infinityfree.com";
    $username = "if0_39225999";
    $password = "bhavin2109";
    $database = "if0_39225999_anime_streaming_site";

    // Create connection
    $conn = mysqli_connect($server, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>