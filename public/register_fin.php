<?php // register_fin.php

// 初期処理
require_once(__DIR__ . '/../Libs/init.php');

//
require_once(BASEPATH . '/Model/UsersModel.php');
require_once(BASEPATH . '/Model/ActivationModel.php');
require_once(BASEPATH . '/Libs/Token.php');

// 入力データの取得
$params = ['name', 'email', 'pw', 'pw2'];
$data = [];
foreach($params as $p) {
    $data[$p] = (string)@$_POST[$p];
}
//var_dump($data);

// validate
$error_flg = [];
// 必須チェック
foreach(['email', 'pw', 'pw2'] as $p) {
    if ('' === $data[$p]) {
        $error_flg["error_must_{$p}"] = true;
    }
}
// emailのvalidate
if (false === filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $error_flg["error_email_valid"] = true;
}
// pwの長さ(max_length)
// XXX PASSWORD_BCRYPT だと最大72文字なのでやむを得ず
if (72 < strlen($data['pw'])) {
    $error_flg["error_pw_to_long"] = true;
}
// pwとpw2のチェック
if ($data['pw'] !== $data['pw2']) {
    $error_flg["error_pw_nomatch"] = true;
}
//
if ([] !== $error_flg) {
    // 入力ページに戻す
    $_SESSION['register']['error'] = $error_flg;
    // password情報を抜いてから渡す
    unset($data['pw']);
    unset($data['pw2']);
    $_SESSION['register']['post'] = $data;
    header('Location: ./register.php');
    return ;
}

// DBハンドルの取得
$dbh = DB::getHandle();

// 会員情報のINSERT
$user = new UsersModel();
$user->name = $data['name'];
$user->email = '';
$user->pw = password_hash($data['pw'], PASSWORD_DEFAULT);
//
$res = $user->insert();
if (false == $res) {
    // XXX
    echo 'INSERT失敗';
    exit;
}
// user_idの取得
$user_id = $dbh->lastInsertId();

// アクティベーションのINSERT
$activation = new ActivationModel();
$activation->token = $token = Token::make();
$activation->user_id = $user_id;
$activation->email = $data['email'];
$activation->ttl = date(DATE_ATOM, time() + 10800);
//
$res = $activation->insert();
if (false == $res) {
    // XXX
    echo 'INSERT失敗';
    exit;
}
//
var_dump($user_id, $token);

// アクティベーションmailの送信
$message = new Swift_Message();
$message->setFrom('test@dev2.m-fr.net');
$message->setTo( $data['email'] );
$message->setSubject('AccoutBook アクティベーションメール');
// bodyの作成
$param = ['token' => $token, 'name' => $data['name'] ];
$body = $twig->render('activation_mail.twig', $param);
var_dump($body);
//
$message->setBody($body);

//
$mailer = new Swift_Mailer(new Swift_SmtpTransport('localhost', 25));
$r = $mailer->send($message);

// 完了画面の出力(Location)
header('Location: ./register_success.php');








