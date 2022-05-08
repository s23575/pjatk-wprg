<html>
    <head>
        <meta charset="UTF-8" />
        <title>Zad. 2.2</title>
        <link rel="stylesheet" href="zad_2_2.css">
    </head>
    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<!-- "Action" według: https://www.w3schools.com/php/php_form_validation.asp -->
        <div class="row">

<!-- Step 0: dates -->
            <div class="column">
                <b>Formularz rezerwacji pokoi hotelowych</b><p>
                <fieldset>
                    <legend>Daty rezerwacji i liczba pokoi</legend><p>
<?php
    $valid_dates = false;
    $step = 0;

    if (isset($_REQUEST['arrival'])) {
        if ($_REQUEST['arrival'] < $_REQUEST['departure'] and $_REQUEST['arrival'] >= date("Y-m-d")) {
            $valid_dates = true;
            $step++;
        } else {
            echo('
                    <div class="result"><b>Podane daty są nieprawidłowe!</b><br>Data przyjazdu nie może być:<br>(i) późniejsza lub taka sama jak data wyjazdu;<br>(ii) wcześniejsza niż data dzisiejsza (' . date("d.m.Y") . ').</div><p>
            ');
        }
    }
?>
                    <div class="label">
                        <label for="arrival">Data przyjazdu: </label><p>
                        <label for="departure">Data wyjazdu: </label><p>
                        <label for="a">Liczba pokoi: </label>
                    </div>
                    <div class="input">
<?php
    if ($valid_dates) {
        echo('
                        <input name="arrival" type="hidden" value="' . $_REQUEST['arrival'] . '">
                        <input name="departure" type="hidden" value="' . $_REQUEST['departure'] . '">
                        <input name="rooms" type="hidden" value="' . $_REQUEST['rooms'] . '">
                        <b>' . $_REQUEST['arrival'] . '<p>
                        ' . $_REQUEST['departure'] . '<p>
                        ' . $_REQUEST['rooms'] . '</b>
        ');
    } else {
        echo('
                        <input name="arrival" type="date" required><p>
                        <input name="departure" type="date" required><p>
                        <input name="rooms" type="number" step="1" min="1" max="5" value="1" required>
        ');
    }
?>
                    </div>
                </fieldset>
            </div>

<!-- Step 1: rooms -->
<?php
    if ($step > 0) {
        echo('<div class="column">&nbsp;<p>');

        for ($i = 0; $i < $_REQUEST['rooms']; $i++) {
            echo('
                <fieldset>
                    <legend>Szczegóły dotyczące pokoju nr ' . $i + 1 . '</legend><p>
                    <div class="label">
                        <label for="capacity">Liczba osób: </label><p>
                        <label for="smoking">Osoby palące: </label>
                    </div>
                    <div class="input">
            ');

            if (isset($_REQUEST['capacity' . $i])) {
                echo('
                        <input name="capacity' . $i . '" type="hidden" value="' . $_REQUEST['capacity' . $i] . '">
                        <input class="radio" name="smoking' . $i . '" type="hidden" value="' . $_REQUEST['smoking' . $i] . '">
                        <b>' . $_REQUEST['capacity' . $i] . '<p>
                        ' . $_REQUEST['smoking' . $i] . '</b>
                ');
                if($i == 0) { $step++; }
            } else {
                echo('
                        <input name="capacity' . $i . '" type="number" step="1" min="1" max="4" value="1" required><p>
                        <input class="radio" name="smoking' . $i . '" id="yes" type="radio" value="Tak" required>Tak
                        <input class="radio" name="smoking' . $i . '" id="no" type="radio" value="Nie" checked required>Nie                        
                ');
            }
            echo('
                    </div>
                </fieldset><p>
            ');
        }

        echo('</div>');
    }
?>

<!-- Step 2: requests -->
<?php
    if ($step > 1) {
        echo('
            <div class="column">&nbsp;<p>
                <fieldset>
                    <legend>Uwagi i życzenia dodatkowe</legend>
        ');

        if (isset($_REQUEST['requests'])) {
            echo('
                <input name="requests" type="hidden" value="' . $_REQUEST['requests'] . '">
                <div class="textarea"><b>' . $_REQUEST['requests'] . '</b></div><p>
            ');
            $step++;
        } else {
            echo('
                <textarea name="requests" rows="5">Prosimy o wpisanie życzeń dodatkowych, np. potrzeby rezerwacji miejsc parkingowych...</textarea><p>
            ');
        }

        echo('
                </fieldset>
            </div>
        ');
    }
?>

<!-- Step 3: contact -->
<?php
    if ($step > 2) {
        echo('
            <div class="column">&nbsp;<p>
                <fieldset>
                    <legend>Dane kontaktowe</legend><p>
                    <div class="label">
                        <label for="name">Imię: </label><p>
                        <label for="surname">Nazwisko: </label><p>
                        <label for="e-mail">Adres e-mail: </label><p>
                        <label for="e-mail">Numer telefonu: </label>
                    </div>
                    <div class="input">
        ');

        if (isset($_REQUEST['name'])) {
            echo('
                        <input name="name" type="hidden" value="' . $_REQUEST['name'] . '">
                        <input name="surname" type="hidden" value="' . $_REQUEST['surname'] . '">
                        <input name="email" type="hidden" value="' . $_REQUEST['email'] . '">
                        <input name="mobile" type="hidden" value="' . $_REQUEST['mobile'] . '">
                        <b>' . $_REQUEST['name'] . '<p>
                        ' . $_REQUEST['surname'] . '<p>
                        <a href="mailto:' . $_REQUEST['email'] . '">' . $_REQUEST['email'] . '</a><p>
                        ' . $_REQUEST['mobile'] . '</b>
                    ');
        } else {
            echo('
                        <input name="name" value="Aleksander" required><p>
                        <input name="surname" value="Macedoński" required><p>
                        <input name="email" type="email" value="przykladowy@email.com.pl" required><p>
                        <input name="mobile" pattern="+[0-9]{2} [0-9]{3} [0-9]{3} [0-9]{3}" value="+48 123 456 789" title="+48 123 456 789" required><p>
            ');
        }

        echo('
                </fieldset>
            </div>
        ');
    }
?>
        </div>
        <div class="row">

<!-- Send / reset -->
<?php
    for ($i = 0; $i < $step; $i++) {
        echo('<div class="column"></div>');
    }
?>
            <div class="column">
                <fieldset>
                    <legend>Wyślij formularz</legend><p>
<?php
    if (isset($_REQUEST['name'])) {
        echo('
                    <div class="result"><b>Twoja rezerwacja została wysłana.</b><br>Dziękujemy za wypełnienie formularza!</div><p>
        ');
    } else {
        echo('
                    <div class="submit"><input type="submit" value="Wyślij"></div>
                    <div class="reset"><input type="reset" value="Wyczyść"></div><p>
        ');
    }
?>
                </fieldset>
            </div>
        </div>
        </form>
    </body>
</html>