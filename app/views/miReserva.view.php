<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Mis Reservas</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Rooms Section Begin -->
<section class="rooms-section spad">
    <div class="container">
        <div class="row">
            <?php foreach ($habitaciones as $habitacion) : ?>
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="<?= $habitacion->getUrlSubidas() ?>" alt="">
                        <div class="ri-text">
                            <h4><?= $habitacion->getNombre() ?></h4>
                            <h3><?= $habitacion->getPrecio() ?>€<span>/Noche</span></h3>
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
                            <a href="borrar/<?=$habitacion->getId()?>" class="primary-btn">Cancelar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach;  ?>
        </div>
    </div>
</section>
<!-- Rooms Section End -->