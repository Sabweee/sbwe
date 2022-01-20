<?php
require_once '../session.start.php';
require_once '../configDB.php';
require_once 'token.php';

$telephone = $_POST['tel_auth'];
$password = $_POST['password_auth'];

if (!empty($telephone) && !empty($password)) {
    if (!empty($pdo)) {
        getUser($pdo, $telephone, $password);
        echo json_encode($_SESSION['user']);
    }
}

function getUser(PDO $pdo, string $telephone, string $password) {
    $stmt = $pdo->prepare("SELECT `id_user`, `id_role`, `user_name`, `date_of_last_visit`, `password`, `email` FROM `user` WHERE `phone` = ?");
    $stmt->execute([
        $telephone
    ]);
    $row = $stmt->fetch(PDO::FETCH_LAZY);
    if($stmt->rowCount() == 0 || !password_verify($password,$row->password)){
        $_SESSION['user'] = [
            "status" => 0,
            "message" => 'Неверный логин или пароль'
        ];
    } else {
        $stmt = $pdo->prepare("UPDATE `user` SET `date_of_last_visit`= now() WHERE `phone` = :phone");
        $stmt->execute([
            $telephone
        ]);
        $_SESSION['user'] = [
            "status" => 1,
            "id_user" => $row->id_user,
            "id_role" => $row->id_role,
            "user_name" => $row->user_name,
            "phone" => $telephone,
            "email" => $row->email,
            "last_visit" => date('d.m.Y H:i')
        ];
        $token = generateToken();
        updateUserToken($pdo, $_SESSION['user']['id_user'], $token);
    }
}