<?php
class UserLogin{

    private $_password;
    private $_user_id;
    private $_db_handler;
    private $_user_type;

    public function __construct(){
        $this->_db_handler = new MYSQLHandler(__USER_TABLE__);
    }

    public function login_user($username, $password){
        // hash password
        if($this->is_user_exist($username))
        {
            $this->_user_id=$this->find_user_id($username);
            if($this->is_password_valid($password))
            {
                $this->_password = $password;
                $this->_user_type = $this->check_user_type();
                return true;
                //correct pass give them access
            }
            else
            {
                $this->_user_id=null;
                return false;
                //recheck your password
            }
        }
    }

    private function is_user_exist($username)
    {
        $id=$this->find_user_id($username);
        return ($id !== null)? true : false;
    }

    private function is_password_valid($hash_password){
        $handler = $this->_db_handler;
        if($entry=$handler->get_record_by_id($this->_user_id,__PRIMARY_KEY__))
        {
            $entry=$entry[0]; //getting first entry since the result is an array of arrays
            if($entry["user_password"]===$hash_password)//use password_verify ( string $password , string $hash )$entry["user_password"]===$hash_password  password_verify ( $hash_password, $entry["user_password"] )
            {//REVIEW: check this method
                return true;
            }
        }
        echo "wrong pass";
        return false;
    }

    // private function start_user_session(){
    //     if(isset($_SESSION))//REVIEW: check this (session_status() != PHP_SESSION_NONE)
    //     {
    //         echo "session";
    //         $this-> save_user_id_to_session();
    //     }
    // }

    private function save_user_id_to_session()
    {
        // if(!isset($_SESSION["user_id"]) && empty($_SESSION["user_id"]))
        // {
            $_SESSION["user_id"]=$this->_user_id; 
        // }
    }

    private function save_user_type_to_session()
    {
        if($this->_user_type === "member")
        {
            $_SESSION["is_admin"]=false;
        }
        else
        {
            $_SESSION["is_admin"]=true;
        }
    }

    // private function remember_user_pwd(){
    //     //save it in a cookie for a period of time
    //     //only invoked when user checks the checkbox
    // }

    public function get_user_type()
    {
        return $this->_user_type;
    }

    private function check_user_type()
    {
        $handler = $this->_db_handler;
        if($entry=$handler->get_record_by_id($this->_user_id,__PRIMARY_KEY__))
        {
            var_dump($entry);
            $entry=$entry[0];
            if($entry['isAdmin']== 0)
            {
                return "member";
            }
            else
            {
                return "admin";
            }
        }
    }

    private function create_new_user($user_info)//key value array
    {
        $user_info['isAdmin']=0;
        $this->_user_type = "member";
        
        $handler = $this->_db_handler; 
        $handler->save($user_info);

        $this->_user_id=$this->find_user_id($user_info['username']);

        $this->save_user_id_to_session();
        $this->save_user_type_to_session();
        //REVIEW:save pwd ?
    }

    private function find_user_id($username)
    {
        $handler = $this->_db_handler;
        if($user_id=$handler->search("username",$username))
        {
            $user_id=$user_id[0];
            return $user_id['user_id'];
        }
    }
    public function sign_up($user_info)
    {
        if(!$this->is_user_exist($user_info['username']))
        {
            $this->create_new_user($user_info);
            return true;
        }
        else
        {
            return false;
        }
    }

}
?>