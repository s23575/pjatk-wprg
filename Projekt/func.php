<?php
function db_connect()
{
    $db_error = '<div class="negative"><b>Wystapił błąd!</b><br>Nie udało się połączyć z bazą danych</div><p>';
    if (!$db_link = mysqli_connect("localhost", "root", "root")) {
        echo($db_error);
    }
    if (!mysqli_select_db($db_link, "projekt")) {
        echo($db_error);
    }
    return $db_link;
}

function auth_error($opt, $error)
{
    $_SESSION['action'] = $opt;
    $_SESSION['error'] = "<b>Wystąpił błąd!</b> " . $error;
    header("Location: index.php");
}

function logout() {
    unset($_SESSION);
    header("Location: index.php");
}
?>