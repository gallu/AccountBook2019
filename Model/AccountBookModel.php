<?php  // AccountBookModel.php

require_once(BASEPATH . '/Model/ModelBase.php');

class AccountBookModel extends ModelBase {
    // �e�[�u����
    protected static $table = 'account_book';
    // Primary Key
    protected static $pk = 'account_book_id';
}

