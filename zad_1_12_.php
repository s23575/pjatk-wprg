<html>
    <head>
        <title>Zad. 1.12</title>
        <style>
            body{
                background-color: white;
                font-family: Tahoma, Arial, sans-serif;
                font-size: 13px;
                margin: 13px;
                line-height: 165%;
            }
        </style>
    </head>
    <body>
        <p>
            <?php
            $a = 4;
            $b = 2;
            $arr = array();
            echo("Tablica A x B :<br>");
            for($i = 0; $i < $a; $i++) {
                for($j = 0; $j < $b; $j++) {
                    $arr[$i][$j] = rand(0,9);
                    echo($arr[$i][$j] . " ");
                }
                echo("<br>");
            }
            echo("Transpozycja – tablica B x A :<br>");
            for($i = 0; $i < $b; $i++) {
                for($j = 0; $j < $a; $j++) {
                    echo($arr[$j][$i] . " ");
                }
                echo("<br>");
            }
            ?>
        </p>
    </body>
</html>