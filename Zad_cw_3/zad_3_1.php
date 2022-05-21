<?php
include_once("zad_3_func.php");

session_start();
if (isset($_SESSION['session_counter'])) {
    unset($_SESSION['session_counter']);
}
session_destroy();
?>

<html>
<head>
    <meta charset="UTF-8"/>
    <title>Zad. 3.1</title>
    <link rel="stylesheet" href="zad_3.css">
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <fieldset>
        <legend>Logowanie</legend>

        <?php
        if (isset($_REQUEST['login'])) {
            if ($_REQUEST['login'] == "jan_kowalski" and $_REQUEST['password'] == "haslo_123") {
                session_start();
                session_regenerate_id();
                $_SESSION['login'] = $_REQUEST['login'];
                $_SESSION['password'] = $_REQUEST['password'];
                header("Location: zad_3_2.php");
            } else {
                echo('<p><div class="result"><b>Błędne logowanie!</b><br>Spróbuj ponownie :</div></p>');
                cookies_count();
            }
        } else {
            cookies_count();
        }
        ?>

        <div class="description">Wpisz login i hasło, aby się zalogować :</div>
        <p>
        <div class="label"><label for="login">Login : </label></div>
        <div class="input"><input id="login" name="login" type="text" minlength="3" required></div>
        </p>
        <p>
        <div class="label"><label for="password">Hasło : </label></div>
        <div class="input"><input id="password" name="password" type="password" minlength="3" autocomplete="off"
                                  required></div>
        </p>
        <p>
        <div class="submit"><input type="submit" value="Zaloguj"></div>
        <div class="reset"><input type="reset" value="Wyczyść"></div>
        </p>
        <p>
        <div class="result">Licznik „ciasteczkowy” : <b><?php echo($_COOKIE["cookie_counter"] ?? "1"); ?></b></div>
        </p>
    </fieldset>
</form>
</body>
</html>