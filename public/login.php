<?php  // login.php

// 初期処理
require_once(__DIR__ . '/../Libs/init.php');
//
require_once(BASEPATH . '/Model/UsersModel.php');

// 入力値の取得
$email = (string)$_POST['email'] ?? '';
$pw    = (string)$_POST['pw'] ?? '';
//var_dump($email, $pw);
if ( ('' === $email)||('' === $pw) ) {
    header('Location: index.php');
    exit;
}

// usersテーブルから該当レコードを把握
$user = UsersModel::findBy(['email' => $email]);
var_dump($user); exit;

// パスワードを比較

// 「認証OK」のマーキング

// 「認証後TopPage」への遷移



