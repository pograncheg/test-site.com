<?php

if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {

    session_start();

    require_once '../classes/Validator.php';
    require_once '../classes/UserManager.php';

    $userData = [];

    foreach ($_POST as $fieldname => $value) {
        $userData[$fieldname] = htmlentities(trim($value), ENT_QUOTES, 'UTF-8');
    }

    $rules = [
        'login' => [
            'required' => true,
        ],
        'password' => [
            'required' => true,
        ],
    ];

    $validator = new Validator($userData);
    $validator->validate($rules);
    $errors = $validator->getErrors();

    if ($errors) {
        $response = [
            'status' => false,
            'errors' => $errors
        ];
        exit(json_encode($response));
    }

    $userManager = new UserManager('../config/users.json');
    $user = $userManager->getByLogin($userData['login']);

    if ($user) {
        if ($user['password'] == md5($userData['password'] . $user['salt'])) {
            $response = [
                'status' => true,
            ];
            $_SESSION['user']['login'] = $userData['login'];
            $_SESSION['user']['name'] = $user['name'];
            $_SESSION['user']['email'] = $user['email'];
            setcookie('user', $userData['login']);
        } else {
            $response = [
                'status' => false,
                'errors' => ['password' => 'Неверный пароль']
            ];
        }
    } else {
        $response = [
            'status' => false,
            'errors' => ['login' => 'Пользователь не зарегистрирован']
        ];
    }

    echo json_encode($response);
} else {
    header('Location: /');
    die();
}
