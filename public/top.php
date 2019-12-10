<?php  // top.php

// 初期処理 + 認可チェック
require_once(__DIR__ . '/../Libs/init_auth.php');

//
$template_file_name = 'top.twig';
$template_data = [];

//
if (true === isset($_SESSION['flash'])) {
    $template_data += $_SESSION['flash'];
    unset($_SESSION['flash']);
}

// 終了処理
require_once(BASEPATH . '/Libs/fin.php');





