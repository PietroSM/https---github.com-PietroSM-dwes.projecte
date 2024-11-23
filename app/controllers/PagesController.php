<?php

namespace dwes\app\controllers;

use dwes\app\entity\Habitacio;
use dwes\app\exceptions\AppException;
use dwes\app\exceptions\FileException;
use dwes\app\exceptions\QueryException;
use dwes\app\repository\EventRepository;
use dwes\app\repository\HabitacioRepository;
use dwes\app\utils\Utils;
use dwes\core\App;
use dwes\core\helpers\FlashMessage;
use dwes\core\Response;

class PagesController{

    public function index(){
        try{

            $conexion = App::getConnection();
            $habitaciones = 
                App::getRepository(HabitacioRepository::class)->findAll();
            $habitaciones = Utils::extraeElementosAleatorios($habitaciones,4);

            $eventos =
                App::getRepository(EventRepository::class)->findAll();
            $eventos = Utils::extraeElementosAleatorios($eventos,3);


        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        }
        Response::renderView(
            'index',
            'layout',
            compact(
                'habitaciones',
                'eventos'
            )
        );
    }


    public function habDisponibles(){

        try{
            $localizacion = trim(htmlspecialchars($_POST['localizacion']));
            FlashMessage::set('localizacion', $localizacion);
            $persona = trim(htmlspecialchars($_POST['persona']));
            FlashMessage::set('persona', $persona);

            $arrayFiltros = [
                'localizacion' => strtolower($localizacion),
                'capacidad' => strtolower($persona)
            ];


            $habitaciones = 
                App::getRepository(HabitacioRepository::class)->findBy($arrayFiltros);

        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        }

        Response::renderView(
            'rooms',
            'layout',
            compact(
                'habitaciones'
            )
            );
    }



    public function misReservas(){

        $filtre = [
            'idClient' => $_SESSION['loguedUser']
        ];

        $habitaciones = App::getRepository(HabitacioRepository::class)->findBy($filtre);

        Response::renderView(
            'miReserva',
            'layout',
            compact(
                'habitaciones'
            )
        );
    }

}