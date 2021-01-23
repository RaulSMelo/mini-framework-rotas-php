<?php

namespace App\controller;


use App\core\Controller;
use App\classes\input;

class ProdutoController extends Controller
{

    /**
     * Carrega a página principal de produtos
     */
    public function index(){

        //$param = input::get("pes");

        $this->load("produto/main");
    }


    /**
     * Carrega a página com um formulário para cadastrar umm novo produto
     */
    public function novo(){

        $this->load("produto/novo");
    }

    /**
     * Carrega a página com um formulário para cadastrar umm novo produto
     */
    public function insert(){

        $params = $this->getInput();
    }

    /**
     * Realiza a busca na base de dados e exibe na página os resultados
     */
    public function pesquisar(){

        $param = input::get("pes");

        $this->load("produto/pesquisa", [
            "termo" => $param
        ]);
    }


    /**
     *
     * Retorna os dados do formulário em uma classe padrão stdObject
     *
     * @return object
     */
    private function getInput(){

        return(object)[
            "id"         => input::get("id", FILTER_SANITIZE_NUMBER_INT) ?? null,
            "nome"       => input::get("nome-produto") ?? null,
            "image"      => input::get("url-img") ?? null,
            "descricao"  => input::get("desc-prod") ?? null
        ];
    }


}