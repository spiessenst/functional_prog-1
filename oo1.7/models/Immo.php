<?php

Abstract class Immo
{

        private int $id;

        private string $title;

        private string $omschrijving;

        private float $prijs;

        private float $oppervlakte;

        private string $straat;

        private string $nr;

        private string $postcode;

        private $stad;

        private $makelaar;

        private array $Fotos;

        private int $immotype;

    /**
     * @return float
     */
    public function getOppervlakte(): float
    {
        return $this->oppervlakte;
    }

    /**
     * @param float $oppervlakte
     */
    public function setOppervlakte(float $oppervlakte): void
    {
        $this->oppervlakte = $oppervlakte;
    }



    /**
     * @return int
     */
    public function getImmotype(): int
    {
        return $this->immotype;
    }

    /**
     * @param int $immotype
     */
    public function setImmotype(int $immotype): void
    {
        $this->immotype = $immotype;
    }






    /**
     * @return array
     */
    public function getFotos(): array
    {
        return $this->Fotos;
    }

    /**
     * @param array $Fotos
     */
    public function setFotos(array $Fotos): void
    {
        $this->Fotos = $Fotos;
    }



    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     */
    public function setPostcode(string $postcode): void
    {
        $this->postcode = $postcode;
    }




    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getOmschrijving(): string
    {
        return $this->omschrijving;
    }

    /**
     * @param string $omschrijving
     */
    public function setOmschrijving(string $omschrijving): void
    {
        $this->omschrijving = $omschrijving;
    }

    /**
     * @return float
     */
    public function getPrijs(): float
    {
        return $this->prijs ;
    }

    /**
     * @param float $prijs
     */
    public function setPrijs(float $prijs): void
    {
        $this->prijs = $prijs;
    }

    /**
     * @return string
     */
    public function getStraat(): string
    {
        return $this->straat;
    }

    /**
     * @param string $straat
     */
    public function setStraat(string $straat): void
    {
        $this->straat = $straat;
    }

    /**
     * @return string
     */
    public function getNr(): string
    {
        return $this->nr;
    }

    /**
     * @param string $nr
     */
    public function setNr(string $nr): void
    {
        $this->nr = $nr;
    }

    /**
     * @return mixed
     */
    public function getStad()
    {
        return $this->stad;
    }

    /**
     * @param mixed $stad
     */
    public function setStad($stad): void
    {
        $this->stad = $stad;
    }

    /**
     * @return Makelaar
     */
    public function getMakelaar()
    {
        return $this->makelaar;
    }

    /**
     * @param Makelaar $makelaar
     */
    public function setMakelaar(Makelaar $makelaar): void
    {
        $this->makelaar = $makelaar;
    }


    public function getFullAdres()
    {
       return $this->getStraat(). " " .$this->getNr(). " " . $this->getPostcode(). " ". $this->getStad();
    }



}