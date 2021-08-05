<?php
    $pollid = $_POST["Pollid"];
    $choice = $_POST["Choice"];

    if($choice != ""){
        $db = mysqli_connect("localhost", "root", "A12345678");
        mysqli_select_db($db, "poll");

        $sql = "INSERT INTO `pollresult` VALUES ('" . $pollid . "' , '" . $choice . "' , '" . $_SERVER["REMOTE_ADDR"] . "')";

        mysqli_query($db, $sql);
        mysqli_close($db);
    }

    header("Location: viewpoll.php?Pollid=" . $pollid);

?>