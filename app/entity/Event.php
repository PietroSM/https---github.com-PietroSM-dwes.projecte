<?php
namespace dwes\app\entity;


class Event implements IEntity{
    const RUTA_IMAGEN_EVENTO_SUBIDAS = '/public/images/eventos/';

    private $id;
    private $nombre;
    private $fecha;
    private $descripcion;
    private $nombreImagen;
    private $localizacion;


    public function __construct(
        $nombre = "",
        $fecha = "",
        $descripcion = "",
        $nombreImagen = "",
        $localizacion = ""
    )
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
        $this->nombreImagen = $nombreImagen;
        $this->localizacion = $localizacion;
    }

    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function getLocalizacion(){
        return $this->localizacion;
    }
    public function getNombreImagen(){
        return $this->nombreImagen;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
        return $this;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
        return $this;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
        return $this;
    }
    public function setLocalizacion($localizacion){
        $this->localizacion = $localizacion;
        return $this;
    }
    public function setNombreImagen($nombreImagen){
        $this->nombreImagen = $nombreImagen;
        return $this;
    }

    public function getUrlSubidas()
    {
        return self::RUTA_IMAGEN_EVENTO_SUBIDAS . $this->getNombreImagen();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'fecha' => $this->getFecha(),
            'descripcion' => $this->getDescripcion(),
            'localizacion'=> $this->getLocalizacion(),
            'nombreImagen' => $this->getNombreImagen()  
        ];
    }

}