<?php

namespace dwes\app\repository;

use dwes\app\entity\Event;
use dwes\core\database\QueryBuilder;

class EventRepository extends QueryBuilder{
            /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table = 'event', string $classEntity = Event::class)
    {
        parent::__construct($table, $classEntity);
    }


    public function guarda(Event $event){
        $fnGuardaEvent = function () use ($event){
            $this->save($event);
        };
        $this->executeTransaction($fnGuardaEvent);
    }
}