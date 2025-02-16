<?php

class CompareWithDatabase
{


    private $dbManager;
    private $messageService;

    /**
     * @param DBManager $dbManager
     * @param MessageService $messageService
     */

    public function __construct(DBManager $dbManager , MessageService  $messageService)
    {
        $this->dbManager = $dbManager;
        $this->messageService = $messageService;
    }




   public function CompareWithDatabase($table, $pkey): void
    {

        $data = $this->dbManager->getData("SHOW FULL COLUMNS FROM $table");


        //overloop alle in de databank gedefinieerde velden van de tabel
        foreach ($data as $row) {
            //haal veldnaam en veldtype uit de databank
            $fieldname = $row['Field']; //bv. img_title
            $can_be_null = $row['Null']; //bv. NO / YES

            list($type, $length, $precision) = $this->GetFieldType($row['Type']);

            //zit het veld in $_POST?
            if (key_exists($fieldname, $_POST)) {
                $sent_value = $_POST[$fieldname];

                //INTEGER type
                if (in_array($type, explode(",", "INTEGER,INT,SMALLINT,TINYINT,MEDIUMINT,BIGINT"))) {
                    //is de ingevulde waarde ook een int?
                    if (!$this->isInt($sent_value)) //nee
                    {
                        $msg = $sent_value . " moet een geheel getal zijn";
                        $this->messageService->AddMessage("input_errors", $msg, $fieldname);


                    } else //ja
                    {
                        $_POST[$fieldname] = (int)$sent_value;
                    }
                }

                //FLOAT/DOUBLE type
                if (in_array($type, explode(",", "FLOAT,DOUBLE"))) {
                    //is de ingevulde waarde ook numeriek?
                    if (!is_numeric($sent_value)) //nee
                    {
                        $msg = $sent_value . " moet een getal zijn (eventueel met decimalen)";
                        $this->messageService->AddMessage("input_errors", $msg, $fieldname);
                    } else //ja
                    {
                        $_POST[$fieldname] = (float)$sent_value;
                    }
                }

                //STRING type
                if (in_array($type, explode(",", "VARCHAR,TEXT"))) {
                    //is de tekst niet te lang?
                    if (strlen($sent_value) > $length) {
                        $msg = "Dit veld kan maximum $length tekens bevatten";
                        $this->messageService->AddMessage("input_errors", $msg, $fieldname);
                    }
                }

                //DATE type
                if ($type == "DATE") {
                    if (!$this->isDate($sent_value)) {
                        $msg = $sent_value . " is geen geldige datum";
                        $this->messageService->AddMessage("input_errors", $msg, $fieldname);
                    }
                }

                //other types ...
            }
        }
    }

    public  function ValidateUsrPassword($password)
    {

        if (strlen($password) < 8) {

            $this->messageService->AddMessage("input_errors", "Het wachtwoord moet minstens 8 tekens bevatten", 'usr_password');
            return false;
        }

        return true;
    }

    public function ValidateUsrEmail($email)
    {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {

            $this->messageService->AddMessage("input_errors", "Geen geldig e-mailadres!", 'usr_email');
            return false;
        }
    }

   public function CheckUniqueUsrEmail($email)
    {

        $sql = "SELECT * FROM user WHERE usr_email='" . $email . "'";

        $rows = $this->dbManager->getData($sql);


        if (count($rows) > 0) {

            $this->messageService->AddMessage("input_errors", "Er bestaat al een gebruiker met dit e-mailadres", 'usr_email');
            return false;
        }

        return true;
    }

    private  function isInt($value)
    {
        return is_numeric($value) && floatval(intval($value)) === floatval($value);
    }

    private function isDate($date)
    {
        return date('Y-m-d', strtotime($date)) === $date;
    }

    private function GetFieldType($definition)
    {
        $length = 0;
        $precision = 0;

        //zit er een haakje in de definitie?
        if (strpos($definition, "(") !== false) {
            $type_parts = explode("(", $definition);
            $type = $type_parts[0];
            $between_brackets = str_replace(")", "", $type_parts[1]);

            //zit er een komma tussen de haakjes?
            if (strpos($between_brackets, ",") !== false) {
                list($length, $precision) = explode(",", $between_brackets);
            } else $length = (int)$between_brackets; //cast int type
        } //geen haakje
        else $type = $definition;

        $type = strtoupper($type); //bv. INTEGER

        return [$type, $length, $precision];
    }

}