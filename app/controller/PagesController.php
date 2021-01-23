<?php


namespace App\controller;

use App\core\Controller;

class PagesController extends Controller
{

    public function home()
    {
        $this->load("/home/main");
    }

    public function quemSomos()
    {
        $this->load("/quem_somos/main");
    }

    public function contato()
    {
        $this->load("/contato/main");
    }

    public function produto()
    {
        $this->load("/produto/main");
    }

}