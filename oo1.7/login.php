<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access =  true;
require_once "lib/autoload.php";

$container->getHtmlElements()->PrintHead();
$container->getHtmlElements()->PrintJumbo( $title = "Login" ,
    $subtitle = "" );

?>

<div class="container">
    <div class="row">

        <?php
            //get data
            $data = [ 0 => [ "usr_email" => "", "usr_password" => "" ]];

            //get template
         //   $output = file_get_contents("templates/login.html");

        $template = $container->Template("templates/login.html");

            //add extra elements
            $extra_elements['csrf_token'] = $container->getCSRF()->GenerateCSRF( "login.php"  );

            //merge
            $output = $container->Merger()->MergeViewWithData($template->getTemplate() , $data);
            $output = $container->Merger()->MergeViewWithExtraElements( $output, $extra_elements );

        $output = $container->Merger()->MergeViewWithErrors( $output,  $container->getMessageService()->GetInputErrors());

        $output = $container->Merger()->RemoveEmptyErrorTags( $output, $data );

            print $output;
        ?>

    </div>
</div>

</body>
</html>