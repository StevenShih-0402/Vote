<?php
    $pollid = $_GET["Pollid"];

    $db = mysqli_connect("localhost", "root", "A12345678");
    mysqli_select_db($db, "poll");

    $sql = "SELECT * FROM `poll` WHERE pollid = '". $pollid . "'";
    $rows = mysqli_query($db, $sql);

    mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>參加投票</title>
</head>
<body>
    <h3>
        <?php
            $row = mysqli_fetch_array($rows);
            echo $row["pollquestion"];
        ?>
    </h3>
    <hr>
    <form action="savepoll.php" method="post">
        <input type="hidden" name="Pollid" value="<?php echo $pollid; ?>"/>
        <table border="0">
            <?php
                for($i = 0; $i < 3; $i++){
                    $choice = $row["choice" . $i];
            ?>
                <tr>
                    <td><input type="radio" name="Choice" value="<?php echo ($i + 1);?>"/></td>
                    <td><?php echo $choice; ?></td>
                </tr>
            <?php
                }
                mysqli_free_result($rows);
            ?>
        </table>
        <br/>
        <input type="submit" value="送出投票"/>
    </form>  
</body>
</html>