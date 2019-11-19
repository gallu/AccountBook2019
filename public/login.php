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
//var_dump($user); exit;
if (null === $user) {
    // 該当ユーザが存在しなかったらつっかえす
    header('Location: index.php');
    exit;
}

// パスワードを比較
if (false === password_verify($pw, $user->pw)) {
    // パスワードチェックでＮＧならつっかえす
    header('Location: index.php');
    exit;
}

// XXX ここまで来たら認証ＯＫ
//echo 'auth ok';

// 
session_regenerate_id(true);

// 「認証OK」のマーキング
$_SESSION['auth']['name'] = $user->name;
$_SESSION['auth']['user_id'] = $user->user_id;

// 「認証後TopPage」への遷移
header('Location: top.php');








