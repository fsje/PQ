<?php
/**
 * Created by PhpStorm.
 * User: jomo
 * Date: 19/10/2018
 * Time: 08:16
 */


class ProductController extends Controller
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
        $this->model = new ProductModel();
    }


    /**
     * @param array $params
     */

    public function getProductsByType($type, $accountNumber)
    {
            $result = $this->model->getProducts($type, $accountNumber);
            if(isset($result)){
                foreach($result as $key => $value){
                    $result[$key] = $value;
                }
            }
            return $result;
    }   

    public function getProductById($product_id)
    {

        $result = $this->model->getProductById($product_id);
        foreach($result as $key => $value)
        {
            return $value;
        }
        
       # return $result;
    }

    public function getProductsByModel($model, $accountNumber)
    {

        $result = $this->model->getProductsByModel($model, $accountNumber);
        
        return $result;
    }

    public function getProductsByRelation($type, $product_id)
    {
        $result = $this->model->getProductsByRelation($type, $product_id);
        if($result > 0){
            foreach($result as $key => $value)
            {
                $result[$key] = $value;
            }
            
            return $result;
        }

    }

    public function getProductDetails($product_id)
    {
        $result = $this->model->getProductDetails($product_id);
        foreach($result as $key => $value)
        {
            $result[$key] = $value;
        }
        
        return $result;
    }

    public function searchProduct($term, $type)
    {
        switch($type){
            case 'packaging':
                $result = $this->model->getProductByTerm($term);
            break;

            case 'food':
                $result = $this->model->getFoodByTerm($term);
            break;

            case 'both':
                $result = $this->model->getProductByTerm($term);
                $result = $this->model->getFoodByTerm($term);
            break;

            default:
                $result = $this->model->getProductByTerm($term);
            break;
        }

        if(is_array($result)){
            return $result;
        }
    }

    public function updateProductByID($product_id, $data, $table, $identifier)
    {
       $this->model->updateProductByID($product_id, $data, $table, $identifier);
    }

    public function addProductWithArray($data, $table)
    {
        return $this->model->addProductWithArray($data, $table);
    }

    public function addMultipleProducts($table, $data)
    {
        return $this->model->addMultipleProducts($table, $data);
    }

    public function deleteProduct($productId){
        return $this->model->deleteProduct($productId);
    }

}
