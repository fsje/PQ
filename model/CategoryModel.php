<?php
/**
 * Created by PhpStorm.
 * User: jomo
 * Date: 22/10/2018
 * Time: 10:07
 */


class CategoryModel extends model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCategories($type = false)
    {
        $categories = $this->conn->get('pq_categories');
       /* foreach($categories as $k => $v)
        {
            $this->dbdata[] = array(
                'id'        => $v['id'],
                'caption'   => $v['caption']
            );
        }*/

        return $categories;

    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
    }

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
    }

}