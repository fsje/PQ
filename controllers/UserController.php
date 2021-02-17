<?php

class UserController extends Controller
{

    protected $accountNumber;
    protected $password;


    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
    }


    /**
     * @param array $params
     */

    public function getAllUsers()
    {
            $result = $this->model->getUsers();
            foreach($result as $key => $value){
                $result[$key] = $value;
            }
            return $result;
    }   

    public function authUser($accountNumber, $password)
    {
        $result = $this->model->authUser($accountNumber, $password);        
    }

    public function getUserByAccountNumber($accountNumber)
    {
        if(!empty($accountNumber))
        {
            $result = $this->model->getUserByAccountNumber($accountNumber);
            foreach($result as $key => $value){
                $result[$key] = $value;
            }
            return $result;
        }
    }

    public function getAccountByUserId($userid)
    {
        if(!empty($userid))
        {
            $result = $this->model->getAccountByUserId($userid);
            foreach($result as $key => $value){
                $result[$key] = $value;
            }
            return $result;
        }
    }

    public function addUserWithArray($data, $table)
    {
        return $this->model->addUserWithArray($data, $table);
    }

}
