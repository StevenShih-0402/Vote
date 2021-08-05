<?php
    $pollid = $_GET["Pollid"];

    $sql = "SELECT * FROM `poll` WHERE pollid='" . $pollid . "'";

    $db = mysqli_connect("localhost", "root", "A12345678");
    mysqli_select_db($db, "poll");
    
    $rows = mysqli_query($db, $sql);
    $num = mysqli_num_rows($rows);

    if($num > 0){
        $row = mysqli_fetch_array($rows);
        $pollname = $row["pollname"];
        $pollquestion = $row["pollquestion"];

        $total = 0;
        for($i = 0; $i < 3; $i++){
            $arraychoice[$i] = $row["choice".$i];
            $arrayresult[$i] = "";

            if(chop($arraychoice != "")){
                $sql = "SELECT COUNT(`pollanswer`) FROM `pollresult` WHERE pollid = '" . $pollid . "' AND pollanswer = " . ($i + 1);
                $rowsl = mysqli_query($db, $sql);

                if($choice = mysqli_fetch_row($rowsl)){
                    $arrayresult[$i] = $choice[0];
                    $total += $choice[0];
                }
            }
        }
    }
    mysqli_free_result($rows);
    mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>顯示投票結果</title>
</head>
<body>
    <?php
        function pie($vote1, $vote2, $vote3, $label1, $label2, $label3){
            $total = $vote1 + $vote2 + $vote3;

            $one = round(360 * $vote1 / $total);
            $two = round(360 * $vote2 / $total);

            $per1 = round($vote1 / $total * 100);
            $per2 = round($vote2 / $total * 100);
            $per3 = round($vote3 / $total * 100);

            echo "<span style='color:red'>$label1</span> = $vote1 票，佔$per1 %<br/>";
            echo "<span style='color:blue'>$label2</span> = $vote2 票，佔$per2 %<br/>";
            echo "<span style='color:green'>$label3</span> = $vote3 票，佔$per3 %<br/>";

            echo "<img src='showPie.php?one='" . $one . "&two=" . $two . "><br/>";
        }
    ?>

    <h1>票選名稱：<?php echo $pollname; ?><small> ─ 共<?php echo $total; ?>人投票</small></h1>
    <p>票選問題：<?php echo $pollquestion; ?></p>

    <?php
        pie($arrayresult[0], $arrayresult[1], $arrayresult[2], $arraychoice[0], $arraychoice[1], $arraychoice[2]);
    ?>
</body>
</html>