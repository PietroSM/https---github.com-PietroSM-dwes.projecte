<?php

namespace dwes\app\controllers;

use dwes\app\entity\Habitacio;
use dwes\app\exceptions\AppException;
use dwes\app\exceptions\FileException;
use dwes\app\exceptions\QueryException;
use dwes\app\exceptions\ValidationException;
use dwes\app\repository\HabitacioRepository;
use dwes\app\utils\File;
use dwes\core\App;
use dwes\core\helpers\FlashMessage;
use dwes\core\Response;

class HabitacioController
{
    //✔
    public function index(){
        $mensaje = FlashMessage::get('mensaje');
        $errores = FlashMessage::get('errores', []);

        $nombre = FlashMessage::get('nombre');
        $tamanyo = FlashMessage::get('tamanyo');
        $capacidad = FlashMessage::get('capacidad');
        $localizacion = FlashMessage::get('localizacion');
        $precio = FlashMessage::get('precio');

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
            'insertarHab',
            'layout',
            compact(
                'errores',
                'nombre',
                'tamanyo',
                'capacidad',
                'localizacion',
                'precio',
                'mensaje'
            )
        );
    }

    
    //✔
    public function guardarHab(){
        try{
            $nombre = trim(htmlspecialchars($_POST['nombre']));
            FlashMessage::set('nombre', $nombre);
            $tamanyo = trim(htmlspecialchars($_POST['tamanyo']));
            FlashMessage::set('tamanyo', $tamanyo);
            $capacidad = trim(htmlspecialchars($_POST['capacidad']));
            FlashMessage::set('capacidad', $capacidad);
            $localizacion = trim(htmlspecialchars($_POST['localizacion']));
            FlashMessage::set('localizacion', $localizacion);
            $precio = trim(htmlspecialchars($_POST['precio']));
            FlashMessage::set('precio', $precio);

            if(!empty($nombre) && !empty($tamanyo) && !empty($capacidad) &&
                !empty($localizacion) && !empty($precio) ){
                
                if(is_numeric($tamanyo) && is_numeric($capacidad) && is_numeric($precio)){
                    $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
                    $imagen = new File('imagen', $tiposAceptados);
            
                    $imagen->saveUploadFile(Habitacio::RUTA_IMAGEN_HABITACION_SUBIDAS);
            
                    $habitacio = new Habitacio($nombre, $tamanyo, $capacidad, 
                            $localizacion, $precio, $imagen->getFileName());
        
                    App::getRepository(HabitacioRepository::class)->guarda($habitacio);
        
                    $mensaje = "Se ha guardado una habitación: ". $habitacio->getNombre();
                    FlashMessage::set('mensaje', $mensaje);
        
        
                    FlashMessage::unset('nombre');
                    FlashMessage::unset('tamanyo');
                    FlashMessage::unset('capacidad');
                    FlashMessage::unset('localizacion');
                    FlashMessage::unset('precio');
                }else{
                    throw new ValidationException('Los campos tamanyo, capacidad y precio deben ser numericos');
                }

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
            App::get('router')->redirect('insertarHab');
        }
        App::get('router')->redirect('insertarHab');
    }


    //✔
    public function rooms(){
        try{
            $conexion = App::getConnection();
            $habitaciones = 
                App::getRepository(HabitacioRepository::class)->findAll();


        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        }

        Response::renderView(
            'rooms',
            'layout',
            compact(
                'habitaciones'
            )
        );
    }


    //✔
    public function showRoom($id){
        try{
            $habitacio = App::getRepository(HabitacioRepository::class)->find($id);

        }catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        }


        Response::renderView(
            'room-details',
            'layout',
            compact(
                'habitacio'
            )
            );
    }

    //✔
    public function reservar($id){
        $habitacio = App::getRepository(HabitacioRepository::class)->find($id);
        $habitacio->setIdClient($_SESSION['loguedUser']);
        App::getRepository(HabitacioRepository::class)->update($habitacio);
        App::get('router')->redirect('');
    }
}
