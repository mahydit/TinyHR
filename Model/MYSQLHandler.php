<?php
class MYSQLHandler implements DbHandler
{

    private $_db_handler;
    private $_table;

    public function __construct($table)
    {
        $this->_table = $table;
        $this->connect();
    }

    public function connect()
    {
        $handler = mysqli_connect(__HOST__, __USER__, __PASS__, __DB__);
        // Check connection
        if ($handler) {
            $this->_db_handler = $handler;
            return true;
        }
        return false;
    }

    public function get_data($fields = array(), $start = 0)
    {
        $table = $this->_table;
        if (empty($fields)) {
            $sql = "select * from " . $table;
        } else {
            $sql = "select ";
            foreach ($fields as $f) {
                $sql .= "`$f` ,";
            }
            $sql .= " from `$table`";
            $sql = str_replace(", from", "from", $sql);
        }
        $sql .= " limit $start," . __RECORD_PER_PAGE__;
        return $this->get_results($sql);
    }

    public function disconnect()
    {
        if ($this->_db_handler) {
            mysqli_close($this->_db_handler);
        }
    }

    public function get_record_by_id($id, $primary_key)
    {
        $table = $this->_table;
        $sql = "select * from `$table` where `$primary_key` = $id";
        return $this->get_results($sql);
    }

    private function get_results($sql)
    {
        $this->debug($sql);
        $_handler_result = mysqli_query($this->_db_handler, $sql);
        $_arr_result = array();

        if ($_handler_result) 
        {
            while ($row = mysqli_fetch_array($_handler_result, MYSQLI_ASSOC)) 
            {
                $_arr_result[] = array_change_key_case($row);
            }
                $this->disconnect();
                return $_arr_result;
       }
        else
        {
            $this->disconnect();
            return $_arr_result;
        } 

    }

    public function search($column, $column_value)
    {
        $table = $this->_table;
        $sql = "select * from `$table` where `$column` like '%" . $column_value . "%'";
        return $this->get_results($sql);
    }

    public function search_exact($column, $column_value)
    {
        $table=$this->_table;
        $sql = "select * from `$table` where `$column` = '".$column_value."'";
        return $this->get_results($sql);
    }

    public function save($new_value)
    {
        if(is_array($new_value))
        {
            $table=$this->_table;
            $sql1= "insert into `$table` (";
            $sql2=" values (";
            foreach ($new_value as $key => $value) 
            {

                $sql1 .= "`$key` ,";
                $sql2 .= "'$value' ,";
            }
            $sql1 = $sql1 . ")";
            $sql2 = $sql2 . ")";
            $sql1 = str_replace(",)", ")", $sql1);
            $sql2 = str_replace(",)", ")", $sql2);
            $sql = $sql1 . $sql2;
            $this->debug($sql);
            if (mysqli_query($this->_db_handler, $sql)) {
                $this->disconnect();
                return true;
            } else {
                $this->disconnect();
                return false;
            }

        }
    }

    private function debug($sql)
    {
        if (__DEBUG_MODE__ === 1) {
            echo "<h5> Sent Query </h5>" . $sql . "<br>";
        }
    }

    public function get_full_data($fields = array())
    {
        $table = $this->_table;
        if (empty($fields)) {
            $sql = "select * from " . $table;
        } else {
            $sql = "select ";
            foreach ($fields as $f) {
                $sql .= "`$f` ,";
            }
            $sql .= " from `$table`";
            $sql = str_replace(", from", "from", $sql);
        }
        return $this->get_results($sql);
    }

    public function update($new_value, $primary_key, $id)
    {
        if(is_array($new_value))
        {
            $table=$this->_table;
            $sql= "update `$table` set ";
            foreach ($new_value as $key => $value) 
            {
                $sql .= "`$key` = '$value',";
            }
            $sql= str_replace(",","",$sql);
            $sql = $sql . " where `$primary_key` = '$id'";
            $this->debug($sql);
            if(mysqli_query($this->_db_handler,$sql))
            {
                $this->disconnect();
                return true;
            }
            else
            {
                $this->disconnect();
                return false;
            }

        }
    }
}
