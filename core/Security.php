<?php

namespace dwes\core;

class Security
{
    /**
     * Verifica si el usuari te un rol determinat
     */
    public static function isUserGranted(string $role): bool
    {
        if ($role === 'ROLE_ANONYMOUS')
            return true; // Cualquier usuario puede acceder
        $usuario = App::get('appUser'); // Obtenemos el usuario logueado
        if (is_null($usuario))
            return false; // No hay un usuario logueado
        $valor_role = App::get('config')['security']['roles'][$role]; // Rol mínimo que debe tener el usuario
        $valor_role_user = App::get('config')['security']['roles'][$usuario->getRole()]; // Buscamos el rol del usuario logueado
        return ($valor_role_user >= $valor_role);
    }

    /**
     * Encripta la password
     */
    public static function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    
    /**
     * Comprova si dos contrasenyes son iguals
     * @param string $password
     * @param string $bdPassword
     * @return bool
     */
    public static function checkPassword(string $password, string $bdPassword): bool
    {
        return password_verify($password, $bdPassword);
    }
}
