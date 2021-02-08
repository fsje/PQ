<?php

/**
 * Product Model
 * 
 * @author Frederik Eriksen
 * 
 */
class ProductModel extends model
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
    public function getProducts($type, $accountNumber)
    {
        $this->conn->where('type', $type);
        $this->conn->where('accountNumber', $accountNumber);
        $this->conn->orderBy("sort_order","asc");
        $products = $this->conn->get('pq_products');
        if ($this->conn->count > 0) {
            foreach ($products as $k => $v) {
                $this->properties[$v['id']] = $v;
            }
          return $this->properties;
        }
    }

    /**
     * getProductById
     * @param int $id product id
     * @return array
     */
    public function getProductById($id)
    {
        if(is_array($id)){
            $this->conn->where('id', $id, 'IN');
        }else{
            $this->conn->where('id', $id);
        }
        $result = $this->conn->get('pq_products');

        if($this->conn->count > 0){
            return $result;
        }else{
            exit('error');
        }
    }

    /**
     * getProductDetails
     * @param int $product_id product id for detailed product.
     * @return array
     */
    public function getProductDetails($product_id)
    {
        if(is_array($product_id)){
            $this->conn->where('product_id', $product_id, 'IN');
        }else{
            $this->conn->where('product_id', $product_id);
        }
        $result = $this->conn->get('pq_products_details');

        if($this->conn->count > 0){
            foreach($result as $k => $v){
                return $v;
            }
        }else{
            exit('An error occourd with the following requested id: ' . $product_id);
        }
    }

    /**
     * getProductsByRelation
     * @param string $type product type.
     * @param string $product_id product id for detailed product.
     * @return array
     */
    public function getProductsByRelation($type, $product_id)
    {
        $this->conn->where('product_id', $product_id);
        $relations = $this->conn->get('pq_products_related');
        if($this->conn->count > 0){
            $relatedIds = array();
            foreach($relations as $key => $value)
            {
                $relatedIds[] = $value['related_id'];
            }
            $products = $this->getProductById($relatedIds);
        }else{
            return 'An error occourd!';
        }


        return $products;
    }


/**
 * GetProductsByModel
 */
public function getProductsByModel($model)
{
    if(is_array($model)){
        $this->conn->where('model', $model, 'IN');
    }else{
        $this->conn->where('model', $model);
    }
    $result = $this->conn->get('pq_products');

    if($this->conn->count > 0){
        return $result;
       
    }else{
        exit('error');
    }
}

    /**
     * getProductByTerm
     * @param string $term search term
     * @return array
     */
    public function getProductByTerm($term)
    {
        $data = array();    
        if(isset($term)){
            $this->conn->where('name', '%' . $term . '%', 'LIKE');
            $this->conn->orWhere('reitan', '%' . $term . '%', 'LIKE');
            $this->conn->orWhere('material', '%' . $term . '%', 'LIKE');
            $this->conn->orWhere('ean', '%' . $term . '%', 'LIKE');
            $this->conn->orWhere('model', '%' . $term . '%', 'LIKE');

            
            $data['details'] = $this->conn->get('searchproduct');
            
        }


        if($this->conn->count > 0){
            return $data;
        }

        return $result['error'] = 'error';
        
    }

    /**
     * updateProductByID
     * @param id
     * @return true or false
     */
    public function updateProductByID($product_id, $data, $table, $identifier){
       if(isset($product_id) && count($data) > 0)
       {
        $this->conn->where($identifier, $product_id);
           if($this->conn->update($table, $data))
           {
                echo $this->conn->count . ' records were updated';
           }else{
                echo 'Update failed: ' . $this->conn->getLastError();
                die();
           }
       }
    }

    /**
     * addProductWithArray
     * @param array data
     * 
     */
    public function addProductWithArray($data, $table)
    {
        $id = $this->conn->insert($table, $data);
        if($id){
            return $id;
        }else{
            return 'insert failed: ' . $this->conn->getLastError();
        }
    }

    /**
     * AddMultipleProducts
     */

     public function addMultipleProducts($data, $table)
     {
         $ids = $this->conn->insertMulti($table, $data);
         if(!$ids){
             echo 'insert failed: ' . $db->getLastError();
         } else {
             return $ids;
         }
     }

     public function deleteProduct($product_id)
     {
             $this->conn->where('id', $product_id);
             if($this->conn->delete('pq_products'))
             {
                 $this->conn->where('product_id', $product_id);
                 if($this->conn->delete('pq_products_details')){

                     $this->conn->where('product_id', $product_id);
                     if($this->conn->delete('pq_products_related')){
                         return true;
                 }
             }

        }
    }
       
}