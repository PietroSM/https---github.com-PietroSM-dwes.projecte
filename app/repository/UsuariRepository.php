<?php

namespace dwes\app\repository;

use dwes\app\entity\Usuari;
use dwes\core\database\QueryBuilder;

class UsuariRepository extends QueryBuilder{
        /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table = 'usuari', string $classEntity = Usuari::class)
    {
        parent::__construct($table, $classEntity);
    }
}