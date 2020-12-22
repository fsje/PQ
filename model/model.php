<?php
/**
 * Class Model
 */

use \MysqliDb as db;

class model extends db
{

    protected $conn;
    protected $dbdata = array();

    public $properties;


    /**
     * Model constructor.
     */
    public function __construct()
    {
   // Setup connection
        $this->conn = new db('localhost', 'root', '', 'pq');

    }
    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        echo 'Getting ' . $name;
        return $this->properties[$name];
    }
    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        echo 'Setting ' . $name . ' to ' . $value;
        $this->properties[$name] = $value;
    }

}
