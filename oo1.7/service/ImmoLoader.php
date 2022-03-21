<?php

class ImmoLoader implements Loader
{

private PDO $pdo;

private ImageLoader $images;

public function __construct(PDO $pdo , ImageLoader $images)
{
    $this->pdo = $pdo;
    $this->images = $images;
}


    /**
     * @return array
     */
    public function getAllImmo() : array
    {
        $AllImmo = $this->queryForData('SELECT *  from immo

inner join stad s on immo.immo_stad_id = s.stad_id
inner join makelaar m on immo.immo_makelaar_id = m.makelaar_id
inner join type t on immo.immo_typevastgoed_id = t.type_id
inner join foto f on immo.immo_id = f.foto_immo_id
group by immo_id');

        foreach ($AllImmo as $immo){

            $AllImmoObjects[] = $this->createObjectFromData($immo);
        }

        return $AllImmoObjects;

    }

    /**
     * @return array
     */
    public function getSomeImmo($name) : array
    {


        if($name == null || $name == "" ||  $name == "Kies je Stad") return $this->getAllImmo();

        $AllImmo = $this->queryForData('SELECT *  from immo

inner join stad s on immo.immo_stad_id = s.stad_id
inner join makelaar m on immo.immo_makelaar_id = m.makelaar_id
inner join type t on immo.immo_typevastgoed_id = t.type_id
inner join foto f on immo.immo_id = f.foto_immo_id
where stad_naam  = "'.$name.'"
group by immo_id');


        foreach ($AllImmo as $immo){

            $AllImmoObjects[] = $this->createObjectFromData($immo);
        }

        return $AllImmoObjects;

    }


    public function getImmoByID($id)
    {
        $SingleImmo = $this->queryForData('SELECT *  from immo

inner join stad s on immo.immo_stad_id = s.stad_id
inner join makelaar m on immo.immo_makelaar_id = m.makelaar_id
inner join type t on immo.immo_typevastgoed_id = t.type_id
inner join foto f on immo.immo_id = f.foto_immo_id
where immo_id =' .$id);

        foreach ($SingleImmo as $immo){

            $AllImmoObjects[] = $this->createObjectFromData($immo);
        }

        return $AllImmoObjects;


    }


    public function createObjectFromData(array $Array){

      if ($Array['type_id'] == 1 ){

          $immo = new Huis();

          $immo->setKeuring($Array['immo_keuring']);
          $immo->setEpc($Array['immo_epc']);
          $immo->setBouwjaar(new DateTime($Array['immo_bouwjaar']));


      }


        if ($Array['type_id'] == 2 ){

            $immo = new Appartement();

            $immo->setKeuring($Array['immo_keuring']);
            $immo->setEpc($Array['immo_epc']);
            $immo->setBouwjaar(new DateTime($Array['immo_bouwjaar']));


        }



        if ($Array['type_id'] == 3){

            $immo = new Grond();


        }

        $immo->setId($Array['immo_id']);
        $immo->setTitle($Array['immo_title']);
        $immo->setOmschrijving($Array['immo_omschrijving']);
        $immo->setPrijs($Array['immo_prijs']);
        $immo->setOppervlakte($Array['immo_oppervlakte']);
        $immo->setPrijs($Array['immo_prijs']);
        $immo->setStraat($Array['immo_straat']);
        $immo->setNr($Array['immo_nr']);
        $immo->setPostcode($Array['stad_postcode']);
        $immo->setStad($Array['stad_naam']);
        $immo->setImmotype($Array['immo_typevastgoed_id']);

        $immo->setMakelaar(new Makelaar($Array['makelaar_id'] , $Array['makelaar_naam'] , $Array['makelaar_email'] , $Array['makelaar_www']));

        $immo->setFotos( $this->images->getAllImages($Array['immo_id']));



      return $immo;
    }





    public function queryForData($sql){
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }


}