<?php  // deposit.php

// 初期処理 + 認可チェック
require_once(__DIR__ . '/../Libs/init_auth.php');

// 多少のvalidate
$amount = (int)($_POST['amount'] ?? 0);
if (0 >= $amount) {
    // XXX
    echo '有効な金額を入れろ！';
    exit;
}
var_dump($amount);

// 入金(insert)
// 「入金しました」表示用ギミック
// TopにLocation


