<?php  // PasswordReminderModel.php

class PasswordReminderModel extends ModelBase {
    // テーブル名
    protected static $table = 'password_reminder';
    // Primary Key
    protected static $pk = 'token';

    // 「TTLが過去の情報」を削除：お掃除
    public static function deletePast()
    {
        $sql = 'DELETE FROM password_reminder WHERE ttl < now();';
        static::getDbHandle()->query($sql);
    }

}
