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
    <?php
    if (isset($_REQUEST['action']) || isset($_SESSION['action'])) {
        echo('
    <form method="post" action="main.php">
        ');
    } else {
        echo('
    <form method="post" action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . '>
        ');
    }
    ?>
    <div class="row">
        <div class="column">
            <b>System rezerwacji pokoi hotelowych</b>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <fieldset>
                <?php
                if (!isset($_REQUEST['action']) && !isset($_SESSION['action'])) {
                    echo('
                    <legend>Wybierz opcję</legend>
                    <p>
                    <div class="primary"><input type="submit" name="action" value="Zaloguj"></div>&nbsp;&nbsp;
                    <div class="primary"><input type="submit" name="action" value="Zerejestruj"></div>
                    <p>
                        ');
                } else {
                    if ((isset($_REQUEST['action']) && $_REQUEST['action'] == "Zaloguj")
                        || (isset($_SESSION['action']) && $_SESSION['action'] == "Zaloguj")) {
                        echo('
                    <legend>Zaloguj</legend>
                        ');
                        if (isset($_SESSION['action'])) {
                            echo('
                            <div class="negative">' . $_SESSION['error'] . '</div><p>
                            ');
                        }
                        echo('
                    <div class="label">
                        <label for="email">Adres e-mail : </label><p>
                        <label for="pass">Hasło : </label><p>
                    </div>
                    <div class="input">
                        <input name="email" value="przykladowy@email.com.pl" type="text" minlength="3" required><p>
                        <input name="pass" value="Hasło" type="password" minlength="3" autocomplete="off" required><p>
                        <input class="radio" name="auth_opt" type="hidden" value="login" required>
                    </div>
                            ');
                    } elseif ((isset($_REQUEST['action']) && $_REQUEST['action'] == "Zerejestruj") ||
                        (isset($_SESSION['action']) && $_SESSION['action'] == "Zarejestruj")) {
                        echo('
                    <legend>Zarejestruj</legend>
                        ');
                        if (isset($_SESSION['action'])) {
                            echo('
                            <div class="negative">' . $_SESSION['error'] . '</div><p>
                            ');
                        }
                        echo('
                    <div class="label">
                        <label for="name">Imię : </label><p>
                        <label for="surname">Nazwisko : </label><p>
                        <label for="email">Adres e-mail : </label><p>
                        <label for="pass">Hasło : </label><p>
                    </div>
                    <div class="input">
                        <input name="name" value="Aleksander" required><p>
                        <input name="surname" value="Macedoński" required><p>
                        <input name="email" type="email" value="przykladowy@email.com.pl" required><p>
                        <input name="pass" value="Hasło" type="password" minlength="3" autocomplete="off" required><p>
                        <input class="radio" name="auth_opt" type="hidden" value="register" required>
                    </div>
                            ');
                    }
                }
                ?>
            </fieldset>
        </div>
    </div>
    <?php
    if (isset($_REQUEST['action']) || isset($_SESSION['action'])) {
        echo('
    <div class="row">
        <div class="column">
            <fieldset>
                <legend>Wyślij formularz</legend>
                <p>
                <div class="primary"><input type="submit" name="auth" value="Wyślij"></div>&nbsp;&nbsp;
                <div class="secondary"><input type="reset" value="Wyczyść"></div><p>
                <p>
            </fieldset>
        </div>
    </div>
            ');
    }
    ?>

    <div class="row">
        <div class="column">
            <br><i>Maciej Zagórski, s23575, gr. 43c</i>
        </div>
    </div>

</form>
</body>
</html>

<?php
session_destroy();
?>
