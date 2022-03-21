<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = true;
require_once "lib/autoload.php";

$container->getHtmlElements()->PrintHead();
$container->getHtmlElements()->PrintJumbo( $title = "Registreren" ,
    $subtitle = "" );
$container->getHtmlElements()->PrintNavbar();

?>

<div class="container">
    <div class="row">

        <?php
            //get data
            if ( count($old_post) > 0 )
            {
                $data = [ 0 => [
                                             "usr_voornaam" => $old_post['usr_voornaam'],
                                             "usr_naam" => $old_post['usr_naam'],
                                             "usr_email" => $old_post['usr_email'],
                                             "usr_password" => $old_post['usr_password']
                                           ]
                              ];
            }
            else $data = [ 0 => [ "usr_voornaam" => "", "usr_naam" => "", "usr_email" => "", "usr_password" => "" ]];



        $template = $container->Template("templates/register.html");


            //add extra elements
            $extra_elements['csrf_token'] = $container->getCSRF()->GenerateCSRF( "register.php"  );

            //merge
            $output =  $container->Merger()->MergeViewWithData( $template->getTemplate(), $data );
            $output =  $container->Merger()->MergeViewWithExtraElements( $output, $extra_elements );

            $output =  $container->Merger()->MergeViewWithErrors( $output,  $container->getMessageService()->GetInputErrors());


            $output =  $container->Merger()->RemoveEmptyErrorTags( $output, $data );

            print $output;
        ?>

    </div>
</div>

</body>
</html>