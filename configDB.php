<?php

$ini_array = parse_ini_file("configparameters.ini", true);

$dsn = "mysql:host=$ini_array[host];dbname=$ini_array[db];charset=$ini_array[charset]";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $ini_array['user'], $ini_array['pass'], $opt);
} catch (PDOException $e) {
    print "Has errors: " . $e->getMessage();
    die();
}