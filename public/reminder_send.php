<?php // reminder_send.php

// 初期処理
require_once(__DIR__ . '/../Libs/init.php');

/* 処理 */
// emailアドレス(入力)の取得
$email = (string)$_POST['email'] ?? '';
if ('' === $email) {
    header('Location: reminder.php');
    return ;
}

// userを探す

// tokenを作成してDBに入れる

// mailを送る

//
$template_file_name = 'reminder_send.twig';
$template_data = [];

// 終了処理
require_once(BASEPATH . '/Libs/fin.php');


