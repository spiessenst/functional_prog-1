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

}