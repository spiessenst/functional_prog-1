<?php

class UserLoader {
    private PDO $pdo;


    /**
     * @param $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }



    public function getUserByEmail($email)
    {

        $statement = $this->pdo->prepare('SELECT * FROM user WHERE usr_email = :email');
        $statement->execute(array('email' => $email));
        $userArray = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$userArray){
            return null;
        }
        return $this->createUserFromData($userArray);
    }


    private function createUserFromData(array $userArray){

        $user = new User($userArray['usr_id'] ,$userArray['usr_voornaam'] , $userArray['usr_naam'] , $userArray['usr_email'] );

        return $user;

    }



}