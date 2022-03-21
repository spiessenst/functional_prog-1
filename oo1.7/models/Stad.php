<?php

class Stad
{

    private $id;

    private $naam;

    private $postcode;

    /**
     * @param $id
     * @param $naam
     */
    public function __construct($id, $naam ,$postcode)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->postcode = $postcode;
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
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostcode($postcode): void
    {
        $this->postcode = $postcode;
    }


}