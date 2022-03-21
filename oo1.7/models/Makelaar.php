<?php

class Makelaar extends Person
{

    private $www;

    public function __construct($id, $naam, $email , $www)
    {
        parent::__construct($id, $naam, $email);
        $this->www = $www;
    }

    /**
     * @return string
     */
    public function getWww()
    {
        return $this->www;
    }

    /**
     * @param string $www
     */
    public function setWww($www): void
    {
        $this->www = $www;
    }




}