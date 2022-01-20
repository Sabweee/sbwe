<?php

require_once '../session.start.php';

exitUser();

function exitUser() : void {
    clear_session();
    $_COOKIE['token'] = NULL;
}