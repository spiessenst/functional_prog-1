<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

PrintHead();
PrintJumbo( $title = "Profiel", $subtitle = "" );
PrintNavbar();
?>

<div class="container">
    <div class="row">

        <?php


            $user = $_SESSION['user'];

            //add extra elements
            $extra_elements['csrf_token'] = $container->getCSRF()->GenerateCSRF( "profile.php"  );



            //get template
            $output = file_get_contents("templates/profile.html");

            //merge
        $output = str_replace("@usr_id@" , $user->getId() , $output);
        $output = str_replace("@usr_voornaam@" , $user->getFirstname() , $output);
        $output = str_replace("@usr_naam@" , $user->getLastName(), $output);
        $output = str_replace("@usr_email@" , $user->getEmail(), $output);


            $output = MergeViewWithExtraElements( $output, $extra_elements );
           // $output = MergeViewWithErrors( $output, $errors );
           // $output = RemoveEmptyErrorTags( $output, $data );

            print $output;
        ?>

    </div>
</div>

</body>
</html>