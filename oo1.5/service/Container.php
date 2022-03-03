<?php

class Container
{

    private array $configuration;

    private  $pdo;

    private  $CityLoader;

    private $UserLoader;



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

}