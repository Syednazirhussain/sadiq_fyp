<?php

class user extends pdocrudhandler {
    
    public function __construct() {
        $this->_pdo = $this->connect();
    }

    public function signup ($fields = []) {

        $user = $this->insert('user', [
                             'name'         => $fields['name'],
                             'email'        => $fields['email'],
                             'phone'        => $fields['phone'],
                             'address'      => $fields['address'],
                             'password'     => md5($fields['password'])
                         ]);
        if ($user['status'] == 'success' && $user['rowsAffected'] == 1) {
            return true;
        }
        return false;
    }

    public function login($email, $password)
    {
        $password = md5($password);
        $res = $this->select('user', array("*"), "where email = ? and password = ?", array($email, $password));
        if ($res['status'] == 'success' && $res['rowsAffected'] == 1) {    
            $_SESSION['user'] = $res['result'][0];
            return true;
        }
        return false;
    }


}
?>
