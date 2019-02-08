<?php
class Admin{
    // private $_db_handler;
    public function __construct()
    {
        // $this->_db_handler = new MYSQLHandler(__USER_TABLE__);
    }

    public function get_all_members()
    {
        // $handler = $this->_db_handler;
        $handler = new MYSQLHandler(__USER_TABLE__);
        $data = $handler->get_full_data();
        return $data;
    }

    public function search_member($name)
    {
        // $handler = $this->_db_handler;
        $handler = new MYSQLHandler(__USER_TABLE__);
        $data = $handler->search('name', trim($name));
        return $data;
    }

    public function get_member_information($index)
    {
        // $handler = $this->_db_handler;
        $handler = new MYSQLHandler(__USER_TABLE__);
        $data = $handler->get_record_by_id($index, __PRIMARY_KEY__);
        return $data;
    }

    public function get_online()
    {
        // $handler = $this->_db_handler;
        $handler = new MYSQLHandler(__USER_TABLE__);
        $data = $handler->search('is_online', 1);
        return $data;
    }
}
