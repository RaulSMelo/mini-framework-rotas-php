<?php


namespace App\classes;


class Input
{
    /**
     * Retorna um valor via parâmetro GET
     *
     * @param String $param
     * @param int $filter
     * @return mixed
     */
    public static function get(String $param, int $filter = FILTER_SANITIZE_STRING)
    {

        return filter_input(INPUT_GET, $param, $filter);

    }

    /**
     * Retorna um valor via parâmetro POST
     *
     * @param String $param
     * @param int $filter
     * @return mixed
     */
    public static function post(String $param, int $filter = FILTER_SANITIZE_STRING)
    {

        return filter_input(INPUT_POST, $param, $filter);

    }
}