<?php
namespace dwes\app\controllers;

use dwes\app\entity\Event;
use dwes\app\exceptions\AppException;
use dwes\app\exceptions\FileException;
use dwes\app\exceptions\QueryException;
use dwes\app\exceptions\ValidationException;
use dwes\app\repository\EventRepository;
use dwes\app\utils\File;
use dwes\core\App;
use dwes\core\helpers\FlashMessage;
use dwes\core\Response;

class EventController{

    //✔
    public function index(){
        $mensaje = FlashMessage::get('mensaje');
        $errores = FlashMessage::get('errores', []);
        $nombre = FlashMessage::get('nombre');
        $fecha = FlashMessage::get('fecha');
        $descripcion = FlashMessage::get('descripcion');
        $localizacion = FlashMessage::get('localizacion');

        try {
            $conexion = App::getConnection();
        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        }


        Response::renderView(
            'InsertarEvent',
            'layout',
            compact(
                'errores',
                'mensaje',
                'nombre',
                'fecha',
                'descripcion',
                'localizacion'
            )
        );
    }

    //✔
    public function guardarEvent(){
        try{
            $nombre = trim(htmlspecialchars($_POST['nombre']));
            FlashMessage::set('nombre', $nombre);
            $fecha = trim(htmlspecialchars($_POST['fecha']));
            FlashMessage::set('fecha', $fecha);
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));
            FlashMessage::set('descripcion', $descripcion);
            $localizacion = trim(htmlspecialchars($_POST['localizacion']));
            FlashMessage::set('localizacion', $localizacion);

            if(!empty($nombre) && !empty($fecha) && !empty($descripcion) &&
                !empty($localizacion)){

                    $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
                    $imagen = new File('imagen', $tiposAceptados);
        
                    $imagen->saveUploadFile(Event::RUTA_IMAGEN_EVENTO_SUBIDAS);
        
                    $event = new Event($nombre, $fecha, $descripcion, $imagen->getFileName(),
                                $localizacion);
                    
                    App::getRepository(EventRepository::class)->guarda($event);
                
                    $mensaje = "Se ha guardado un evento: ". $event->getNombre();
                    App::get('logger')->add($mensaje);
                    FlashMessage::set('mensaje', $mensaje);

                }else{
                    throw new ValidationException('Deberes Rellenar todos los campos');
                }


        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (ValidationException $validationException) {
            FlashMessage::set('errores', [$validationException->getMessage()]);
            App::get('router')->redirect('insertarEvent');
        }

        App::get('router')->redirect('insertarEvent');

    }


    //✔
    public function showEvents(){

        try{
            $events = App::getRepository(EventRepository::class)->findAll();

        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        }

        Response::renderView(
            'event',
            'layout',
            compact(
                'events'
            )
        );
    }


}