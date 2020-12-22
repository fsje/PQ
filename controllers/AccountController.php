<?php
/**
 * Created by PhpStorm.
 * User: jomo
 * Date: 19/10/2018
 * Time: 08:16
 */


class AccountController extends Controller
{

    protected $parser;
    protected $category;
    protected $model;


    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new AccountModel();
    }


    /**
     * @param array $params
     */

    public function getAccountIdByName($account)
    {

        $result = $this->model->getAccountIdByName($account);
    
        foreach($result as $key => $value)
        {
            return $value['id'];
        }
        
       # return $result;
    }


}
