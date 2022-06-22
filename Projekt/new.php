<?php
include_once("func.php");
session_start();

if (isset($_REQUEST['logout'])) {
    logout();
}
if (isset($_REQUEST['return'])) {
    unset($_REQUEST);
    header ("Location: main.php");
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
                    $db_query = "select * from users where email='" . $_SESSION['email'] . "'";
                    $db_result = mysqli_query($db_link, $db_query);
                    $db_array = mysqli_fetch_row($db_result);
                    $user_id = $db_array[0];
                    for ($i = 1; $i < count($db_array)-1; $i++) {
                        echo('
                    <b>' . $db_array[$i] . '</b><p>
                    ');
                    }
                    ?>
                </div>
            </fieldset>
        </div> <!-- column div -->

        <div class="column">
            <fieldset>
                <legend>Daty rezerwacji i liczba pokoi</legend>
        <?php
        $valid_dates = false;
        $step = 1;

        if (isset($_REQUEST['date_start'])) {
            if ($_REQUEST['date_start'] < $_REQUEST['date_end'] and $_REQUEST['date_start'] >= date("Y-m-d")) {
                $valid_dates = true;
                $step++;
            } else {
                echo('
                <div class="negative">
                    <b>Podane daty są nieprawidłowe!</b> Data przyjazdu nie może być: (i) późniejsza lub taka sama
                        jak data wyjazdu; (ii) wcześniejsza niż data dzisiejsza (' . date("Y-m-d") . ').
                </div><p>
            ');
            }
        }
        ?>
                <div class="label">
                    <label for="date_start">Data przyjazdu : </label><p>
                    <label for="date_end">Data wyjazdu : </label><p>
                    <label for="rooms_num">Liczba pokoi : </label>
                </div>
                <div class="input">
        <?php
        if ($valid_dates) {
            echo('
                    <input name="date_start" type="hidden" value="' . $_REQUEST['date_start'] . '">
                    <input name="date_end" type="hidden" value="' . $_REQUEST['date_end'] . '">
                    <input name="rooms_num" type="hidden" value="' . $_REQUEST['rooms_num'] . '">
                    <b>' . $_REQUEST['date_start'] . '<p>
                    ' . $_REQUEST['date_end'] . '<p>
                    ' . $_REQUEST['rooms_num'] . '</b>
            ');
        } else {
            echo('
                    <input name="date_start" type="date" value="' . date("Y-m-d") . '" required><p>
                    <input name="date_end" type="date" value="' . date("Y-m-d", strtotime("+1 days")) . '" required><p>
                    <input name="rooms_num" type="number" step="1" min="1" max="5" value="1" required>
           ');
        }
        ?>
                </div>
            </fieldset>
        </div> <!-- column div -->

        <?php
        if ($step > 1) {
            for ($i = 1; $i <= $_REQUEST['rooms_num']; $i++) {
                if ($i > 1 && $i % 2 == 1) {
                    echo('
    </div> <!-- row div -->
    <div class="row">
        <div class="column"></div>
        <div class="column"></div>
                    ');
                }
                echo('
        <div class="column">
            <fieldset>
                <legend>Szczegóły dotyczące pokoju nr ' . $i . '</legend>
                <div class="label">
                    <label for="persons_num">Liczba osób : </label><p>
                    <label for="smoking">Osoby palące : </label><p>
                ');
                if (!isset($_REQUEST['persons_num_' . $i])) {
                    echo('
                    <label>&nbsp;</label>
                    ');
                }
                echo('
                </div>
                <div class="input">
                ');
                if (isset($_REQUEST['persons_num_' . $i])) {
                    echo('
                        <input name="persons_num_' . $i . '" type="hidden" value="' . $_REQUEST['persons_num_' . $i] . '">
                        <input class="radio" name="smoking_' . $i . '" type="hidden" value="' . $_REQUEST['smoking_' . $i] . '">
                        <b>' . $_REQUEST['persons_num_' . $i] . '<p>
                        ' . $_REQUEST['smoking_' . $i] . '<p></b>
                    ');
                    if ($i == 1) {
                        $db_query = "insert into bookings (id_user, date_start, date_end, rooms_num) values ("
                            . $_SESSION['id_user'] . ", '" . $_REQUEST['date_start'] . "', '" . $_REQUEST['date_end']
                            . "', " . $_REQUEST['rooms_num'] . ");";
                        mysqli_query($db_link, $db_query);
                        $db_query = "select max(id) from bookings";
                        $db_result = mysqli_query($db_link, $db_query);
                        $db_array = mysqli_fetch_row($db_result);
                        $id_booking = $db_array[0];
                    }
                    if ($_REQUEST['smoking_' . $i] == "Tak") { $smoking = 1; } else { $smoking = 0; }
                    $db_query = "insert into rooms (id_booking, persons_num, smoking) values ("
                        . $id_booking . ", " . $_REQUEST['persons_num_' . $i] . ", " . $smoking . ");";
                    mysqli_query($db_link, $db_query);
                    $status = "<b>Dziękujemy!</b> Pomyślnie zapisano rezerwację";
                } else {
                    echo('
                        <input name="persons_num_' . $i . '" type="number" step="1" min="1" max="4" value="1" required><p>
                        <input class="radio" name="smoking_' . $i . '" id="yes" type="radio" value="Tak" required>Tak<p>
                        <input class="radio" name="smoking_' . $i . '" id="no" type="radio" value="Nie" checked required>Nie                        
                    ');
                }
                echo('
                </div>
                ');
                if ($i == $_REQUEST['rooms_num'] && isset($_REQUEST['persons_num_1'])) {
                    echo('
                <div class="positive"><b>Dziękujemy!</b> Pomyślnie zapisano rezerwację</div><p>
                    ');
                }
                echo('
            </fieldset>
        </div>
                ');
            }
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
        </div> <!-- column div -->

        <?php
        if ($step == 2) {
            echo('<div class="column"></div>');
        }
        ?>
        <div class="column">
            <fieldset>
                <?php
                if (isset($_REQUEST['persons_num_1'])) {
                    echo('
                <legend>Powrót do listy rezerwacji</legend>
                <p>
                <div class="primary"><input type="submit" name="return" value="Powrót"></div>
                <p>
                    ');
                } else {
                    echo('
                <legend>Wyślij i zapisz rezerwację</legend>
                <p>
                <div class="primary"><input type="submit" name="action" value="Wyślij"></div>&nbsp;&nbsp;
                <div class="secondary"><input type="reset" name="action" value="Wyczyść"></div>
                <p>
                    ');
                }
                ?>
            </fieldset>
        </div>

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