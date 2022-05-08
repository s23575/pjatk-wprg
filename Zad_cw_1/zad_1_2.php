<html>
    <head>
        <title>Zad. 1.2</title>
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
            $b = 4;
//            $b = "a";
            if(!is_numeric($a) || !is_numeric($b)) {
                exit("BŁĄD! \"a\" lub \"b\" nie jest liczbą!");
            }
            echo("a = " . $a . "<br>b = " . $b . "<br>Pole prostokąta : " . $a . " * " . $b  . " = " . $a * $b);
            ?>
        </p>
    </body>
</html>
