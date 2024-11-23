<?php
namespace dwes\core\helpers;

/**
 * Serveix per a gestionar els missatges flash, son missatges temporals
 * que asoles estan disponibles durant la pretició HTTP
 * Utilitzats per a msotrar missatges de tot funciona be o errors
*/
class FlashMessage
{
    /**
     * Recupera un missatge flash i l'elimina de la sessió.
     */
    public static function get(string $key, $default = '')
    {
        if (isset($_SESSION['flash-message'])) {
            $value = $_SESSION['flash-message'][$key] ?? $default;
            unset($_SESSION['flash-message'][$key]);
        } else
            $value = $default;
        return $value;
    }


    public static function set(string $key, $value)
    {
        $_SESSION['flash-message'][$key] = $value;
    }

    /**
     * Elimina un missatge flash sense recueprarlo.
     */
    public static function unset(string $key)
    {
        if (isset($_SESSION['flash-message']))
            unset($_SESSION['flash-message'][$key]);
    }
}
