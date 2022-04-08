<html>
    <head>
        <title>Zad. 1.5</title>
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
            $s = "testowe napisy";
            $sarr = explode(" ", $s);
            echo("%" . $sarr[0] . " " . $sarr[1] . "%$#");
//            echo("%");
//            for ($i = 0; $i < count($sarr); $i++) {
//                echo($sarr[$i]);
//                if ($i + 1 != count($sarr)) {
//                    echo(" ");
//                }
//            }
//            echo("%$#");
            ?>
        </p>
    </body>
</html>