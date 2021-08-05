<?php
    $db = mysqli_connect("localhost", "root", "A12345678");
    mysqli_select_db($db, "poll");

    $sql = "SELECT * FROM `poll`";
    $rows = mysqli_query($db, $sql);

    mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投票系統</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>名稱</th>
            <th>投票</th>
            <th>結果</th>
        </tr>
        <?php
        while($row = mysqli_fetch_row($rows)){
        ?>
        <tr>
            <td><?php echo $row[1]; ?></td>
            <td><a href="joinpoll.php?Pollid=<?php echo $row[0]; ?>">投票</a></td>
            <td><a href="viewpoll.php?Pollid=<?php echo $row[0]; ?>">結果</a></td>
        </tr>
        <?php
        }

        mysqli_free_result($rows);
        ?>
    </table>
</body>
</html>