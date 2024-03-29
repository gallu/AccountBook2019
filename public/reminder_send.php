<?php // reminder_send.php

// 初期処理
require_once(__DIR__ . '/../Libs/init.php');
//
require_once(BASEPATH . '/Libs/Token.php');
require_once(BASEPATH . '/Model/UsersModel.php');
require_once(BASEPATH . '/Model/PasswordReminderModel.php');

/* 処理 */
// emailアドレス(入力)の取得
$email = (string)($_POST['email'] ?? '');
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
    //
    $m_obj = new PasswordReminderModel();
    //
    $m_obj->token = $token;
    $m_obj->user_id = $user->user_id;
    $m_obj->ttl = date(DATE_ATOM, time() + 7200); // 2時間有効
    //
    $r = $m_obj->insert();
    if (false === $r) {
        // XXX
        echo 'token生成に失敗';
        exit;
    }

    // mailを送る
    $message = new Swift_Message();
    $message->setFrom('test@dev2.m-fr.net');
    $message->setTo( $user->email );
    $message->setSubject('AccoutBook パスワードリマインダ');

    // bodyの作成
    $param = ['name' => $user->name, 'token' => $token, 'ttl' => $m_obj->ttl];
    $body = $twig->render('reminder_mail.twig', $param);
var_dump($body);
    //
    $message->setBody($body);

    //
    $mailer = new Swift_Mailer(new Swift_SmtpTransport('localhost', 25));
    $r = $mailer->send($message);
var_dump($r);
}

//
$template_file_name = 'reminder_send.twig';
$template_data = [];

// 終了処理
require_once(BASEPATH . '/Libs/fin.php');

