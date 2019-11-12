<?php  // top.php

// 初期処理
require_once(__DIR__ . '/../Libs/init.php');
// 認可チェック
if (false === isset($_SESSION['auth'])) {
     header('Location: index.php');
     return;
}

//
$template_file_name = 'top.twig';
$template_data = [];

// 終了処理
require_once(BASEPATH . '/Libs/fin.php');

