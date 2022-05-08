<html>
    <head>
        <meta charset="UTF-8" />
        <title>Zad. 2.1</title>
<!-- Styl -->
        <link rel="stylesheet" href="zad_2_1.css">
    </head>
    <body>
<!-- Formularz -->
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<!-- "Action" według: https://www.w3schools.com/php/php_form_validation.asp -->
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