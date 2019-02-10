<?php
class Member{
    private $_user_id;

    public function __construct($id)
    {
        $this->_user_id = $id;
    }

    public function get_member_information()
    {
        $handler = new  MYSQLHandler(__USER_TABLE__);
        $info = $handler->get_record_by_id($this->_user_id,__PRIMARY_KEY__);
        return $info[0];
    }

    public function update_member_information($user_data)
    {
        $handler = new  MYSQLHandler(__USER_TABLE__);
        if ($handler->update($user_data, __PRIMARY_KEY__, $this->_user_id))
        {
            return true; //updated user data successfully
        }
        else
        {
            return false; //couldnt update or smth went wrong
        }
    }
}
?>
