<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Eventos</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog-section blog-page spad">
    <div class="container">
        <div class="row">
            <?php foreach ($events as $event) : ?>
            <div class="col-lg-4 col-md-6">
                <div class="blog-item set-bg" data-setbg="<?= $event->getUrlSubidas() ?>">
                    <div class="bi-text">
                        <span class="b-tag">Travel Trip</span>
                        <h4><a href="./blog-details.html"><?=$event->getNombre()?></a></h4>
                        <div class="b-time"><i class="icon_clock_alt"></i><?=$event->getFecha()?></div>
                    </div>
                </div>
            </div>
            <?php endforeach;  ?>
        </div>
    </div>
</section>
<!-- Blog Section End -->