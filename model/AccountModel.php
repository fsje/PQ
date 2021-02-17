<?php

/**
 * Product Model
 * 
 * @author Frederik Eriksen
 * 
 */
class AccountModel extends model
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
    public function getAllAccounts($accountNumber)
    {
        $this->conn->where('accountNumber', $accountNumber);
        $products = $this->conn->get('pq_accounts');
        if ($this->conn->count > 0) {
            foreach ($products as $k => $v) {
                $this->properties[$v['id']] = $v;
            }
          return $this->properties;
        }
    }

    /**
     * getAccountByName
     * @param int $id product id
     * @return array
     */
    public function getAccountsById($id)
    {
        if(is_array($id)){
            $this->conn->where('id', $id, 'IN');
        }else{
            $this->conn->where('id', $id);
        }
        $result = $this->conn->get('pq_accounts');

        if($this->conn->count > 0){
            return $result;
        }else{
            exit('error');
        }
    }

        /**
     * getAccountIdByName
     * @param int $name account name
     * @return array
     */
    public function getAccountIdByName($name)
    {
        $this->conn->where('name', $name);
        $result = $this->conn->get('pq_accounts');
        if($this->conn->count > 0){
            return $result;
        }else{
            exit('error');
        }
    }

    public function getEveryAccount()
    {
            $products = $this->conn->get('pq_accounts');
            if ($this->conn->count > 0) {
                foreach ($products as $k => $v) {
                    $this->properties[$v['id']] = $v;
                }
              return $this->properties;
            }
    }

    public function addAccountWithArray($data, $table)
    {
        $id = $this->conn->insert($table, $data);
        if($id){
            return $id;
        }else{
            return 'insert failed: ' . $this->conn->getLastError();
        }
    }
}