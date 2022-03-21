<?php

class ImageLoader implements Loader
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
    public function getAllImages($id) : array
    {
        $Images = $this->queryForData('SELECT * FROM foto WHERE foto_immo_id ='.$id);

        foreach ($Images as $image){

            $AllImages[] = $this->createObjectFromData($image);
        }

        return $AllImages;

    }


    public function createObjectFromData(array $Array)
    {
        $image = new Image($Array['foto_id'] ,$Array['foto_path'] , $Array['foto_base']  );

        return $image;
    }


    public function queryForData($sql)
    {

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

}