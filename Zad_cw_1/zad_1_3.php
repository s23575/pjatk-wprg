<html>
    <head>
        <title>Zad. 1.3</title>
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
            $a = number_format(pi(), 2);
            echo("pi = " . $a . "<br>Pierwiastek : √ " . $a . " = " . number_format(sqrt($a), 2));
            ?>
        </p>
    </body>
</html>