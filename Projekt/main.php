<?php
include_once("func.php");

session_start();
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
                if($_REQUEST['auth_opt'] == 'login') {
                    $db_query = "select * from users where email='" . $_REQUEST['email']
                        . "' and pass='" . $_REQUEST['pass'] . "'";
                    if (mysqli_num_rows(mysqli_query($db_link, $db_query)) == 0) {
                        $error_msg = "<b>Wystąpił błąd!</b><br>Podano nieprawidłowy e-mail lub nieprawidłowe hasło.<br>
                                     Podaj inne dane i spróbuj ponownie";
                        auth_error("Zaloguj", $error_msg);
                    }
                } elseif ($_REQUEST['auth_opt'] == 'register') {
                    $db_query = "select * from users where email='" . $_REQUEST['email'] ."'";
                    if (mysqli_num_rows(mysqli_query($db_link, $db_query)) == 1) {
                        $error_msg = "<b>Wystąpił błąd!</b><br>Użytkownik o podanym adresie e-mail już istnieje.<br>
                                      Podaj innych adres i spróbuj ponownie";
                        auth_error("Zarejestruj", $error_msg);
                    } else {
                        $db_query = "insert into users(name, surname, email, pass) values ('" . $_REQUEST['name'] . "', '"
                            . $_REQUEST['surname'] . "', '" . $_REQUEST['email'] . "', '" . $_REQUEST['pass'] . "');";
                        mysqli_query($db_link, $db_query);
                    }
                }
                $db_query = "select * from users where email='" . $_REQUEST['email'] . "'";
                $db_result = mysqli_query($db_link, $db_query);
                $db_array = mysqli_fetch_array($db_result, MYSQLI_ASSOC);
                $db_keys = array_keys($db_array);
                for ($i = 1; $i < count($db_keys)-1; $i++) {
                    echo('
                    <input name="' . $db_keys[$i] . '" type="hidden" value="' . $db_array[$db_keys[$i]] . '"><b>'
                        . $db_array[$db_keys[$i]] . '</b><p>
                    ');
                }
                mysqli_close($db_link);
                ?>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <i>Maciej Zagórski, s23575, gr. 43c</i>
            <p>
        </div>
    </div>

</form>
</body>
</html>