<?php  // top.php

// 初期処理 + 認可チェック
require_once(__DIR__ . '/../Libs/init_auth.php');

//
$template_file_name = 'top.twig';
$template_data = [];

// 終了処理
require_once(BASEPATH . '/Libs/fin.php');

