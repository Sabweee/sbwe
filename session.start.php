<?php
session_start();

function clear_session() : void{
    $_SESSION['user']['status'] = null;
    $_SESSION['user']['id_user'] = null;
    $_SESSION['user']['id_role'] = null;
    $_SESSION['user']['user_name'] = null;
    $_SESSION['user']['email'] = null;
    $_SESSION['user']['phone'] = null;
    $_SESSION['user']['last_visit'] = null;
    $_SESSION['token'] = null;
}