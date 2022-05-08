<html>
    <head>
        <title>Zad. 1.8</title>
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
            $arr = array(1, 54, 0);

            foreach ($arr as $n) {
                if(!is_numeric($n)) {
                    exit("BŁĄD! Podana wartość (\"" . $n . "\") nie jest liczbą!");
                }
            }

            for ($i = 1; $i < count($arr); $i++) {
                for ($j = 0; $j < $i; $j++) {
                    $temp = $arr[$j];
                    if ($arr[$j] < $arr[$i]) {
                        $arr[$j] = $arr[$i];
                        $arr[$i] = $temp;
                    }
                }
            }

            echo("Liczby wyświetlone od najmniejszej do największej :<br>");
            for ($k = count($arr); $k > 0; $k--) {
                echo($arr[$k-1] . "<br>");
            }

            echo("Liczby wyświetlone od największej do najmniejszej:<br>");
            foreach ($arr as $n) {
                echo($n. "<br>");
            }
            //print_r($arr);
            ?>
        </p>
    </body>
</html>