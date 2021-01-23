<?php


namespace App\core;


use App\controller\MessageController;

class RouterCore
{
    private $uri;
    private $method;
    private $getArr = [];
    private $postArr = [];

    public function __construct()
    {
        $this->initialize();
        require_once "../app/config/Router.php";
        $this->execute();
    }

    private function initialize()
    {

        $this->method = $_SERVER["REQUEST_METHOD"];
        $uri = $_SERVER["REQUEST_URI"];

        if(strpos($uri,"?")){
            $uri = mb_substr($uri, 0, strpos($uri,"?"));
        }

        $ex = explode("/", $uri);

        $uri = $this->normalizeURI($ex);


        for ($i = 0; $i < UNSET_URI_COUNT; $i++){
            unset($uri[$i]);
        }

        $this->uri = implode("/",$this->normalizeURI($uri));

    }

    private function normalizeURI($arr)
    {
        return array_values(array_filter($arr));
    }

    private function get($router, $call)
    {
        $this->getArr[] = [
            "router" => $router,
            "call"   => $call
        ];

    }

    private function post($router, $call)
    {
        $this->postArr[] = [
            "router" => $router,
            "call"   => $call
        ];
    }

    private function execute()
    {

        switch ($this->method){

            case "GET":
                $this->executeGet();
                break;
            case "POST":
                $this->executePost();
                break;
        }
    }

    private function executeGet()
    {
        $cont = 0;

        foreach ($this->getArr as $get){

            $r = substr($get["router"], 1);


            if(substr($r, -1) == "/"){
                $r = substr($r,0, -1);
            }

            if($r == $this->uri){
                if(is_callable($get["call"])){
                    $get["call"]();
                    return;
                }

                $cont++;

                $this->executeController($get["call"]);

            }

        }

        if($cont == 0){
            (new MessageController())->message("Dados inválidos", "Verifique se a URL está digitada corretamente", 404);
            return;
        }

    }

    private function executePost()
    {
        foreach ($this->postArr as $post){

            $r = substr($post["router"], 1);

            if(substr($r, -1) == "/"){
                $r = substr($r,0, -1);
            }

            if($r == $this->uri){
                if(is_callable($post["call"])) {
                    $post["call"]();
                    return;
                }

                $this->executeController($post["call"]);
            }

        }

    }

    private function executeController($get)
    {

        $ex = explode("@", $get);


        if(!isset($ex[0]) || !isset($ex[1])){
            (new \App\Controller\MessageController())->message("Dados inválidos", "Controller ou método não encontrado: " . $get, 404);
            return;
        }

        $cont = "App\\controller\\" . $ex[0];

        if(!class_exists($cont)){
            (new \App\Controller\MessageController())->message("Dados inválidos", "Controller não encontrado: " . $get, 404);
            return;
        }

        if(!method_exists($cont, $ex[1])){
            (new \App\Controller\MessageController())->message("Dados inválidos", "Método não encontrado: " . $get, 404);
            return;
        }

        call_user_func_array([
            new $cont,
            $ex[1]
        ],[]);
    }
}