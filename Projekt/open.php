<?php
include_once("func.php");
session_start();
unset($_REQUEST);

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
<form method="post" action="main.php">
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
                if (!isset($_SESSION['booking'])) {
                    echo('
                <div class="negative"><b>Wystapił błąd!</b> Wyloguj się i spróbuj jeszcze raz</div><p>
                    ');
                } else {
                    echo('
                <div class="label">
                    <label for="date_start">Data przyjazdu : </label><p>
                    <label for="date_end">Data wyjazdu : </label><p>
                    <label for="rooms_num">Liczba pokoi : </label>
                </div>
                <div class="input">    
                    ');
                    $db_query = "select * from bookings where id=" . $_SESSION['booking'];
                    $db_result = mysqli_query($db_link, $db_query);
                    $db_array = mysqli_fetch_row($db_result);
                    for ($i = 2; $i < count($db_array); $i++) {
                        echo('
                        <b>' . $db_array[$i] . '</b><p>
                    ');
                    }
                    echo('
                </div>
                    ');
                }
                ?>
            </fieldset>
        </div> <!-- column div -->

        <?php
        $db_query = "select * from rooms where id_booking=" . $_SESSION['booking'];
        $db_result = mysqli_query($db_link, $db_query);
        $i = 1;
        while ($db_array = mysqli_fetch_array($db_result, MYSQLI_ASSOC)) {
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
                    <label for="smoking">Osoby palące : </label>
                </div>
                <div class="input">
                    <b>' . $db_array['persons_num'] . '<p>
            ');
            if ($db_array['smoking'] == 1) {
                echo('Tak');
            } else {
                echo('Nie');
            }
            echo('
                    </b>
                </div>
            </fieldset>
        </div> <!-- column div -->
            ');
            $i++;
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
            <legend>Powrót do listy rezerwacji</legend>
            <p>
            <div class="primary"><input type="submit" name="return" value="Powrót"></div>
            <p>
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