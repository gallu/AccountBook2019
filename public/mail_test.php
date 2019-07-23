<?php //mail_test.php

require_once('../vendor/autoload.php');

//
$message = new Swift_Message();
$message->setFrom('test@dev2.m-fr.net');
$message->setTo('自分のメールアドレス');
$message->setSubject('さぶじぇくと');
$message->setBody("これで届くはずだけど \n まぁ、確認してみましょう");

//
$mailer = new Swift_Mailer(new Swift_SmtpTransport('localhost', 25));
$r = $mailer->send($message);
var_dump($r);









