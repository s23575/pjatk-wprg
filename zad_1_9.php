<html>
    <head>
        <title>Zad. 1.9</title>
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
        $A = array(1, 4, 5);
        $B = array(2, 4, 3);

        try {
            foreach ($A as $n) {
                if (!is_numeric($n)) {
                    throw new Exception();
                }
            }
            foreach ($B as $n) {
                if (!is_numeric($n)) {
                    throw new Exception();
                }
            }
            if (count($A) != count($B)) {
                echo("BŁĄD");
            } else {
                $sum = 0;
                for ($i = 0; $i < count($A); $i++) {
                    $sum += $A[$i] * $B[$i];

                    echo("( " . $A[$i] . " * " . $B[$i] . " )");
                    if ($i + 1 != count($A)) {
                        echo(" + ");
                    }

                }
                echo(" = " . $sum);
            }
        } catch (Exception $e) {
            exit("BŁĄD");
        }
        ?>
        </p>
    </body>
</html>