<?php
namespace dwes\core;

class Request
{
    /**
     * Obté la URI de la solicitut
     */
    public static function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    /**
     * Retorna el metode HTTP utilitzat(get,post...)
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
