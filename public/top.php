<?php  // top.php

// ��������
require_once(__DIR__ . '/../Libs/init.php');
// �F�`�F�b�N
if (false === isset($_SESSION['auth'])) {
     header('Location: index.php');
     return;
}

//
$template_file_name = 'top.twig';
$template_data = [];

// �I������
require_once(BASEPATH . '/Libs/fin.php');

