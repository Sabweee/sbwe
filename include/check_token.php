<?php

require_once '../configDB.php';
require_once '../session.start.php';

if(!($_SESSION['token']) != NULL){
    $_SESSION['user']['status'] = 0;
}

echo json_encode($_SESSION['user']);