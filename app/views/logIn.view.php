<section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-1">
            <h2>LogIn</h2>
            <hr>
            <?php require_once __DIR__.'/show-error.part.view.php';
            ?>
                <form action="/checkLogin" method="post" enctype="multipart/form-data" class="contact-form">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" placeholder="Usuario" name="usuario">
                        </div>
                        <div class="col-lg-12">
                            <input type="password" placeholder="Password" name="password">
                        </div>
                        <div class="col-lg-12">
                            <button>Iniciar Sesión</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>