<?php

class MessageService
{
    private $errors;
    private $input_errors;
    private $infos;

    public function __construct()
    {

        $this->errors = $_SESSION["errors"];
        $this->input_errors = $_SESSION["input_errors"];
        $this->infos =  $_SESSION["infos"];

        unset($_SESSION['errors']);
        unset($_SESSION['input_errors']);
        unset($_SESSION['infos']);
    }


    public function CountNewErrors()
    {
        if ( isset($_SESSION['errors']) ) return count($_SESSION['errors']);

    }

    public function CountErrors()
    {
        return count($this->errors);

    }

    public function CountNewInputErrors()
    {
        if ( isset($_SESSION['input_errors']) ) return count($_SESSION['input_errors']);

    }


    public function GetInputErrors()
    {

        return $this->input_errors;
    }


    public function CountInfos()
    {
        return count($this->infos);

    }

    public function AddMessage( $type, $msg, $key = null )
    {

        if ( $type == "errors" )
        {
            $_SESSION["errors"][] = $msg;
        }

        if ( $type == "input_errors" )
        {
            $_SESSION["input_errors"][$key] = $msg;

        }
        if ( $type == "infos" )
        {
            $_SESSION["infos"][] = $msg;
        }
    }

    public function ShowErrors()
    {
        if ( $this->CountErrors() > 0 )
        {
            foreach ( $this->errors as $error )
            {
                print '<div class="error">' . $error . '</div>';
            }
        }
    }

    public function ShowInfos()
    {
        if ( $this->CountInfos() > 0 )
        {
            foreach ( $this->infos as $info )
            {
                print '<div class="msgs">' . $info . '</div>';
            }
        }
    }

}