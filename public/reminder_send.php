<?php // reminder_send.php

// ��������
require_once(__DIR__ . '/../Libs/init.php');

/* ���� */
// email�A�h���X(����)�̎擾
$email = (string)$_POST['email'] ?? '';
if ('' === $email) {
    header('Location: reminder.php');
    return ;
}

// user��T��

// token���쐬����DB�ɓ����

// mail�𑗂�

//
$template_file_name = 'reminder_send.twig';
$template_data = [];

// �I������
require_once(BASEPATH . '/Libs/fin.php');


