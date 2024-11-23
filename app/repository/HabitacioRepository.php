<?php
namespace dwes\app\repository;

use dwes\app\entity\Habitacio;
use dwes\core\database\QueryBuilder;

class HabitacioRepository extends QueryBuilder{
        /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table = 'habitacio', string $classEntity = Habitacio::class)
    {
        parent::__construct($table, $classEntity);
    }


    public function guarda(Habitacio $habitacio){
        $fnGuardaHabitacio = function () use ($habitacio){
            $this->save($habitacio);
        };
        $this->executeTransaction($fnGuardaHabitacio);
    }
}