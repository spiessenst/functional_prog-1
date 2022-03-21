<?php

class Appartement extends Immo
{

    private bool $keuring;

    private int $epc;

    private DateTime $bouwjaar;



    /**
     * @return string
     */
    public function isKeuring()
    {
        if  ($this->keuring == 1) return "JA";
        else return "NEE";
    }

    /**
     * @param bool $keuring
     */
    public function setKeuring(bool $keuring): void
    {
        $this->keuring = $keuring;
    }

    /**
     * @return int
     */
    public function getEpc(): int
    {
        return $this->epc;
    }

    /**
     * @param int $epc
     */
    public function setEpc(int $epc): void
    {
        $this->epc = $epc;
    }

    /**
     * @return DateTime
     */
    public function getBouwjaar(): DateTime
    {
        return $this->bouwjaar;
    }

    /**
     * @param DateTime $bouwjaar
     */
    public function setBouwjaar(DateTime $bouwjaar): void
    {
        $this->bouwjaar = $bouwjaar;
    }

    /**
     * @return string
     */

    public function getBouwjaarString()
    {
        return date_format($this->bouwjaar, 'Y');
    }

    /**
     *  @return string
     */

    public function getepcLabel()
    {
        if($this->getEpc() < 0) return "A+";
        if($this->getEpc() > 0  &&  $this->getEpc() < 100 ) return "A";
        if($this->getEpc() > 100  &&  $this->getEpc() < 200 ) return "B";
        if($this->getEpc() > 200  &&  $this->getEpc() < 300 ) return "C";
        if($this->getEpc() > 300  &&  $this->getEpc() < 400 ) return "D";
        if($this->getEpc() > 400  &&  $this->getEpc() < 500 ) return "E";
        if( $this->getEpc() > 500 ) return "F";

    }
}