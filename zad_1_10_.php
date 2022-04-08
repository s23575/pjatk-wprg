<html>
    <head>
        <title>Zad. 1.10</title>
        <style>
            body{
                background-color: white;
                font-family: monospace, Tahoma, Arial, sans-serif;
                font-size: 13px;
                margin: 13px;
                line-height: 165%;
            }
        </style>
    </head>
    <body>
        <p>
            <?php
            $a = 2;
            if(!is_numeric($a) || $a < 1) {
                exit("BŁĄD! \"a\" nie jest prawidłową wartością!");
            }

            $str1 = "";

            for($i = 0; $i < $a; $i++) {
                $str1 = $str1 . "*";
                echo($str1 . "<br>");
            }

            for($j = 0; $j < $a; $j++) {
                echo(substr($str1, $j) . "<br>");
            }

            for($k = 0; $k < $a; $k++) {
                echo(str_repeat("&nbsp;", 1 * $k));
                echo(substr($str1, $k) . "<br>");
            }

            for($l = $a; $l > 0; $l--) {
                echo(str_repeat("&nbsp;", $l - 1));
                echo(substr($str1, $l - 1) . "<br>");
            }
            ?>
        </p>
    </body>
</html>