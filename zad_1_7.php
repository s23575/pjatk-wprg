<html>
    <head>
        <title>Zad. 1.7</title>
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
            $a = 12;
            switch($a)
            {
                case 1:
                    echo("Styczeń, 31 dni");
                    break;
                case 2:
                    echo("Luty, 28 dni");
                    break;
                case 3:
                    echo("Marzec, 31 dni");
                    break;
                case 4:
                    echo("Kwiecień, 30 dni");
                    break;
                case 5:
                    echo("Maj, 31 dni");
                    break;
                case 6:
                    echo("Czerwiec, 30 dni");
                    break;
                case 7:
                    echo("Lipiec, 31 dni");
                    break;
                case 8:
                    echo("Sierpień, 31 dni");
                    break;
                case 9:
                    echo("Wrzesień, 30 dni");
                    break;
                case 10:
                    echo("Październik, 31 dni");
                    break;
                case 11:
                    echo("Listopad, 30 dni");
                    break;
                case 12:
                    echo("Grudzień, 31 dni");
                    break;
                default:
                    echo("BŁĄD");
                    break;
            }
            ?>
        </p>
    </body>
</html>