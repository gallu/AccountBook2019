<?php  // index.php

define('BASEPATH', realpath(__DIR__ . '/../'));
//var_dump(BASEPATH);

require_once(BASEPATH . '/Libs/Config.php');
//$conf = Config::getAll();
//var_dump($conf);

require_once(BASEPATH . '/Libs/DB.php');
var_dump(DB::getHandle());


echo 'AccountBook';




