<?php  // init_auth.php

// ��������
require_once(__DIR__ . '/init.php');

// �F�`�F�b�N
if (false === isset($_SESSION['auth'])) {
     header('Location: index.php');
     return;
}


