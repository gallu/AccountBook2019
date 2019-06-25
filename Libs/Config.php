<?php  // Config.php

class Config {
    // ŠO‚©‚ç‚Ì new ‚Ì‹ÖŽ~
    protected function __construct() {
    }
    // clone‹ÖŽ~
    protected function __clone() {
    }
    // unserialize‹ÖŽ~
    protected function __wakeup() {
    }

    //
    public static function getAll() {
        //
        static $conf = null;
        if (null === $conf) {
            // ŠÂ‹«”ñˆË‘¶‚Ìconfig‚ð“Ç‚Ýž‚ñ‚Å
            $conf = require(BASEPATH . '/config.php');
            // ŠÂ‹«ˆË‘¶‚Ìconfig‚ð“Ç‚Ýž‚ñ‚Å
            $conf += require(BASEPATH . '/environment_config.php');
        }
        // ‘S•”return
        return $conf;
    }
}



