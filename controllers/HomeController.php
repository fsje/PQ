<?php

class HomeController extends Controller
{
    protected $parser;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {

        parent::__construct();
    }

    /**
     * @param array $params
     * @return array|void
     */
    public function index(array $params)
    {


        $this->templateParse($params['name']);

    }

    /**
     * @param array $params
     */
    public function getCategories(array $params)
    {
        $this->templateParse($params['name'], array(
            "siteName" => "Test",
            "siteTitle" => "test",
        ));
    }
}

