<?php  // activation.php

// 初期処理
require_once(__DIR__ . '/../Libs/init.php');
//
require_once(BASEPATH . '/Model/ActivationModel.php');
require_once(BASEPATH . '/Model/UsersModel.php');

// DBハンドルの取得
$dbh = DB::getHandle();

// 先に「TTLが過去の情報」を削除：お掃除
ActivationModel::deletePast();

// tokenの取得
$token = (string)@$_GET['token'];

// DBにtokenがあるか？ を確認
$activation = ActivationModel::find($token);
if (empty($activation)) {
    // XXX
    echo 'ないよ～';
    exit;
} else {
    // tokenがあったら
    // XXX BEGIN
    // 対象のuser_idのemailをupdateして
    $user = UsersModel::find($activation->user_id); // XXX チェックをオミット
    $user->email = $activation->email;
    $user->update();

    // tokenを削除
    $activation->delete();
    // XXX COMMIT

    // XXX
    echo 'アクティベーション成功！！';
    exit;
}

// 完了画面

// 終了処理
require_once(BASEPATH . '/Libs/fin.php');

