<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

$container->getHtmlElements()->PrintHead();
$container->getHtmlElements()->PrintJumbo( $title = "Leuke plekken in Europa" ,
                        $subtitle = "Tips voor citytrips voor vrolijke vakantiegangers!" );
$container->getHtmlElements()->PrintNavbar();

?>

<div class="container">
    <div class="row">

<?php



 $container->getMessageService()->ShowErrors();
 $container->getMessageService()->ShowInfos();




    $template = $container->Template("templates/column.html");
   // $template->setTemplate();

    $output = $container->Merger()->MergeViewWithData( $template->getTemplate(), $container->getCityLoader()->getCitiesArray() );

    print $output;
?>

    </div>
</div>

</body>
</html>