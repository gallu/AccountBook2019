<?php  // activation.php

// 初期処理
require_once(__DIR__ . '/../Libs/init.php');

// DBハンドルの取得
$dbh = DB::getHandle();

// 先に「TTLが過去の情報」を削除：お掃除
$sql = 'DELETE FROM activation WHERE ttl < now();';
$dbh->query($sql); //

// tokenの取得
$token = (string)@$_GET['token'];

// DBにtokenがあるか？ を確認
$sql = 'SELECT * FROM activation WHERE token = :token;';
$pre = $dbh->prepare($sql);
//
$pre->bindValue(':token', $token, \PDO::PARAM_STR);
//
$res = $pre->execute(); // XXX
$row = $pre->fetch();
//var_dump($row);
// tokenがなかったらNG
if (empty($row)) {
    // XXX
    echo 'ないよ～';
    exit;
} else {
    // tokenがあったら
    // XXX BEGIN
    // 対象のuser_idのemailをupdateして
    $sql = 'UPDATE users SET email=:email WHERE user_id=:user_id;';
    $pre = $dbh->prepare($sql);
    //
    $pre->bindValue(':email', $row['email'], \PDO::PARAM_STR);
    $pre->bindValue(':user_id', $row['user_id'], \PDO::PARAM_STR);
    //
    $res = $pre->execute(); // XXX

    // tokenを削除
    $sql = 'DELETE FROM activation WHERE token = :token;';
    $pre = $dbh->prepare($sql);
    //
    $pre->bindValue(':token', $token, \PDO::PARAM_STR);
    //
    $res = $pre->execute(); // XXX
    // XXX COMMIT

    // XXX
    echo 'アクティベーション成功！！';
    exit;
}

// 完了画面

// 終了処理
require_once(BASEPATH . '/Libs/fin.php');

