<?php
include_once("func.php");
session_start();

if (isset($_REQUEST['auth_opt'])) {
    $_SESSION['email'] = $_REQUEST['email'];
    $_SESSION['pass'] = $_REQUEST['pass'];
}

if (isset($_REQUEST['logout'])) {
    logout();
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
                $db_link = db_connect();

                if (isset($_REQUEST['auth_opt']) && $_REQUEST['auth_opt'] == 'login') {
                    $db_query = "select * from users where email='" . $_SESSION['email']
                        . "' and pass='" . $_SESSION['pass'] . "'";
                    if (mysqli_num_rows(mysqli_query($db_link, $db_query)) == 0) {
                        $error_msg = "Podano nieprawidłowy e-mail lub nieprawidłowe hasło. Podaj inne dane i spróbuj
                                     ponownie";
                        auth_error("Zaloguj", $error_msg);
                    } else {
                        $status = "<b>Dziękujemy!</b> Pomyślnie zalogowano użytkownika";
                    }
                } elseif (isset($_REQUEST['auth_opt']) && $_REQUEST['auth_opt'] == 'register') {
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
                    }
                }
                $db_query = "select * from users where email='" . $_SESSION['email'] . "'";
                $db_result = mysqli_query($db_link, $db_query);
                $db_array = mysqli_fetch_row($db_result);
                $_SESSION['id_user'] = $db_array[0];
                for ($i = 1; $i < count($db_array)-1; $i++) {
                    echo('
                    <b>'
                        . $db_array[$i] . '</b><p>
                    ');
                }
                ?>
                </div>
                <?php
                if (isset($_REQUEST['auth_opt'])) {
                    echo('
                <div class="positive">' . $status . '</div><p>
                    ');
                }
                ?>
            </fieldset>
        </div> <!-- column div -->

        <div class="column">
            <fieldset>
            <legend>Dotychczasowe rezerwacje</legend>
        <?php
            if (isset($_REQUEST['open']) && !isset($_REQUEST['booking'])) {
                echo('
            <div class="negative"><b>Wystapił błąd!</b> Nie wybrano rezerwacji do wyświetlenia</div><p>
                ');
            }
            $db_query = "select * from bookings where id_user=" . $_SESSION['id_user'];
            $db_result = mysqli_query($db_link, $db_query);
            $db_num_rows = mysqli_num_rows($db_result);
            if ($db_num_rows == 0) {
                echo('
            <div class="neutral"><b>Brak rezerwacji</b> – nie znaleziono żadnych rezerwazji przypisanych do
            użytkownika</div><p>
                ');
            } else {
                if (isset($_REQUEST['open']) && isset($_REQUEST['booking'])) {
                    $_SESSION['booking'] = $_REQUEST['booking'];
                    header('Location: open.php');
                } else {
                    while ($db_array = mysqli_fetch_array($db_result, MYSQLI_ASSOC)) {
                        echo('
                <div class="input">
                    <input class="radio" name="booking" id="yes" type="radio" value="' . $db_array['id'] . '">'
                            . $db_array['date_start'] . ' – ' . $db_array['date_end'] . ' : <p>
                </div>
                        ');
                        echo('
                <div class="label"><b>' . $db_array['rooms_num']
                        );
                        if ($db_array['rooms_num'] == 1) {
                            echo(' pokój');
                        } elseif ($db_array['rooms_num'] < 5) {
                            echo(' pokoje');
                        } else {
                            echo(' pokoi');
                        }
                        echo('
                </b></div>
                        ');
                    }
                }
            }
            echo('    
                </fieldset>    
            </div> <!-- column div -->
            ');
            if (isset($_REQUEST['new'])) {
                header('Location: new.php');
        }
        ?>

    </div> <!-- row div -->

    <div class="row">

        <div class="column">
            <fieldset>
                <legend>Wyloguj</legend>
                <p>
                <div class="primary"><input type="submit" name="logout" value="Wyloguj"></div>
                <p>
            </fieldset>
        </div>

        <div class="column">
            <fieldset>
                <legend>Wybierz opcję</legend>
                <p>
                <?php
                echo('
                <div class="primary"><input type="submit" name="open" value="Wyświetl"
                ');
                if ($db_num_rows == 0) {
                    echo('disabled');
                }
                echo('    
                ></div>&nbsp;&nbsp;
                ');
                ?>
                <div class="primary"><input type="submit" name="new" value="Dodaj"></div><p>
                </fieldset>
            </div> <!-- column div -->

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