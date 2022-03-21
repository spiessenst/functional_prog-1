<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

$container->getHtmlElements()->PrintHead();
$container->getHtmlElements()->PrintJumbo( $title = "Profiel" ,
    $subtitle = "" );
$container->getHtmlElements()->PrintNavbar();
?>

<div class="container">
    <div class="row">

        <?php


            $user = $_SESSION['user'];

            //add extra elements
            $extra_elements['csrf_token'] = $container->getCSRF()->GenerateCSRF( "profile.php"  );



        $template = $container->Template("templates/profile.html");


        $output = $template->getTemplate();

            //merge
        $output = str_replace("@usr_id@" , $user->getId() , $output);
        $output = str_replace("@usr_voornaam@" , $user->getFirstname() , $output);
        $output = str_replace("@usr_naam@" , $user->getLastName(), $output);
        $output = str_replace("@usr_email@" , $user->getEmail(), $output);


            $output = $container->Merger()->MergeViewWithExtraElements( $output, $extra_elements );


            print $output;
        ?>

    </div>
</div>

</body>
</html>