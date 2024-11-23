<?php
namespace dwes\core;

use dwes\app\exceptions\AppException;
use dwes\core\database\Connection;
use dwes\core\database\QueryBuilder;

/**
 * Funciona com un contenidor de dependències estàtiques, on pots registrar,
 * accedir i gestionar servicis i objectes
 */
class App
{
    /**
     * @var array
     */
    private static $container = [];
    /**
     * Registre de dependències (enmagatzenar servicis)
     * @param string $key
     * @param $value
     * @return void
     */
    public static function bind(string $key, $value)
    {
        static::$container[$key] = $value;
    }

    /**
     * Accès a dependències
     * @param string $key
     * @return mixed
     * @throws AppException
     */
    public static function get(string $key)
    {
        if (!array_key_exists($key, static::$container))
            throw new AppException("No se ha encontrado la clave $key en el contenedor");
        return static::$container[$key];
    }
    /**
     * Conexió a la BD
     * @return PDO
     */
    public static function getConnection()
    {
        if (!array_key_exists('connection', static::$container))
            static::$container['connection'] = Connection::make();
        return static::$container['connection'];
    }


    /**
     * Obtindre una instancia de una classe repository
     */
    public static function getRepository(string $className): QueryBuilder
    {
        if (! array_key_exists($className, static::$container))
            static::$container[$className] = new $className();

        return static::$container[$className];
    }
}
