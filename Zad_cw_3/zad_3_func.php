<?php
function cookies_count()
{
    if (isset($_COOKIE['cookie_counter'])) {
        $cookie_count = $_COOKIE['cookie_counter'];
        $cookie_count++;
    } else {
        $cookie_count = 2;
//      https://stackoverflow.com/questions/3230133/accessing-cookie-immediately-after-setcookie
    }
    setCookie("cookie_counter", $cookie_count);
}

function session_count()
{
    if (isset($_SESSION['session_counter'])) {
        $session_count = $_SESSION['session_counter'];
        $session_count++;
    } else {
        $session_count = 1;
    }
    $_SESSION['session_counter'] = $session_count;
}

?>