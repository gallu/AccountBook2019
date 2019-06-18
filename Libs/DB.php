<?php  // DB.php
/*
// �g�p�C���[�W
$dbh = DB::getHandle(); // DB�ڑ��n���h��(PDO)��������
*/

require_once(BASEPATH . '/Libs/Config.php');

class DB {
    //
    public static function getHandle() {
        //
        static $dbh = null;
        if (null === $dbh) {
            try {
                //
                $conf = Config::getAll();
                $dbname = $conf['DB']['dbname'];
                $host   = $conf['DB']['host'];
                $user   = $conf['DB']['user'];
                $pass   = $conf['DB']['pass'];
                $dsn = "mysql:dbname={$dbname};host={$host};charset=utf8mb4";
                $option = [
                    // �ÓI�v���[�X�z���_���w��
                    PDO::ATTR_EMULATE_PREPARES => false,
                    // �������s���֎~
                    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
                ];
                //
                $dbh = new PDO($dsn, $user, $pass, $option);
            } catch (PDOException $e) {
                // XXX �Ƃ肠����
                echo $e->getMessage();
                exit; // �ꓖ����
            }
        }
        return $dbh;
    }

}




