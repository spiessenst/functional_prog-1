<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

require_once "./models/City.php";


PrintHead();
PrintJumbo();
PrintNavbar();
?>

<div class="container">
    <div class="row">

        <?php

        if ( ! is_numeric( $_GET['img_id']) ) die("Ongeldig argument " . $_GET['img_id'] . " opgegeven");

        $rows = GetData( "select * from image where img_id=" . $_GET['img_id'] );

        $city = new City($rows[0]['img_id'] , $rows[0]['img_title']  , $rows[0]['img_filename'] , $rows[0]['img_width'] ,$rows[0]['img_height'] ,$rows[0]['img_lan_id']);

        //get template
        $template = file_get_contents("templates/column_full.html");

        //merge
        $template  = str_replace("@img_title@" , $city->getTitle() , $template);
        $template  = str_replace("@img_filename@" , $city->getFilename() , $template);
        $template  = str_replace("@img_width@" , $city->getWidth() , $template);
        $template  = str_replace("@img_height@" , $city->getHeight() , $template);


       print $template;



        ?>

    </div>
</div>

</body>
</html>