<?php
$request_uri = explode("/", $_SERVER['REQUEST_URI']);
$app_root = "/" . $request_uri[1] . "/" . $request_uri[2];


$path2 = $_SERVER["DOCUMENT_ROOT"] . $app_root;



require_once "$path2/models/City.php";
require_once "$path2/models/User.php";


session_start();

//print json_encode($_SERVER); exit;
$request_uri = explode("/", $_SERVER['REQUEST_URI']);
$app_root = "/" . $request_uri[1] . "/" . $request_uri[2];



require_once "connection_data.php";
require_once "pdo.php";
require_once "html_functions.php";
require_once "form_elements.php";
require_once "sanitize.php";
require_once "validate.php";
require_once "security.php";



//require_once "$path2/service/__UserLoader.php";
require_once "$path2/service/CityLoader.php";
require_once "$path2/service/Container.php";
require_once "$path2/service/DBManager.php";
require_once "$path2/service/Logger.php";
require_once "$path2/service/MessageService.php";


if(!isset($_SESSION["input_errors"])) $_SESSION["input_errors"] = [];
if(!isset($_SESSION["errors"])) $_SESSION["errors"] = [];
if(!isset($_SESSION["infos"])) $_SESSION["infos"] = [];

//$logger = new Logger();
//$ms = new MessageService();

require_once "access_control.php";


//$dbm = new DBManager($logger);

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
