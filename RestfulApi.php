<?php

class RestfulApi
{
    protected $method = '';
    private $endpoint = '';
    private $params = array();
    
    public function __construct(){
        $this->input();
        $this->process_api();
    }

    public function input(){
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");

        $this->params   = explode('/', trim($_SERVER['PATH_INFO'],'/'));
        $this->endpoint = array_shift($this->params);

        // Lấy method của request
        $method         = $_SERVER['REQUEST_METHOD'];
        $allow_method   = array('COPY', 'PATCH', 'GET', 'POST', 'PUT', 'DELETE');

        if (in_array($method, $allow_method)){
            $this->method = $method;
        }
    }

    public function process_api(){        
        if (method_exists($this, $this->endpoint)){
            $this->{$this->endpoint}();
        }
        else {
            $this->response(500, "Unknown endpoint");
        }
    }
}
?>