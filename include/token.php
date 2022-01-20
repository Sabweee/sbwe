<?php

//Генерация рандомного токена
function generateToken (int $length = 64, string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') : string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[rand(0, $max)];
    }
    return implode('', $pieces);
}

function updateUserToken(PDO $pdo, int $userId, string $token) : void {
    $query = 'UPDATE `user` SET `token` = :token WHERE `id_user` = :id_user';
    $params = [
        'token' => $token,
        'id_user' => $userId
    ];
    $pdo->prepare($query)->execute($params);
    setcookie('token', $token);
    $_SESSION['token'] = $token;
}