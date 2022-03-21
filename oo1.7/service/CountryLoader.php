<?php

class CountryLoader
{

    private PDO $pdo;


    /**
     * @param $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return array
     */
    public function getCountries() : array
    {

        $counrtyData = $this->queryForCountries();


        foreach ($counrtyData as $counrtyData){

            $countries[] = $this->createCountryFromData($counrtyData);
        }

        return $countries;

    }


    public function getCountryByID($id)
    {


        $statement = $this->pdo->prepare('SELECT * FROM land WHERE img_id = :id');
        $statement->execute(array('id' => $id));
        $countryArray = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$countryArray){
            return null;
        }
        return $this->createCountryFromData($countryArray);
    }



private function createCountryFromData($countryArray){

        $land = new Country();

        $land->setId($countryArray['lan_id']);
    $land->setName($countryArray['lan_land']);

    return $land;

}


    private function queryForCountries(){


        $statement = $this->pdo->prepare('SELECT * FROM land');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

}