<?php

namespace dwes\app\controllers;

use dwes\app\entity\Usuari;
use dwes\app\exceptions\ValidationException;
use dwes\app\repository\UsuariRepository;
use dwes\core\App;
use dwes\core\helpers\FlashMessage;
use dwes\core\Response;
use dwes\core\Security;

class UsuariController
{

    //✔
    public function registro(){

        $errores = FlashMessage::get('registro-error', []);
        $mensaje = FlashMessage::get('mensaje');
        $username = FlashMessage::get('username');

        Response::renderView(
            'registrar',
            'layout',
            compact(
                'errores',
                'username',
                'mensaje'
            )
        );
    }


    //✔
    public function checkRegistro(){
        try {
            if (isset($_POST['captcha']) && ($_POST['captcha'] != "")) {
                if ($_SESSION['captchaGenerado'] != $_POST['captcha']) {
                    $mensaje = "¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo.";
                    FlashMessage::set('mensaje', $mensaje);
                } else {

                if (!isset($_POST['username']) || empty($_POST['username']))
                    throw new ValidationException('El nombre de usuario no puede estar vacío');
                FlashMessage::set('username', $_POST['username']);
                if (!isset($_POST['password1']) || empty($_POST['password1']))
                    throw new ValidationException('El password de usuario no puede estar vacío');
                if (
                    !isset($_POST['password2']) || empty($_POST['password2']) ||
                    $_POST['password1'] !== $_POST['password2']
                )
                    throw new ValidationException('Los dos password deben ser iguales');

                $usuari = new Usuari();
                $usuari->setUsername($_POST['username']);
                $usuari->setRole('ROLE_USER');
                $password = Security::encrypt($_POST['password1']);
                $usuari->setPassword($password);
                App::getRepository(UsuariRepository::class)->save($usuari);
                FlashMessage::unset('username');
                $mensaje = "Se ha creado el usuario: " . $usuari->getUsername();
                FlashMessage::set('mensaje', $mensaje);
                }

            }else{
                FlashMessage::set('mensaje', 'Debes introducir un captcha');
            }

        } catch (ValidationException $validationException) {
            FlashMessage::set('registro-error', [$validationException->getMessage()]);
            App::get('router')->redirect('registrar');
        }

        App::get('router')->redirect('registrar');

    }

    
     //✔
    public function login(){
        $errores = FlashMessage::get('login-error', []);
        $username = FlashMessage::get('username');

        Response::renderView(
            'logIn',
            'layout'
        );
    }


    //✔
    public function checkLogin(){
        try {
            if (!isset($_POST['usuario']) || empty($_POST['usuario']))
                throw new ValidationException('Debes introducir el usuario y el password');
            FlashMessage::set('username', $_POST['usuario']);

            if (!isset($_POST['password']) || empty($_POST['password']))
                throw new ValidationException('Debes introducir el usuario y el password');


            $usuario = App::getRepository(UsuariRepository::class)->findOneBy([
                'username' => $_POST['usuario']
            ]);


            if (!is_null($usuario) && Security::checkPassword($_POST['password'], $usuario->getPassword())) {
                // Guardamos el usuario en la sesión y redireccionamos a la página principal
                $_SESSION['loguedUser'] = $usuario->getId();
                FlashMessage::unset('username');
                App::get('router')->redirect('');
            }
        } catch (ValidationException $validationException) {
            FlashMessage::set('login-error', [$validationException->getMessage()]);
            App::get('router')->redirect('login'); // Redireccionamos al login
        }
    }

    //✔
    public function logout(){
        if (isset($_SESSION['loguedUser'])) {
            $_SESSION['loguedUser'] = null;
            unset($_SESSION['loguedUser']);
        }
        App::get('router')->redirect('');
    }
}
