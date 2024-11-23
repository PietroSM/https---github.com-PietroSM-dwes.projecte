<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero-text">
                    <h1>Sona A Luxury Hotel</h1>
                    <p>Here are the best hotel booking sites, including recommendations for international
                        travel and for finding low-priced hotel rooms.</p>
                    <a href="#" class="primary-btn">Discover Now</a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                <div class="booking-form">
                    <h3>Reservar un Hotel</h3>
                    <form action="habDisponibles" method="post">
                        <div class="check-date">
                            <label for="text">Ubicación:</label>
                            <input type="text" name="localizacion">
                        </div>
                        <div class="check-date">
                            <label for="text">Personas:</label>
                            <input type="text" name="persona">
                        </div>
                        <button>Consultar disponibilidad</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="/public/img/hero/hero-1.jpg"></div>
        <div class="hs-item set-bg" data-setbg="/public/img/hero/hero-2.jpg"></div>
        <div class="hs-item set-bg" data-setbg="/public/img/hero/hero-3.jpg"></div>
    </div>
</section>
<p></p>
<!-- Hero Section End -->

<!-- Home Room Section Begin -->
<section class="hp-room-section">
    <div class="container-fluid">
        <div class="hp-room-items">
            <div class="row">
                <?php foreach ($habitaciones as $habitacion) : ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="<?= $habitacion->getUrlSubidas() ?>">
                            <div class="hr-text">
                                <h3><?= $habitacion->getNombre() ?></h3>
                                <h2><?= $habitacion->getPrecio() ?>€<span>/Noche</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Tamaño:</td>
                                            <td><?= $habitacion->getTamanyo() ?>m<sup>2</sup></td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacidad:</td>
                                            <td><?= $habitacion->getCapacidad() ?> Personas Máximo</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Localización:</td>
                                            <td><?= $habitacion->getLocalizacion() ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="/rooms/<?= $habitacion->getId() ?>" class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;  ?>
            </div>
        </div>
    </div>
</section>
<!-- Home Room Section End -->

<!-- Blog Section Begin -->
<section class="blog-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Hotel News</span>
                    <h2>Our Blog & Event</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($eventos as $event) : ?>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="<?=$event->getUrlSubidas()?>">
                        <div class="bi-text">
                            <span class="b-tag">Travel Trip</span>
                            <h4><a href="#"><?=$event->getNombre()?></a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i><?=$event->getFecha()?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach;  ?>
        </div>
    </div>
</section>
<!-- Blog Section End -->