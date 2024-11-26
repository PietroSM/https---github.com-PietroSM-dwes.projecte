<section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-1">
                <h2>Registrarse</h2>
                <hr>
                <?php require_once __DIR__ . '/show-error.part.view.php';
                ?>
                <form action="/checkRegistro" method="post" enctype="multipart/form-data" class="contact-form">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" placeholder="Usuario" name="username" value="<?=$username?>">
                        </div>
                        <div class="col-lg-12">
                            <input type="password" placeholder="Password" name="password1">
                        </div>
                        <div class="col-lg-12">
                            <input type="password" placeholder="Confirmar Password" name="password2">
                        </div>
                        <div class="col-lg-12">
                            <label class="label-control">Introduce el captcha <img style="border: 1px solid #D3D0D0 "
                                    src="/app/utils/captcha.php" id='captcha'></label>
                            <input class="form-control" type="text" name="captcha">
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