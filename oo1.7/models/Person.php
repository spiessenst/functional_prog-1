<?php

abstract class Person
{

        private $id;
        private $naam;
        private $email;

    /**
     * @param $id
     * @param $naam
     * @param $email
     */
    public function __construct($id, $naam, $email)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * @param mixed $naam
     */
    public function setNaam($naam): void
    {
        $this->naam = $naam;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }


}
