<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = true;
require_once "lib/autoload.php";

$container->getHtmlElements()->PrintHead();
$container->getHtmlElements()->PrintJumbo( $title = "Geen Toegang" ,
    $subtitle = "" );

?>

<div class="container">
    <div class="row">

<?php
    print "<div class='msgs'>U hebt helaas geen toegang! Probeer eventueel <a href=login.php>in te loggen</a></div>";
?>

    </div>
</div>

</body>
</html>