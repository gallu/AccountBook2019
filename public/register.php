<?php  // register.php

// ��������
require_once(__DIR__ . '/../Libs/init.php');

//
if (isset($_SESSION['register'])) {
    $register = $_SESSION['register'];
    unset($_SESSION['register']);
} else {
    $register = [];
}
//var_dump($register);

//
$template_file_name = 'register.twig';
$template_data = ['register' => $register];

// �I������
require_once(BASEPATH . '/Libs/fin.php');

