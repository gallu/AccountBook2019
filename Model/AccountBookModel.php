<?php  // AccountBookModel.php

require_once(BASEPATH . '/Model/ModelBase.php');

class AccountBookModel extends ModelBase {
    // テーブル名
    protected static $table = 'account_book';
    // Primary Key
    protected static $pk = 'account_book_id';
}

