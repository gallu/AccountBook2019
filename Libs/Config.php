<?php  // Config.php

class Config {
    // �O����� new �̋֎~
    protected function __construct() {
    }
    // clone�֎~
    protected function __clone() {
    }
    // unserialize�֎~
    protected function __wakeup() {
    }

    //
    public static function getAll() {
        //
        static $conf = null;
        if (null === $conf) {
            // ����ˑ���config��ǂݍ����
            $conf = require(BASEPATH . '/config.php');
            // ���ˑ���config��ǂݍ����
            $conf += require(BASEPATH . '/environment_config.php');
        }
        // �S��return
        return $conf;
    }
}



