<?php

    $this->get("/", "PagesController@home");

    $this->get("/quem_somos","PagesController@quemSomos" );

    $this->get("/contato","PagesController@contato");

    $this->get("/pesquisa","ProdutoController@pesquisar");

    $this->get("/produto","ProdutoController@index" );

    $this->get("/pesquisa","ProdutoController@pesquisar" );

    $this->get("/novo_produto","ProdutoController@novo" );

    $this->post("/insert_produto","ProdutoController@insert" );

