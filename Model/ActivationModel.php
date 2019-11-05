<?php  // ActivationModel.php

require_once(BASEPATH . '/Model/ModelBase.php');

class ActivationModel extends ModelBase {
    // テーブル名
    protected static $table = 'activation';
    // Primary Key
    protected static $pk = 'token';

    // 「TTLが過去の情報」を削除：お掃除
    public static function deletePast()
    {
        $sql = 'DELETE FROM activation WHERE ttl < now();';
        static::getDbHandle()->query($sql);
    }

}
