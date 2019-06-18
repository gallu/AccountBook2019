<?php  // Config.php

class Config {
    //
    public static function getAll() {
        //
        static $conf = null;
        if (null === $conf) {
            // ŠÂ‹«ˆË‘¶‚Ìconfig‚ð“Ç‚Ýž‚ñ‚Å
            $conf = require(BASEPATH . '/environment_config.php');
        }
        // ‘S•”return
        return $conf;
    }
}

