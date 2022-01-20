<?php
require_once '../session.start.php';
require_once '../configDB.php';
require_once 'sign-in.php';

$name = $_POST['name'];
$email = $_POST['email_reg'];
$tel = $_POST['tel'];
$password = $_POST['password_reg'];
$password_confirm = $_POST['password_confirm'];

if (!empty($name) && !empty($email) && !empty($tel) && !empty($password) && !empty($password_confirm)) {
    if (!empty($pdo)) {
        checkUserEmail($pdo, $name, $email, $tel, $password);
    }
}
function checkUserEmail(PDO $pdo, string $name, string $email, string $tel, string $password){
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $phone = filter_var($tel, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $query = 'SELECT * FROM `user` WHERE `phone` = :phone;';
    $params = [
        'phone' => $phone
    ];
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    if($stmt->rowCount() == 0) {
        regUser($pdo, $name, $email, $phone, $password);
    } else {
        $errors = [
            'status' => 0,
            'message' => 'Такой телефон уже существует'
        ];
        echo json_encode($errors);
    }
}

function regUser(PDO $pdo, string $name, string $email, string $phone, string $password) {
    //Регистрирую пользователя
    $query = "INSERT INTO `user` (`user_name`, `email`, `phone`, `password`, `token`) VALUES ( :name_users, :email, :phone, :password, :token)";
    $params = [
        'name_users' => $name,
        'email' => $email,
        'phone' => $phone,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'token' => 'token'
    ];
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    getUser($pdo, $email, $password);
    echo json_encode($_SESSION['user']);
}