<?php

class StadLoader implements Loader
{
private PDO $pdo;

public function __construct(PDO $pdo)
{
    $this->pdo = $pdo;
}

public function GiveCitySelect(){

    $cities = $this->getAllCities();
        $select =  '<form action="immo.php" method="post" ><select name="stad_naam" class="form-control">';

    $select .=  '<option >Kies je Stad</option>';

    foreach ($cities as $city){

            $select .=  '<option  value='.$city->getNaam().'>' . $city->getNaam(). '</option>';

        }

    $select .=  '</select><button type="submit">Zoeken</button></form>';

        return $select;

}

    /**
     * @return array
     */
    public function getAllCities() : array
    {
        $AllCities = $this->queryForData('SELECT *  from stad');

        foreach ($AllCities as $city){

            $AllCityObjects[] = $this->createObjectFromData($city);
        }

        return $AllCityObjects;

    }
    public function createObjectFromData(array $Array)
    {
        $cities = new Stad($Array['stad_id'] ,$Array['stad_naam'] , $Array['stad_postcode']   );

        return $cities;
    }


    public function queryForData($sql)
    {

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
}