<?php

session_start();
require_once 'configDB.php';

$_SESSION['id_post'] = $_GET['id_post'];

