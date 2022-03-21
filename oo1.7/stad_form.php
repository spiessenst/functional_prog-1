<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

$container->getHtmlElements()->PrintHead();
$container->getHtmlElements()->PrintJumbo( $title = "Bewerk Afbeelding" , $subtitle = "" );
$container->getHtmlElements()->PrintNavbar();
?>

<div class="container">
    <div class="row">

        <?php
            if ( ! is_numeric( $_GET['img_id']) ) die("Ongeldig argument " . $_GET['img_id'] . " opgegeven");



            //add extra elements
            $extra_elements['csrf_token'] = $container->getCSRF()->GenerateCSRF( "stad_form.php"  );




        $landdata = $container->getCountryLoader()->getCountries();
              $value = $container->getCityLoader()->getCityByID($_GET['img_id']);





        $extra_elements['select_land'] = $container->getFormElements()->MakeSelect( $fkey = 'img_lan_id', $value ,  $landdata );


        $template = $container->Template("templates/stad_form.html");


        $output = $container->Merger()->MergeViewWithData( $template->getTemplate(),  $container->getCityLoader()->getCityByIDArray( $_GET['img_id']) );
        $output = $container->Merger()->MergeViewWithExtraElements( $output, $extra_elements  );
        $output = $container->Merger()->MergeViewWithErrors( $output, $container->getMessageService()->GetInputErrors() );
        $output = $container->Merger()->RemoveEmptyErrorTags( $output, $container->getCityLoader()->getCityByIDArray( $_GET['img_id']) );



            print $output;
        ?>

    </div>
</div>

</body>
</html>