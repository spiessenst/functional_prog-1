<?php
$request_uri = explode("/", $_SERVER['REQUEST_URI']);
$app_root = "/" . $request_uri[1] . "/" . $request_uri[2];


$path2 = $_SERVER["DOCUMENT_ROOT"] . $app_root;

require_once "$path2/models/Stad.php";
require_once "$path2/models/Image.php";
require_once "$path2/models/Immo.php";
require_once "$path2/models/Appartement.php";
require_once "$path2/models/Person.php";
require_once "$path2/models/Makelaar.php";
require_once "$path2/models/Huis.php";
require_once "$path2/models/Grond.php";
require_once "$path2/models/City.php";
require_once "$path2/models/User.php";
require_once "$path2/models/Template.php";
require_once "$path2/models/Country.php";


session_start();

//print json_encode($_SERVER); exit;
$request_uri = explode("/", $_SERVER['REQUEST_URI']);
$app_root = "/" . $request_uri[1] . "/" . $request_uri[2];




//require_once "$path2/service/UserLoader.php";


require_once "$path2/service/Loader.php";
require_once "$path2/service/ImageLoader.php";
require_once "$path2/service/ImmoLoader.php";
require_once "$path2/service/StadLoader.php";
require_once "$path2/service/CityLoader.php";
require_once "$path2/service/CountryLoader.php";
require_once "$path2/service/Container.php";
require_once "$path2/service/DBManager.php";
require_once "$path2/service/Logger.php";
require_once "$path2/service/MessageService.php";
require_once "$path2/service/Sanitization.php";
require_once "$path2/service/CompareWithDatabase.php";
require_once "$path2/service/CSRF.php";
require_once "$path2/service/HtmlElements.php";
require_once "$path2/service/Merger.php";
require_once "$path2/service/FormElements.php";




if(!isset($_SESSION["input_errors"])) $_SESSION["input_errors"] = [];
if(!isset($_SESSION["errors"])) $_SESSION["errors"] = [];
if(!isset($_SESSION["infos"])) $_SESSION["infos"] = [];

require_once "access_control.php";

$configuration = array(

    'db_dsn' => 'mysql:host=localhost;dbname=steden',
    'db_user' => 'root',
    'db_pass' => 'root'

);

$container = new Container($configuration);


//initialize $old_post
$old_post = [];

if ( key_exists( 'OLD_POST', $_SESSION ) AND is_array( $_SESSION['OLD_POST']) )
{
    $old_post = $_SESSION['OLD_POST'];
    $_SESSION['OLD_POST'] = [];
}
