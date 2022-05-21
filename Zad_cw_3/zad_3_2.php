<?php
include_once("zad_3_func.php");

session_start();
?>

<html>
<head>
    <meta charset="UTF-8"/>
    <title>Zad. 3.2</title>
    <link rel="stylesheet" href="zad_3.css">
</head>
<body>

<?php
cookies_count();
session_count();
?>

<form action="zad_3_1.php">
    <fieldset>
        <legend>Zalogowano</legend>
        <div class="description">Zalogowano użytkownika :</div>
        <p>
        <div class="label"><label for="login">Login : </label></div>
        <div class="input"><b><?php echo($_SESSION['login']); ?></b></div>
        </p>
        <p>
        <div class="label"><label for="password">Hasło : </label></div>
        <div class="input"><b><?php echo($_SESSION['password']); ?></b></div>
        </p>
        <p>
        <div class="label"><label for="session_id">Sesja : </label></div>
        <div class="input"><b><?php echo(session_id()); ?></b></div>
        </p>
        <p>
        <div class="submit"><input type="submit" value="Wyloguj"></div>
        <div class="reset"><input type="reset" value="Wyczyść" disabled></div>
        </p>
        <p>
        <div class="result">Licznik „ciasteczkowy” : <b><?php echo($_COOKIE["cookie_counter"]); ?></b></div>
        <div class="result">Licznik „sesyjny” : <b><?php echo($_SESSION["session_counter"]); ?></div>
        </p>
    </fieldset>
</form>
</body>
</html>