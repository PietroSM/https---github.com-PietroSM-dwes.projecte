<section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-1">
            <h2>Insertar Habitación</h2>
            <hr>
            <?php require_once __DIR__.'/show-error.part.view.php';
            ?>
                <form action="/guardarHab" method="post" enctype="multipart/form-data" class="contact-form">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" placeholder="nombre" name="nombre">
                        </div>
                        <div class="col-lg-12">
                            <input type="text" placeholder="tamanyo" name="tamanyo">
                        </div>
                        <div class="col-lg-12">
                            <input type="text" placeholder="capacidad" name="capacidad">
                        </div>
                        <div class="col-lg-12">
                            <input type="text" placeholder="localización" name="localizacion">
                        </div>
                        <div class="col-lg-12">
                            <input type="text" placeholder="precio" name="precio">
                        </div>
                        <div class="col-lg-12">
                            <input class="form-control-file" type="file" name="imagen">
                        </div>
                        <div class="col-lg-12">
                            <button>Añadir</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>