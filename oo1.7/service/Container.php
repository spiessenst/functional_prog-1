<?php

class Container
{

    private array $configuration;

    private  $pdo;

    private  $CityLoader;

    private $UserLoader;

    private $Logger;

    private $DBmanager;

    private $MessageService;

    private $Sanitization;

    private $CompareWithDatabase;

    private $csrf;

    private $HtmlElements;

    private $merger;

    private $Template;

    Private $FormElements;

    Private $CountryLoader;

    private $ImmoLoader;

    private $ImageLoader;

    private $StadLoader;


    /**
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }


    /**
     * @return PDO
     */

    public function getPdo(){

        if($this->pdo === null){

            $this->pdo = new PDO( $this->configuration['db_dsn'] , $this->configuration['db_user'] , $this->configuration['db_pass']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        }
        return $this->pdo;
    }

    /**
     * @return CityLoader
     */

    public function getCityLoader() : CityLoader
    {
        if($this->CityLoader === null) {

            $this->CityLoader = new CityLoader($this->getPdo());

        }
        return $this->CityLoader;

    }


    /**
     * @return UserLoader
     */
    public function getUserloader() : UserLoader
    {
        if($this->UserLoader === null) {

            $this->UserLoader = new UserLoader($this->getPdo());

        }
        return $this->UserLoader;


    }

    /**
     * @return Logger
     */

    public function getLogger() : Logger
    {
        if($this->Logger === null){

            $this->Logger = new Logger();

        }
        return $this->Logger;
    }

    /**
     * @return DBManager
     */

    public function getDBmanager() : DBManager
    {
        if($this->DBmanager === null){

            $this->DBmanager = new DBmanager($this->getLogger() , $this->getPdo() );

        }

        return $this->DBmanager;
    }

    /**
     * @return MessageService
     */
    public function getMessageService() : MessageService
    {

        if($this->MessageService === null){

            $this->MessageService = new MessageService();

        }
        return $this->MessageService;
    }

    /**
     * @return Sanitization
     */

    public function getSanitization() : Sanitization

    {
        if($this->Sanitization === null){

            $this->Sanitization = new Sanitization();

        }
        return $this->Sanitization;

    }

    /**
     * @return CompareWithDatabase
     */
    public function getCompareWithDatabase() : CompareWithDatabase
    {
        if($this->CompareWithDatabase === null){

            $this->CompareWithDatabase = new CompareWithDatabase($this->getDBmanager() , $this->getMessageService());

        }
        return $this->CompareWithDatabase;

    }

    /**
     * @return CSRF
     */
    public function getCSRF() : CSRF
    {
        if($this->csrf === null){

            $this->csrf = new CSRF();

        }
        return $this->csrf;

    }

    /**
     * @return HtmlElements
     */
    public function getHtmlElements() : HtmlElements
    {
        if($this->HtmlElements === null){

            $this->HtmlElements = new HtmlElements();

        }
        return $this->HtmlElements;

    }


    /**
     * @return Merger
     */
    public function Merger() : Merger
    {
        if($this->merger === null){

            $this->merger = new Merger();

        }
        return $this->merger;

    }

    /**
     * @param $template
     * @return Template
     */

    public function Template($template) : Template
    {
        if($this->Template === null){

            $this->Template = new Template($template);

        }

        return $this->Template;

    }

    public function getFormElements() : FormElements
    {
        if($this->FormElements === null){

            $this->FormElements = new FormElements($this->getDBmanager());

        }

        return $this->FormElements;

    }


    /**
     * @return CountryLoader
     */

    public function getCountryLoader() : CountryLoader
    {
        if($this->CountryLoader === null) {

            $this->CountryLoader = new CountryLoader($this->getPdo());

        }
        return $this->CountryLoader;

    }

    /**
     * @return ImmoLoader
     */

    public function ImmoLoader() : ImmoLoader
    {
        if($this->ImmoLoader === null) {

            $this->ImmoLoader = new ImmoLoader($this->getPdo() , $this->ImageLoader());

        }
        return $this->ImmoLoader;

    }

    /**
     * @return ImageLoader
     */

    public function ImageLoader() : ImageLoader
    {
        if($this->ImageLoader === null) {

            $this->ImageLoader = new ImageLoader($this->getPdo());

        }
        return $this->ImageLoader;

    }

    /**
     * @return StadLoader
     */
    public function StadLoader() : StadLoader
    {
        if($this->StadLoader === null) {

            $this->StadLoader = new StadLoader($this->getPdo());

        }
        return $this->StadLoader;

    }

}