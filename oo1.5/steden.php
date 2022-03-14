<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

PrintHead();
PrintJumbo( $title = "Leuke plekken in Europa" ,
                        $subtitle = "Tips voor citytrips voor vrolijke vakantiegangers!" );
PrintNavbar();
//PrintMessages();
?>

<div class="container">
    <div class="row">

<?php


 $container->getMessageService()->ShowErrors();
 $container->getMessageService()->ShowInfos();


    //get template
    $template = file_get_contents("templates/column.html");

    //merge
    $output = MergeViewWithDataObj( $template, $container->getCityLoader()->getCities() );
    print $output;
?>

    </div>
</div>

</body>
</html>