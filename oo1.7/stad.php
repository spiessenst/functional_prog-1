<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";


$container->getHtmlElements()->PrintHead();
$container->getHtmlElements()->PrintJumbo( $title = "Stad" ,
    $subtitle = "" );
$container->getHtmlElements()->PrintNavbar();
?>

<div class="container">
    <div class="row">

        <?php

        if ( ! is_numeric( $_GET['img_id']) ) die("Ongeldig argument " . $_GET['img_id'] . " opgegeven");



     //   $pdo = new PDO( 'mysql:host=localhost;dbname=steden' , 'root' , 'root');

        $container = new Container($configuration);
        $CityLoader = $container->getCityLoader();

        $city = $CityLoader->getCityByID($_GET['img_id']);
        $cities =[$city];

        //get template
        $template = file_get_contents("templates/column_full.html");

        //merge

        $template = MergeViewWithDataObj($template , $cities);

       print $template;

        ?>

    </div>
</div>

</body>
</html>