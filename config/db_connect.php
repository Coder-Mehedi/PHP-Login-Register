<?php
    //    connect to database
    $conn = mysqli_connect('localhost', 'mehedi', 'm3h3d1', 'demo1');
    //    check the connection

    if(!$conn) {
        echo 'Connection Error ' . mysqli_connect_error();
    }
