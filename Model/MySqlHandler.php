<?php
class MySqlHandler implements DbHandler {
    private $_DB_handler;
    
    public function __construct(){
        $this->connect();
    }

    public function connect() {
        $handler = mysqli_connect(__HOST__, __USER__, __PASS__, __DB__);
        if($handler){
            $this->_DB_handler = $handler;
            return true;
        }
        else {
            return false;
        }        
    }

    public function disconnect() {
        if ($this->_DB_handler) {
            mysqli_close($this->_DB_handler);
        }
    }

    public function get_data($fields = array(), $start = 0) {
        $sql1 = "select ";
        $sql2 = "";
        $sql3 = "";
        $sql4 = " limit $start , ".__RECORDS_PER_PAGE__;
        if (empty($fields)) {
            $sql2 = "*";
            $sql3 = " from users where is_admin=0";
            $sql = $sql1.$sql2.$sql3.$sql4;
        }
        else {            
            foreach ($fields as $f) {
                $sql2 ="$f,";
                $sql3 = " from users";
                $sql = $sql1.$sql2.$sql3.$sql4;
                $sql = str_replace(", from", " from",$sql);
            }        
        }        
        return $this->get_results($sql);
    }
    
    private function get_results($sql){
        $handler_results = mysqli_query($this->_DB_handler, $sql);
        $array_results = array();
        if ($handler_results) {
            while ($row = mysqli_fetch_assoc($handler_results)) {
                $array_results[] = array_change_key_case($row);
            }
            $this->disconnect();
            return ($array_results);
         
        } else {
            $this->disconnect();
            return FALSE;
        }
    }
    
    public function get_record_by_id($value, $field) {
        $sql = "select * from users where $field = $value";
        return ($this->get_results($sql));
    }
    
    public function users_count() {
        $sql = "select count(*) from users where is_admin = 0";
        return ($this->get_results($sql));
    }
    
    public function get_record_by_username_and_password($username, $password) {
        $sql = "SELECT * FROM users WHERE username='".$username."' AND pass='".$password."'";
        return ($this->get_results($sql));
    }


    ///*asmaaaaa
    public function get_user_id($username){
        $sql="SELECT id FROM users WHERE username=$username";
            if($this->connect()){
                $user_id=mysqli_query($this->_DB_handler,$sql);
                return($user_id);
            }
            return false;
    }
    

    public function insert_user($username ,$password ,$name,$job,$image, $pdf)
    {
    $sql="INSERT INTO users (username, pass, name, job, image, cv) VALUES ('$username','$password','$name','$job','$image','$pdf')";

        if($this->connect())
        {
            $inserted=mysqli_query( $this->_DB_handler,$sql);
            return($inserted);
        }
        return false;
    }



    public function update_user($username,$name,$job,$id)
    {
        $sql = "UPDATE users SET username='$username' ,job='$job' ,name='$name'  where id=$id";

        if($this->connect())
            {
                $updated=mysqli_query( $this->_DB_handler,$sql);
                //var_dump($inserted);
                echo 'mkj';

                return($updated);
            }
            return false;
    }

    public function select_all(){
        $sql="select * from users";
        $selected_users=mysqli_query($this->_DB_handler,$sql);
        return $selected_users;
    }
}   