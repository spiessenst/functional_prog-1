<?php

class City
{

    private int $id;

    private string  $title;

    private string $filename;

    private int $width;

    private int $height;

    private $land;

    /**
     * @param $id
     * @param $title
     * @param $filename
     * @param $width
     * @param $height
     * @param $land
     */
    public function __construct($id, $title, $filename, $width, $height, $land)
    {
        $this->id = $id;
        $this->title = $title;
        $this->filename = $filename;
        $this->width = $width;
        $this->height = $height;
        $this->land = $land;
    }

    /**
     * @return int
     */
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return  strtoupper($this->title);

    }

    /**
     * @param string $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getLand()
    {
        return $this->land;
    }

    /**
     * @param mixed $land
     */
    public function setLand($land): void
    {
        $this->land = $land;
    }


}



