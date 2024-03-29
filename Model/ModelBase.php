<?php  // ModelBase

class ModelBase {
    /*
    // テーブル名
    protected static $table = 'my_table';
    // Primary Key
    protected static $pk = 'key';
     */

    // データの扱い
    public function __get($name) {
        return $this->datum[$name];
    }
    public function __set($name, $value) {
        $this->datum[$name] = $value;
    }

    //
    protected static function getDbHandle() {
        return DB::getHandle();
    }

    //
    public function insert() {
        // DBハンドルの取得
        $dbh = $this::getDbHandle();

        // プリペアドステートメントの作成
        $key_array = array_keys($this->datum);
        // XXX 厳密には「識別子をエスケープしていない」ので注意
        // XXX いったん「PHPの構文」でひっかけてる
        $cols = implode(', ', $key_array);
        $awk = [];
        foreach($key_array as $s) {
            $awk[] = ":{$s}";
        }
        $holders = implode(', ', $awk);
        //
        $sql = "INSERT INTO {$this::$table}({$cols}) VALUES({$holders});";
        $pre = $dbh->prepare($sql);

        // 値のバインド
        foreach($key_array as $s) {
            $this::bindValue($pre, $s, $this->datum[$s]);
        }

        // SQLの実行(INSERT)
        $res = $pre->execute();
        return $res;
    }

    //
    public static function find($v) {
        return static::findBy([static::$pk => $v]);
    }
    //
    public static function findBy(array $where)
    {
        // DBハンドルの取得
        $dbh = static::getDbHandle();

        // プリペアドステートメントの作成
        $table = static::$table;
        $sql = "SELECT * FROM {$table} ";
        // WHERE句の生成
        $awk = [];
        foreach($where as $k => $v) {
            $awk[] = "{$k} = :{$k}";
        }
        $where_string = implode(' AND ', $awk);
        $sql .= ' WHERE ' . $where_string;
        $pre = $dbh->prepare($sql);
        foreach($where as $k => $v) {
            static::bindValue($pre, $k, $v);
        }

        // SQLの実行(SELECT)
        $res = $pre->execute();

        // データの読み込み
        $row = $pre->fetch(\PDO::FETCH_ASSOC);
        if (empty($row)) { // false または 空配列
            return null;
        }
        // else
        $ret = new static();
        foreach($row as $k => $v) {
            $ret->$k = $v;
        }
        //
        return $ret;
    }

    // 削除
    public function delete() {
        //
        $table = static::$table;
        $sql = "DELETE FROM {$table}";
        $pre = static::makeWhere($sql, $this->datum[static::$pk]);

        // SQLの実行(DELETE)
        $res = $pre->execute();
        return $res;
    }

    // 更新
    public function update() {
        // プリペアドステートメントの作成
        $table = static::$table;
        $sql = "UPDATE {$table} SET ";
        $awk = [];
        foreach($this->datum as $k => $v) {
            if ($k !== $this::$pk) {
                $awk[] = "{$k} = :{$k}";
            }
        }
        $set = implode(', ', $awk);
        $sql .= $set;
        //
        $pre = $this::makeWhere($sql, $this->datum[static::$pk]);
        foreach($this->datum as $k => $v) {
            if ($k !== $this::$pk) {
                $this::bindValue($pre, $k, $v); // XXX pkが重複して代入
            }
        }
        // SQLの実行(UPDATE)
        $res = $pre->execute();
        return $res;
    }

    // 内部用メソッド
    protected static function bindValue($pre, $h_name, $v)
    {
        if ( (is_int($v))||(is_float($v)) ) {
            $type = \PDO::PARAM_INT;
        } else {
            $type = \PDO::PARAM_STR;
        }
        $pre->bindValue(":{$h_name}", $v, $type);
    }

    //
    static protected function makeWhere($sql, $v) {
        // DBハンドルの取得
        $dbh = static::getDbHandle();

        //
        $pk = static::$pk;
        $sql .= " WHERE {$pk} = :{$pk}";
        $pre = $dbh->prepare($sql);
        static::bindValue($pre, $pk, $v);

        //
        return $pre;
    }

//
private $datum = [];
}

