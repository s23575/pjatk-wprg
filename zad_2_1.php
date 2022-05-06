<html>
    <head>
        <meta charset="UTF-8" />
        <title>Zad. 2.1</title>
<!-- Styl -->
        <style>
            body{
                background-color: white;
                font-family: Tahoma, Arial, sans-serif;
                font-size: 13px;
                margin: 13px;
                line-height: 165%;
            }
            fieldset{
                width: 20%;
                text-align: center;
                border: 1px solid grey;
            }
            legend{
                font-weight: bold;
                text-align: left;
                margin-left: 3.5%;
            }
            div{
                display: inline-block;
                text-align: left;
            }
            div.description{
                width: 91.5%;
            }
            div.label{
                width: 30%;
            }
            div.input{
                width: 60%;
            }
            div.submit{
                width: 45%;
            }
            div.reset{
                width: 45%;
                opacity: 50%;
            }
            div.result{
                width: 91.5%;
                text-align: center;
            }
            div.result b{
                color: red;
            }
            input{
                width: 100%;
                font-family: Tahoma, Arial, sans-serif;
                font-size: 13px;
            }
            select{
                width: 100%;
                font-family: Tahoma, Arial, sans-serif;
                font-size: 13px;
            }
        </style>
    </head>
    <body>
<!-- Formularz -->
        <form method="get">
            <fieldset>
                <legend>Kalkulator</legend>
                    <div class="description">Wpisz dowolne liczby, a następnie wybierz rodzaj działania:</div>
                    <p><div class="label"><label for="a">a: </label></div>
                    <div class="input"><input id="a" name="a" type="number" step="0.0000001" required></div></p>
                    <p><div class="label"><label for="b">b: </label></div>
                    <div class="input"><input id="b" name="b" type="number" step="0.0000001" required></div></p>
                    <p><div class="label"><label for="op">Działanie: </label></div>
                    <div class="input"><select id="op" name="op">
                        <option value="add">Dodawanie</option>
                        <option value="sub">Odejmowanie</option>
                        <option value="mul">Mnożenie</option>
                        <option value="div">Dzielenie</option>
                    </select></div></p>
                    <p>
                        <div class="submit"><input type="submit" value="Policz"></div>
                        <div class="reset"><input type="reset" value="Wyczyść"></div>
                    </p>
<!-- PHP -->
                <?php
                    if(count($_REQUEST) != 0) {
                        echo("<div class=\"description\"><b>Wynik:</b></div><br>");
                        echo("<div class=\"result\">");
                        switch($_REQUEST["op"])
                        {
                            case "add":
                                echo($_REQUEST["a"] . " + " . $_REQUEST["b"] . " =<br>
                                     <b> = " . $_REQUEST["a"] + $_REQUEST["b"] . "</b>");
                                break;
                            case "sub":
                                echo($_REQUEST["a"] . " - " . $_REQUEST["b"] . " =<br>
                                     <b> = " . $_REQUEST["a"] - $_REQUEST["b"] . "</b>");
                                break;
                            case "mul":
                                echo($_REQUEST["a"] . " * " . $_REQUEST["b"] . " =<br>
                                     <b> = " . $_REQUEST["a"] * $_REQUEST["b"] . "</b>");
                                break;
                            case "div":
                                if ($_REQUEST["b"] == 0) {
                                    echo("Wystąpił błąd!<br><b>Nie można dzielić przez 0</b>");
                                } else {
                                    echo($_REQUEST["a"] . " / " . $_REQUEST["b"] . " =<br>
                                         <b> = " . $_REQUEST["a"] / $_REQUEST["b"] . "</b>");
                                }
                                break;
                            default:
                                echo("Wystąpił błąd!<br><b>Spróbuj przeładować stronę</b>");
                                break;
                        }
                        echo("</div>");
                    }
                ?>
            </fieldset>
        </form>
    </body>
</html>