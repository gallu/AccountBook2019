<?php  // TestModel.php

require_once(BASEPATH . '/Model/ModelBase.php');

class TestModel extends ModelBase {
    // テーブル名
    protected static $table = 'test';
    // Primary Key
    protected static $pk = 'id';

}
