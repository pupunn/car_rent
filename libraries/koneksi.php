<?php
    $host = "localhost"; //127.0.0.1
    $username = "root";
    $password = "1";
    $db = "mob_rent";

    $koneksi = mysqli_connect($host, $username, $password, $db);

    if($koneksi == false)
    {
        // gagal koneksi
        die("Error connecting to database ".mysqli_connect_error());
    }