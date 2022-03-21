<?php

class CityLoader
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
    public function getCities() : array
    {

        $cityData= $this->queryForCities();


        foreach ($cityData as $cityData){

            $cities[] = $this->createCityFromData($cityData);
        }

        return $cities;

    }

    public function getCitiesArray() : array
    {

        $city= $this->queryForCities();


        foreach ($city as $cityData){

            $cities[] =$cityData;
        }

        return $cities;

    }

    public function getCityByID($id)
    {


        $statement = $this->pdo->prepare('SELECT * FROM image WHERE img_id = :id');
        $statement->execute(array('id' => $id));
        $cityArray = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$cityArray){
            return null;
        }
        return $this->createCityFromData($cityArray);
    }

    public function getCityByIDArray($id)
    {


        $statement = $this->pdo->prepare('SELECT * FROM image WHERE img_id = :id');
        $statement->execute(array('id' => $id));
        $cityArray = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$cityArray){
            return null;
        }

         $arr[] = $cityArray;
        return $arr;
    }



    private function createCityFromData(array $cityArray){

        $city = new City($cityArray['img_title']);
        $city->setId($cityArray['img_id']);
        $city->setFilename($cityArray['img_filename']);
        $city->setWidth($cityArray['img_width']);
        $city->setHeight($cityArray['img_height']);
        $city->setLand($cityArray['img_lan_id']);

        return $city;

    }



private function queryForCities(){


    $statement = $this->pdo->prepare('SELECT * FROM image');
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);

}



}