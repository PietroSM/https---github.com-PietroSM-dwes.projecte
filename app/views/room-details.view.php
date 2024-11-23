<!-- Room Details Section Begin -->
<section class="room-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="room-details-item">
                    <img src="img/room/room-details.jpg" alt="">
                    <div class="rd-text">
                        <div class="rd-title">
                            <h3><?= $habitacio->getNombre() ?></h3>
                            <div class="rdt-right">
                                <?php if ($habitacio->getidClient() == 0): ?>
                                    <a href="/reservar/<?php echo $habitacio->getId(); ?>">Booking Now</a>
                                <?php else: ?>
                                    <a href="#" disabled>RESERVADO</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <h2><?= $habitacio->getPrecio() ?>€<span>/Noche</span></h2>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="r-o">Tamaño:</td>
                                    <td><?= $habitacio->getTamanyo() ?>m<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacidad:</td>
                                    <td><?= $habitacio->getCapacidad() ?> Personas Máximo</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Localización:</td>
                                    <td><?= $habitacio->getLocalizacion() ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <p>
                            <img src="<?= $habitacio->getUrlSubidas() ?>" alt="">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Room Details Section End -->