<?php  // logout.php

// ��������
require_once(__DIR__ . '/../Libs/init_auth.php');

// ���O�A�E�g����
unset($_SESSION['auth']);

//
header('Location: index.php');
