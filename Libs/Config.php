<?php  // Config.php

class Config {
    //
    public static function getAll() {
        //
        static $conf = null;
        if (null === $conf) {
            // ���ˑ���config��ǂݍ����
            $conf = require(BASEPATH . '/environment_config.php');
        }
        // �S��return
        return $conf;
    }
}

