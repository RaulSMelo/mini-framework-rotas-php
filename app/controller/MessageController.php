<?php


namespace App\controller;


use App\core\Controller;

class MessageController extends Controller
{

    public function message(string $title, string $message, $code)
    {
        http_response_code($code);
        $this->load("message/main",[
            "title"   => $title,
            "message" => $message
        ]);
    }

}