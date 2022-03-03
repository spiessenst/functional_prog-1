<?php

class Logger
{

    private $fp;
    private $logfile ;


    public function __construct($file="log.txt")
    {
        $this->logfile = $this->appRoot()."/log/$file";
        $this->fp = fopen($this->logfile, "a");
    }



    public function Log($msg)
    {
        $now = new DateTime();
        $date = $now->format('Y-m-d H:i:s');
        fwrite($this->fp, "$date - $msg\r\n");


    }


    public function ShowLog()
    {
        return nl2br(file_get_contents($this->logfile));
    }


    private function appRoot(){

        $request_uri = explode("/", $_SERVER['REQUEST_URI']);
        $app_root = "/" . $request_uri[1] . "/" . $request_uri[2];

       return $_SERVER["DOCUMENT_ROOT"] . $app_root;
    }
}