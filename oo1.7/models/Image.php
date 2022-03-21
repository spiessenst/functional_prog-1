<?php

class Image
{

    private $id;

    private $path;

    private $base;

    /**
     * @param $id
     * @param $path
     */
    public function __construct($id, $path , $base)
    {
        $this->id = $id;
        $this->path = $path;
        $this->base = $base;
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
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @param mixed $base
     */
    public function setBase($base): void
    {
        $this->base = $base;
    }







}

