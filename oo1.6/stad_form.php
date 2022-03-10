<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

PrintHead();
PrintJumbo( $title = "Bewerk afbeelding", $subtitle = "" );
PrintNavbar();
?>

<div class="container">
    <div class="row">

        <?php
            if ( ! is_numeric( $_GET['img_id']) ) die("Ongeldig argument " . $_GET['img_id'] . " opgegeven");

            //get data
         //   $logger = new Logger();

        //    $dbm = new DBManager($logger);
            $sql = "select * from image where img_id=" . $_GET['img_id'] ;

            $data = $container->getDBmanager()->GetData( $sql);
            $row = $data[0]; //there's only 1 row in data

            //add extra elements
            $extra_elements['csrf_token'] = GenerateCSRF( "stad_form.php"  );
            $landdata = $container->getDBmanager()->GetData( "select lan_id, lan_land from land" );
            $extra_elements['select_land'] = MakeSelect( $fkey = 'img_lan_id',
                                                                                            $value = $row['img_lan_id'] ,
                                                                                            $sql = $landdata );


            //get template
            $output = file_get_contents("templates/stad_form.html");

            //merge
            $output = MergeViewWithData( $output, $data );
            $output = MergeViewWithExtraElements( $output, $extra_elements );

            $output = MergeViewWithErrors( $output, $container->getMessageService()->GetInputErrors() );
            $output = RemoveEmptyErrorTags( $output, $data );

            print $output;
        ?>

    </div>
</div>

</body>
</html>