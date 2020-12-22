<?php


class Controller {
    protected $parser;
    protected $data         = array();
    protected $defaultData  = array(
            'siteName'	=> sitename,
            'siteTitle' => sitetitle,
);

    public $dynamicData     = array();

    public function __construct()
    {

    }

    public function index(array $params)
    {



        return $this->data;

    }

    public function templateParse($view, $data = null)
    {
        $this->parser = new TemplateParser($view);

        $this->data = $data;

        // Merge default & new data.
        if($data != null && count($this->data) > 0) {
            $this->data = array_merge($this->defaultData, $this->data);
        }else{
            $this->data = $this->defaultData;
        }

        // Parse it.
        $this->parser->recieveData($this->data);

        // Publish it.
        echo $this->parser->publish();

    }

    public function __get($name)
    {
        return $this->dynamicData[$name];
    }

    public function __set($name, $value)
    {
        $this->dynamicData[$name] = $value;
    }
}