<html>
    <head>
        <title>Zad. 1.11</title>
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
            $str = "The quick brown fox jumps over the lazy dog.";
//            $str = "Testowa, nieprawidłowa wartość.";
//            $str = 3;
            $str = preg_replace("'[^a-zA-Z]'", "", $str);
            $str = strtolower($str);

            $str_arr = str_split($str);
            sort($str_arr);

            $letters = 1;
            for ($i = 1; $i < count($str_arr); $i++) {
                if ($str_arr[$i] != $str_arr[$i - 1]) {
                    $letters++;
                }
            }

            $letters_alph = 26;
            $panagram = false;
            if ($letters == $letters_alph) {
                $panagram = true;
            }
            echo(var_export($panagram));
            ?>
        </p>
    </body>
</html>