<?php
namespace dwes\app\entity;

use dwes\app\entity\IEntity;

class Habitacio implements IEntity{
    const RUTA_IMAGEN_HABITACION_SUBIDAS = '/public/images/habitaciones/';

    private $id;
    private $nombre;
    private $tamanyo;
    private $capacidad;
    private $localizacion;
    private $precio;
    private $nombreImagen;
    private $idClient;


    public function __construct(
        $nombre = "",
        $tamanyo = 0,
        $capacidad = 0,
        $localizacion = "",
        $precio = 0,
        $nombreImagen = "",
    )
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->tamanyo = $tamanyo;
        $this->capacidad = $capacidad;
        $this->localizacion = $localizacion;
        $this->precio = $precio;
        $this->nombreImagen = $nombreImagen;
        $this->idClient = null;
    }


    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getTamanyo(){
        return $this->tamanyo;
    }
    public function getCapacidad(){
        return $this->capacidad;
    }
    public function getLocalizacion(){
        return $this->localizacion;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getNombreImagen(){
        return $this->nombreImagen;
    }
    public function getIdClient(){
        return $this->idClient;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
        return $this;
    }
    public function setTamanyo($tamanyo){
        $this->tamanyo = $tamanyo;
        return $this;
    }
    public function setCapacidad($capacidad){
        $this->capacidad = $capacidad;
        return $this;
    }
    public function setLocalizacion($localizacion){
        $this->localizacion = $localizacion;
        return $this;
    }
    public function setPrecio($precio){
        $this->precio = $precio;
        return $this;
    }
    public function setNombreImagen($nombreImagen){
        $this->nombreImagen = $nombreImagen;
        return $this;
    }
    public function setIdClient($idClient){
        $this->idClient = $idClient;
        return $this;
    }


    public function getUrlSubidas()
    {
        return self::RUTA_IMAGEN_HABITACION_SUBIDAS . $this->getNombreImagen();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'tamanyo' => $this->getTamanyo(),
            'capacidad'=> $this->getCapacidad(),
            'localizacion'=> $this->getLocalizacion(),
            'precio' => $this->getPrecio(),
            'nombreImagen' => $this->getNombreImagen(),
            'idClient' => $this->getIdClient()
        ];
    }



}