<html>
    <head>
        <title>Zad. 1.6</title>
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
            $a = 5;
            $b = 7;
            $c = 3;
            try {
                if (!is_numeric($a) || !is_numeric($b) || !is_numeric($b)) {
                    throw new Exception("\"a\", \"b\", lub \"c\" nie jest liczbą!");
                }
                if ($a <= 0 || $b <= 0 || $c <= 0) {
                    throw new Exception("\"a\", \"b\", lub \"c\" nie jest prawidłową wartością!");
                }
                if ($a + $b > $c && $a + $c > $b && $b + $c > $a) {
                    echo("Z podanych boków da się zbudować trójkąt");
                } else {
                    echo("Z podanych boków nie da się zbudować trójkąta");
                }
            } catch (Exception $e) {
                echo("BŁĄD! " . $e->getMessage());
            }
            ?>
        </p>
    </body>
</html>