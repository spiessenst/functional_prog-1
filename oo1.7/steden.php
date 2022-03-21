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

 $data = $container->getCityLoader()->getCitiesArray();

$url_owm = "https://api.openweathermap.org/data/2.5/weather";


foreach ($data as $key => $row) {

    $stad = $row['img_weather_location'];

    $url = "$url_owm?q=$stad&lang=nl&units=metric&appid=3321b07339bef6f1a43a0f65b53db937";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);

    $response = json_decode($curl_response);

    $row['description'] = $response->weather[0]->description;
    $row['temp'] = $response->main->temp;
    $row['humidity'] = $response->main->humidity;

    $data[$key] = $row;

}
$template = $container->Template("templates/column.html");
   // $template->setTemplate();

    $output = $container->Merger()->MergeViewWithData( $template->getTemplate(), $data );

    print $output;
?>

    </div>
</div>

</body>
</html>