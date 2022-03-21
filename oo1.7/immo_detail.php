<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

$container->getHtmlElements()->PrintHead();
$container->getHtmlElements()->PrintJumbo( $title = "IMMO" ,
    $subtitle = "Detail" );
$container->getHtmlElements()->PrintNavbar();

?>

<div class="container">


    <div class="row">

            <?php



            $immo = $container->ImmoLoader()->getImmoByID($_GET['immo_id']);
            $immo = $immo[0];

          // print("<pre>".print_r($immo,true)."</pre>");
            ?>
            <h1 class="display-4"><?php print $immo->getTitle(); ?> </h1>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $fotos = $immo->getFotos();

                ?>

                <?php foreach ($fotos as $foto): ?>

                    <?php if ($foto->getbase() == 1 ): ?>
                    <div class="carousel-item active">
                    <?php else: ?>
                    <div class="carousel-item">
                    <?php endif; ?>
                        <img src="img/<?php print $foto->getPath(); ?>" class="d-block w-100" alt="">
                    </div>

                <?php endforeach; ?>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

                <p class="lead">
                    <?php print $immo->getOmschrijving(); ?>
                </p>

                <ul class="list-group list-group-flush">
                    <?php if ($immo->getimmotype() == 1 || $immo->getimmotype() == 2  ): ?>

                        <li class="list-group-item">EPC: <?php echo $immo->getepcLabel(); ?></li>
                        <li class="list-group-item">Bouwjaar:   <?php echo $immo->getbouwjaarString(); ?></li>
                        <li class="list-group-item">Elektrische keuring:   <?php echo $immo->isKeuring(); ?></li>

                    <?php endif ?>

                    <li class="list-group-item">Adres:  <?php print  $immo->getFullAdres() ?> </li>
                    <li class="list-group-item">Oppervlakte: <?php echo $immo->getOppervlakte(); ?>m2</li>

                </ul>

                <div class="card detail" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Contacteer de Makelaar</h5>
                        <p class="card-text"><?php echo ($immo->getMakelaar()->getnaam()) ?></p>
                        <p class="card-text"><a href=""><?php echo ($immo->getMakelaar()->getWww()) ?></a> </p>
                        <p class="card-text"><a href=""><?php echo ($immo->getMakelaar()->getEmail()) ?></a> </p>

                    </div>
                </div>


    </div>
</div>
</div>

<script>$('.carousel').carousel()</script>


</body>
</html>
