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

    foreach ( $msgs as $msg )
    {
      print '<div class="msgs">' . $msg  . '</div>';
}

$container = new Container($configuration);
$CityLoader = $container->getCityLoader();
$city = $CityLoader->getCities();



    //get template
    $template = file_get_contents("templates/column.html");

    //merge
    $output = MergeViewWithDataObj( $template, $city );
    print $output;
?>

    </div>
</div>

</body>
</html>