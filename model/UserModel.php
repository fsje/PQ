<?php

/**
 * Product Model
 * 
 * @author Frederik Eriksen
 * 
 */
class UserModel extends model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * getProducts
     * @param string $type What type of product?
     * @return array
     */
    public function getUsers()
    {
        $users = $this->conn->get('pq_users');
        if ($this->conn->count > 0) {
            foreach ($users as $k => $v) {
                $this->properties[$v['id']] = $v;
            }
          return $this->properties;
        }
    }


    /**
     * getUserByAccountNumber
     */

     public function getUserByAccountNumber($accountNumber)
     {
        if(!empty($accountNumber))
        {
            $this->conn->where('accountNumber', $accountNumber);
            $users = $this->conn->get('pq_users');
            if($this->conn->count > 0) {
                return $users;
            }
            return false;
        }
        return false;
     }

    public function authUser($accountNumber, $password)
    {
        if(!empty($accountNumber) && !empty($password))
        {
            $users = $this->getUserByAccountNumber($accountNumber);
            if($users){
                foreach($users as $k => $v)
                {
                    if($accountNumber == $v['accountNumber'])
                    {
                        if(password_verify($password, $v['password']))
                        {
                            $_SESSION['userid'] = $v['id'];
                        }
                        
                    }else{
                        exit("error");
                    }
                }
            }else{
                exit("error");
            }

        }
    }
}