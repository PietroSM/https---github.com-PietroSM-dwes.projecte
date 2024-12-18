<?php

use dwes\app\utils\Utils;
?>

<nav class="mainmenu mobile-menu">
    <ul>
        <li class="active"><a href="./index.html">Home</a></li>
        <li><a href="./rooms.html">Rooms</a></li>
        <li><a href="./about-us.html">About Us</a></li>
        <li><a href="./pages.html">Pages</a>
            <ul class="dropdown">
                <li><a href="./room-details.html">Room Details</a></li>
                <li><a href="#">Deluxe Room</a></li>
                <li><a href="#">Family Room</a></li>
                <li><a href="#">Premium Room</a></li>
            </ul>
        </li>
        <li><a href="./blog.html">News</a></li>
        <li><a href="./contact.html">Contact</a></li>
    </ul>
</nav>
<div id="mobile-menu-wrap"></div>
<div class="top-social">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-twitter"></i></a>
    <a href="#"><i class="fa fa-tripadvisor"></i></a>
    <a href="#"><i class="fa fa-instagram"></i></a>
</div>
</div>
<!-- Offcanvas Menu Section End -->

<!-- Header Section Begin -->
<header class="header-section">
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="./index.html">
                            <img src="/public/img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                <?php if (Utils::esOpcionMenuActiva('/') == true)
                                    echo '<li class="active">';
                                else echo '<li>'; ?>
                                <a href="/">Home</a></li>

                                <?php if (!is_null($app['user']) && 
                                $app['user']->getRole() == 'ROLE_ADMIN') : ?>

                                    <?php if (Utils::esOpcionMenuActiva('/insertarHab') == true)
                                        echo '<li class="active">';
                                    else echo '<li>'; ?>
                                    <a href="/insertarHab">Insertar Habitacón</a></li>

                                    <?php if (Utils::esOpcionMenuActiva('/insertarEvent') == true)
                                        echo '<li class="active">';
                                    else echo '<li>'; ?>
                                    <a href="/insertarEvent">Insertar Evento</a></li>

                                <?php endif; ?>


                                <?php if (Utils::esOpcionMenuActiva('/rooms') == true)
                                    echo '<li class="active">';
                                else echo '<li>'; ?>
                                <a href="/rooms">Habitaciones</a></li>

                                <?php if (Utils::esOpcionMenuActiva('/event') == true)
                                    echo '<li class="active">';
                                else echo '<li>'; ?>
                                <a href="/event">Eventos</a></li>




                                <?php if (is_null($app['user'])) : ?>
                                    <li class="<?= Utils::esOpcionMenuActiva('/registrar') ? 'active' : '' ?> lien">
                                        <a href="<?= Utils::esOpcionMenuActiva('/registrar') ? '#' : '/registrar' ?>">
                                            <i class="fa fa-sign-in sr-icons"></i> Registro</a>
                                    </li>

                                    <?php if (Utils::esOpcionMenuActiva('/login') == true)
                                        echo '<li class="active">';
                                    else echo '<li>'; ?>
                                    <a href="/login"><i class="fa fa-user-secret sr-icons"></i> logIn</a></li>
                                <?php else : ?>
                                    <?php if (Utils::esOpcionMenuActiva('/reservas') == true)
                                        echo '<li class="active">';
                                    else echo '<li>'; ?>
                                    <a href="/reservas">Mis Reservas</a></li>



                                    <?php if (Utils::esOpcionMenuActiva('/logout') == true) echo '<li class="active lien">';
                                    else echo '<li class=" lien">'; ?>
                                    <a href="/logout"><i class="fa fa-sign-out sr-icons"></i> <?= $app['user']->getUsername() ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->