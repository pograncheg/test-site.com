<?php

if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    
    session_start();

    require_once '../classes/Validator.php';
    require_once '../classes/User.php';
    require_once '../classes/UserManager.php';

    $userData = [];
    foreach ($_POST as $fieldname => $value) {
        $userData[$fieldname] = htmlentities(trim($value), ENT_QUOTES, 'UTF-8');
    }

    function RandomString($length = 6)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= substr($chars, rand(1, strlen($chars)) - 1, 1);
        }
        return $randomString;
    }

    $rules = [
        'login' => [
            'required' => true,
            'unique' => true,
            'min' => 6,
            'spaceInMid' => false,
        ],
        'email' => [
            'required' => true,
            'unique' => true,
            'email' => true,
        ],
        'name' => [
            'required' => true,
            'min' => 2,
            'onlyLetters' => true,
        ],
        'password' => [
            'required' => true,
            'min' => 6,
            'letterAndNumber' => true,
        ],
        'confirm_password' => [
            'required' => true,
            'match' => ['password', 'Пароли не совпали'],
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
    } else {
        $salt = RandomString(5);
        $user = [
            'login' => $userData['login'],
            'password' => md5($userData['password'] . $salt),
            'salt' => $salt,
            'email' => $userData['email'],
            'name' => $userData['name'],
        ];

        $newUser = new User($user);
        $userManager = new UserManager('../config/users.json');
        // $userManager->getAllUsers();
        $userManager->create($newUser);

        if ($userManager->getByLogin($userData['login'])) {
            $response = [
                'status' => true,
                'message' => "Пользователь успешно зарегистрирован!"
            ];
        } else {
            $response = [
                'status' => false,
                'message' => "Ошибка при регистрации. Попробуйте еще раз!"
            ];
        }
    }

    echo json_encode($response);
} else {
    header('Location: /');
    die();
}
