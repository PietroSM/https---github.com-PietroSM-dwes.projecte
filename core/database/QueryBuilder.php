<?php

namespace dwes\core\database;

use dwes\app\entity\IEntity;
use dwes\app\exceptions\NotFoundException;
use dwes\app\exceptions\QueryException;
use dwes\core\App;
use PDO;
use PDOException;

/**
 * Classe abstracta que facilita la iteració amb la BD a travès de consultes SQL
 * utiltzant POO
 */
abstract class QueryBuilder
{

    private $table; //Nom de la taula
    private $classEntity; // nom de la classe a representar
    /**
     * @var PDO
     */
    private $connection;

    public function __construct(string $table, string $classEntity)
    {
        $this->connection = App::getConnection();
        $this->table = $table;
        $this->classEntity = $classEntity;
    }



    /**
     * @param string $tabla
     * @param string $classEntity
     * @return array
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM $this->table";

        return $this->executeQuery($sql);
    }


    /**
     * @param int $id
     * @return IEntity
     * @throws NotFoundException
     * @throws QueryException
     */
    public function find(int $id): IEntity
    {
        $sql = "SELECT * FROM $this->table WHERE id=$id";
        $result = $this->executeQuery($sql);
        if (empty($result))
            throw new NotFoundException("No se ha encontrado ningún elemento con id $id.");
        return $result[0]; // La consulta devolverá un array con 1 solo elemento.
    }

    /**
     * Executa una consulta sql i retorna una array d'objectes d'aquesta classe.
     * @param string $sql
     * @return array
     * @throws QueryException
     */
    private function executeQuery(string $sql, array $parameters = []): array
    {
        $pdoStatement = $this->connection->prepare($sql);
        if ($pdoStatement->execute($parameters) === false)
            throw new QueryException("No se ha podido ejecutar la query solicitada.");
        /* PDO::FETCH_CLASS indica que queremos que devuelva los datos en un array de clases. Los
        nombres
        de los campos de la BD deben coincidir con los nombres de los atributos de la clase.
        PDO::FETCH_PROPS_LATE hace que se llame al constructor de la clase antes que se asignen los
    valores. */
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }



    /**
     * @param IEntity $entity
     * @return void
     * @throws QueryException
     */
    public function save(IEntity $entity): void
    {
        try {
            $parametrers = $entity->toArray();
            $sql = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $this->table,
                implode(', ', array_keys($parametrers)),
                ':' . implode(', :', array_keys($parametrers))
            );
            $statement = $this->connection->prepare($sql);
            $statement->execute($parametrers);
        } catch (PDOException $exception) {
            throw new QueryException("Error al insertar en la base de datos.");
        }
    }


    /**
     * Permeteaix executar un conjunt de consultes sql en una transacció
     */
    public function executeTransaction(callable $fnExecuteQuerys)
    {
        try {
            $this->connection->beginTransaction();
            $fnExecuteQuerys(); // LLamamos a todas las consultas SQL de la transacción
            $this->connection->commit();
        } catch (PDOException $pdoException) {
            $this->connection->rollBack(); // Se deshacen todos los cambios desde beginTransaction()
            throw new QueryException("No se ha podido realizar la operación.");
        }
    }

    public function getUpdates(array $parameters)
    {
        $updates = '';
        foreach ($parameters as $key => $value) {
            if ($key !== 'id')
                if ($updates !== '')
                    $updates .= ", ";
            $updates .= $key . '=:' . $key;
        }
        return $updates;
    }
    public function update(IEntity $entity): void
    {
        try {
            $parameters = $entity->toArray();
            $sql = sprintf(
                'UPDATE %s SET %s WHERE id=:id',
                $this->table,
                $this->getUpdates($parameters)
            );
            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);
        } catch (PDOException $pdoException) {
            throw new QueryException("No se ha podido actualizar el elemento con id " . $parameters['id']);
        }
    }


    public function findBy(array $filters): array
    {
        $sql = "SELECT * FROM $this->table " . $this->getFilters($filters);
        return $this->executeQuery($sql, $filters);
    }

    public function getFilters(array $filters)
    {
        if (empty($filters)) return '';
        $strFilters = [];
        foreach ($filters as $key => $value)
            $strFilters[] = $key . '=:' . $key;
        return ' WHERE ' . implode(' and ', $strFilters);
    }

    public function findOneBy(array $filters): ?IEntity
    {
        $result = $this->findBy($filters);
        if (count($result) > 0)
            return $result[0];
        return null;
    }
}
