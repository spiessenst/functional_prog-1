<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

$container->getHtmlElements()->PrintHead();
$container->getHtmlElements()->PrintJumbo( $title = "IMMO" ,
    $subtitle = "" );
$container->getHtmlElements()->PrintNavbar();

?>

<div class="container">



    <div class="row">

        <?php

        print $container->StadLoader()->GiveCitySelect();


        $template = $container->Template("templates/card.html");

        if (isset($_POST['stad_naam'])) {

            $output = $container->Merger()->MergeViewWithObjectData( $template->getTemplate(), $container->ImmoLoader()->getSomeImmo($_POST['stad_naam']) );
        }

        else{

            $output = $container->Merger()->MergeViewWithObjectData( $template->getTemplate(), $container->ImmoLoader()->getAllImmo() );
        }


        print $output;
        ?>

    </div>
</div>

</body>
</html>