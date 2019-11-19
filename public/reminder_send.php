<?php // reminder_send.php

// 初期処理
require_once(__DIR__ . '/../Libs/init.php');
//
require_once(BASEPATH . '/Libs/Token.php');

/* 処理 */
// emailアドレス(入力)の取得
$email = (string)$_POST['email'] ?? '';
if ('' === $email) {
    header('Location: reminder.php');
    return ;
}

// userを探す
$user = UsersModel::findBy(['email' => $email]);
//var_dump($user); exit;

// ユーザが見つかったら以下の処理をする
if (null !== $user) {
    // tokenを作成してDBに入れる
    $token = Token::make();


    // mailを送る
}

//
$template_file_name = 'reminder_send.twig';
$template_data = [];

// 終了処理
require_once(BASEPATH . '/Libs/fin.php');


