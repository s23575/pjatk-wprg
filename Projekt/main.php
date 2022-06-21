<?php
include_once("func.php");
session_start();
if (isset($_REQUEST['auth_opt'])) {
    $_SESSION['email'] = $_REQUEST['email'];
    $_SESSION['pass'] = $_REQUEST['pass'];
}
?>

<html>
<head>
    <meta charset="UTF-8"/>
    <title>System rezerwacji pokoi hotelowych</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="row">
        <div class="column">
            <b>System rezerwacji pokoi hotelowych</b>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <fieldset>
                <legend>Dane użytkownika</legend>
                <div class="label">
                    <label for="name">Imię : </label><p>
                    <label for="surname">Nazwisko : </label><p>
                    <label for="email">Adres e-mail : </label><p>
                </div>
                <div class="input">
                <?php
                $step = 1;
                $db_link = db_connect();

                if(!isset($_REQUEST['auth_opt']) || $_REQUEST['auth_opt'] == 'login') {
                    $db_query = "select * from users where email='" . $_SESSION['email']
                        . "' and pass='" . $_SESSION['pass'] . "'";
                    if (mysqli_num_rows(mysqli_query($db_link, $db_query)) == 0) {
                        $error_msg = "Podano nieprawidłowy e-mail lub nieprawidłowe hasło. Podaj inne dane i spróbuj
                                     ponownie";
                        auth_error("Zaloguj", $error_msg);
                    } else {
                        $status = "<b>Dziękujemy!</b> Pomyślnie zalogowano użytkownika";
// session_destroy();
                    }
                } else {
                    $db_query = "select * from users where email='" . $_REQUEST['email'] ."'";
                    if (mysqli_num_rows(mysqli_query($db_link, $db_query)) == 1) {
                        $error_msg = "Użytkownik o podanym adresie e-mail już istnieje. Podaj innych adres i spróbuj
                                     ponownie";
                        auth_error("Zarejestruj", $error_msg);
                    } else {
                        $db_query = "insert into users(name, surname, email, pass) values ('" . $_REQUEST['name'] . "', '"
                            . $_REQUEST['surname'] . "', '" . $_REQUEST['email'] . "', '" . $_REQUEST['pass'] . "');";
                        mysqli_query($db_link, $db_query);
                        $status = "<b>Dziękujemy!</b> Pomyślnie zarejestrowano użytkownika";
// session_destroy();
                    }
                }
                $db_query = "select * from users where email='" . $_SESSION['email'] . "'";
                $db_result = mysqli_query($db_link, $db_query);
                $db_array = mysqli_fetch_array($db_result, MYSQLI_ASSOC);
                $db_keys = array_keys($db_array);
                $user_id = $db_array[$db_keys[0]];
                for ($i = 1; $i < count($db_keys)-1; $i++) {
                    echo('
                    <input name="' . $db_keys[$i] . '" type="hidden" value="' . $db_array[$db_keys[$i]] . '"><b>'
                        . $db_array[$db_keys[$i]] . '</b><p>
                    ');
                }
                $step++;
                ?>
                </div>
                <?php
                echo('
                <div class="positive">' . $status . '</div><p>
                ');
                ?>
            </fieldset>
        </div> <!-- column div -->

        <?php
        if ($step > 1) {
            echo('
            <div class="column">
                <fieldset>
                <legend>Dotychczasowe rezerwacje</legend>
            ');
            if (isset($_REQUEST['open']) && !isset($_REQUEST['booking'])) {
                echo('
                <div class="negative"><b>Wystapił błąd!</b> Nie wybrano rezerwacji do wyświetlenia</div><p>
                ');
            }
            $db_query = "select * from bookings where id_user=" . $user_id;
            $db_result = mysqli_query($db_link, $db_query);
            $db_num_rows = mysqli_num_rows($db_result);
            if ($db_num_rows == 0) {
                echo('
                <div class="neutral"><b>Brak rezerwacji</b> – nie znaleziono żadnych rezerwazji przypisanych do
                użytkownika</div><p>
                ');
            } else {
                if (isset($_REQUEST['open']) && isset($_REQUEST['booking'])) {
                    while ($db_array = mysqli_fetch_array($db_result, MYSQLI_ASSOC)) {
                        echo('
                <input class="radio" name="booking" type="hidden" id="yes" type="radio" value="' . $db_array['id'] . '"
                        ');
                        if ($_REQUEST['booking'] = $db_array['id']) {
                            echo(' checked');
                        }
                        echo('>');
                        if ($_REQUEST['booking'] = $db_array['id']) {
                            echo('<b>');
                        }
                        echo(
                            $db_array['date_start'] . ' – ' . $db_array['date_end']
                        );
                        if ($_REQUEST['booking'] = $db_array['id']) {
                            echo('</b>');
                        }
                    }
                    $step++;
                } else {
                    while ($db_array = mysqli_fetch_array($db_result, MYSQLI_ASSOC)) {
                        echo('
                <input class="radio" name="booking" id="yes" type="radio" value="' . $db_array['id'] . '">'
                            . $db_array['date_start'] . ' – ' . $db_array['date_end']
                        );
                    }
                }
            }
            echo('    
                </fieldset>    
            </div> <!-- column div -->
            ');
            if (isset($_REQUEST['new'])) {
                $step++;
            }
        }
        ?>

        <?php
        if ($step > 2) {
            echo('
            <div class="column">
                <fieldset>
                    <legend>Daty rezerwacji i liczba pokoi</legend>
                    <div class="label">
                        <label for="date_start">Data przyjazdu: </label><p>
                        <label for="date_end">Data wyjazdu: </label><p>
                        <label for="rooms_num">Liczba pokoi: </label>
                    </div>
                    <div class="input">
                ');
            if (isset($_REQUEST['open'])) {
                $db_query = "select * from bookings where id=" . $_REQUEST['booking'];
                $db_result = mysqli_query($db_link, $db_query);
                $db_array = mysqli_fetch_array($db_result, MYSQLI_ASSOC);
                $db_keys = array_keys($db_array);
                for ($i = 2; $i < count($db_keys); $i++) {
                    echo('
                        <input name="' . $db_keys[$i] . '" type="hidden" value="' . $db_array[$db_keys[$i]] . '"><b>'
                            . $db_array[$db_keys[$i]] . '</b><p>
                    ');
                }
                $step++;
                unset($_REQUEST['date_start']);
                unset($_REQUEST['date_end']);
                unset($_REQUEST['rooms_num']);
            }
            if (isset($_REQUEST['new'])) {
                if (isset($_REQUEST['date_start'])) {
                    echo('COOO');
                    if (valid_dates($_REQUEST['date_start'], $_REQUEST['date_end'])) {
                        echo('
                        <input name="date_start" type="hidden" value="' . $_REQUEST['arrival'] . '">
                        <input name="date_end" type="hidden" value="' . $_REQUEST['departure'] . '">
                        <input name="rooms_num" type="hidden" value="' . $_REQUEST['rooms'] . '">
                        <b>' . $_REQUEST['arrival'] . '<p>
                        ' . $_REQUEST['departure'] . '<p>
                        ' . $_REQUEST['rooms'] . '</b>
                        ');
                    } else {
                        echo('
                        <b>Podane daty są nieprawidłowe!</b> Data przyjazdu nie może być: (i) późniejsza lub taka sama
                        jak data wyjazdu; (ii) wcześniejsza niż data dzisiejsza (' . date("Y.m.d") . ').</div><p>
                        ');
                    }
                } else {
                    echo('
                        <input name="date_start" type="date" required><p>
                        <input name="date_end" type="date" required><p>
                        <input name="rooms_num" type="number" step="1" min="1" max="5" value="1" required>
                    ');
                }
            }
            echo('
                     </div>
                </fieldset>    
            </div> <!-- column div -->
            ');
        }
        ?>

    </div> <!-- row div -->

    <div class="row">
        <div class="column">
            <fieldset>
                <legend>Wyloguj</legend>
                <p>
                <div class="primary"><input type="submit" name="logout" value="Wyloguj"></div>
                <?php
                if (isset($_REQUEST['logout'])) {
                    logout();
                }

                ?>
                <p>
            </fieldset>
        </div>


        <?php
        if ($step > 1) {
            echo('
            <div class="column">
                <fieldset>
                <legend>Wybierz opcję</legend>
                <p>
                <div class="primary"><input type="submit" name="open" value="Wyświetl"
            ');
            if ($db_num_rows == 0) {
                echo('disabled');
            }
            echo('    
                ></div>&nbsp;&nbsp;
                <div class="primary"><input type="submit" name="new" value="Dodaj"
            ');
            if (isset($_REQUEST['new'])) {
                echo('disabled');
            }
            echo('
                ></div>
                <p>
                </fieldset>    
            </div> <!-- column div -->
            ');
        }
        ?>


    </div> <!-- row div -->

    <div class="row">
        <div class="column">
            <br><i>Maciej Zagórski, s23575, gr. 43c</i>
        </div>
    </div>

</form>
</body>
</html>

<?php
mysqli_close($db_link);
?>