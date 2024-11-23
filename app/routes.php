<?php

$router->get('', 'PagesController@index');
$router->get('insertarHab','HabitacioController@index', 'ROLE_ADMIN');
$router->post('guardarHab', 'HabitacioController@guardarHab', 'ROLE_ADMIN');
$router->get('rooms', 'HabitacioController@rooms');
$router->get('rooms/:id', 'HabitacioController@showRoom', 'ROLE_USER');
$router->post('habDisponibles', 'PagesController@habDisponibles');
$router->get('insertarEvent', 'EventController@index', 'ROLE_ADMIN');
$router->post('guardarEvent', 'EventController@guardarEvent', 'ROLE_ADMIN');
$router->get('event','EventController@showEvents');
$router->get('registrar', 'UsuariController@registro');
$router->post('checkRegistro', 'UsuariController@checkRegistro');
$router->get('login', 'UsuariController@login');
$router->post('checkLogin', 'UsuariController@checkLogin');
$router->get('logout', 'UsuariController@logout');
$router->get('reservar/:id', 'HabitacioController@reservar', 'ROLE_USER');
$router->get('reservas', 'PagesController@misReservas', 'ROLE_USER');