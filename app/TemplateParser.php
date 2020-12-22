<?php

/**
 * Class TemplateParser
 * A simple class to parse templates.
 */

class TemplateParser
{

    protected $file;
	protected $viewPath         = 'views/';     // Path for the views/ folder.
	protected $viewExtension    = '.php';   // Common file extension.
	protected $openingTag       = '{{';         // Opening tags. E.g. { or {{
	protected $closingTag       = '}}';         // Closing tags. E.g. } or }}
	protected $html;                            // Set $this->html

    protected $data;
    protected $stack;

    public $publicValues        = array();


    /**
     * TemplateParser constructor.
     * @param $view
     */
	public function __construct($view)
	{
		$this->file = $this->viewPath . $view . $this->viewExtension;
		if(file_exists($this->file))
		{
			$this->html = file_get_contents($this->file);

		}else{
			exit("Error occourd: Could not find speicifed view!");
		}
	}


    /**
     * @param array $data
     */
	public function recieveData(array $data)
	{
		if(count($data) > 0 && is_array($data))
		{
		    #print_r($data);
			foreach($data as $k => $v){
			    if(is_string($v)) {
                    $this->html = $this->parse($k, $v, $this->html);
                }else if(is_array($v)){
                    return json_encode($v);
                }

			}
		}
	}


	protected function parse($needle, $haystack, $property)
    {
        return str_replace($this->openingTag . $needle. $this->closingTag, $haystack, $property);
    }


    /**
     *
     */
	public function publish()
    {
        if (isset($this->html) && !empty($this->html)) {
            return $this->html;
        }
    }



}