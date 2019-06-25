<?php  // index.php

define('BASEPATH', realpath(__DIR__ . '/../'));
//var_dump(BASEPATH);

//
require_once(BASEPATH . '/vendor/autoload.php');

require_once(BASEPATH . '/Libs/Config.php');
$conf = Config::getAll();
//var_dump($conf);

require_once(BASEPATH . '/Libs/DB.php');
//var_dump(DB::getHandle());

//
$dir = $conf['view_front']['template_dir'];
$loader = new \Twig\Loader\FilesystemLoader($dir);
$twig = new \Twig\Environment($loader);
//var_dump($twig);


echo $twig->render('index.tiwg', []);


