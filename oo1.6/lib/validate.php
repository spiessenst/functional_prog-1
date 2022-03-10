<?php
require_once "autoload.php";


function CompareWithDatabase( $table, $pkey , $container ): void
{
    //$Logger = new Logger();

   // $dbm = new DBManager($Logger);
   // global $ms;

    $data = $container->getDBmanager()->getData( "SHOW FULL COLUMNS FROM $table" );


    //overloop alle in de databank gedefinieerde velden van de tabel
    foreach ( $data as $row )
    {
        //haal veldnaam en veldtype uit de databank
        $fieldname = $row['Field']; //bv. img_title
        $can_be_null = $row['Null']; //bv. NO / YES

        list( $type, $length, $precision ) = GetFieldType( $row['Type'] );

        //zit het veld in $_POST?
        if ( key_exists( $fieldname, $_POST) )
        {
            $sent_value = $_POST[$fieldname];

            //INTEGER type
            if ( in_array( $type, explode("," , "INTEGER,INT,SMALLINT,TINYINT,MEDIUMINT,BIGINT" ) ) )
            {
                //is de ingevulde waarde ook een int?
                if ( ! isInt($sent_value) ) //nee
                {
                    $msg = $sent_value . " moet een geheel getal zijn";
                    $container->getMessageService()->AddMessage( "input_errors", $msg, $fieldname );


                }
                else //ja
                {
                    $_POST[$fieldname] = (int) $sent_value;
                }
            }

            //FLOAT/DOUBLE type
            if ( in_array( $type, explode("," , "FLOAT,DOUBLE" ) ) )
            {
                //is de ingevulde waarde ook numeriek?
                if ( ! is_numeric($sent_value) ) //nee
                {
                    $msg = $sent_value . " moet een getal zijn (eventueel met decimalen)";
                    $container->getMessageService()->AddMessage( "input_errors", $msg, $fieldname );
                }
                else //ja
                {
                    $_POST[$fieldname] = (float) $sent_value;
                }
            }

            //STRING type
            if ( in_array( $type, explode("," , "VARCHAR,TEXT" ) ) )
            {
                //is de tekst niet te lang?
                if ( strlen($sent_value) > $length )
                {
                    $msg = "Dit veld kan maximum $length tekens bevatten";
                    $container->getMessageService()->AddMessage( "input_errors", $msg, $fieldname );
                }
            }

            //DATE type
            if ( $type == "DATE" )
            {
                if ( ! isDate( $sent_value) )
                {
                    $msg = $sent_value . " is geen geldige datum";
                    $container->getMessageService()->AddMessage( "input_errors", $msg, $fieldname );
                }
            }

            //other types ...
        }
    }
}

function ValidateUsrPassword( $password , $container )
{
   // global $ms;
    if ( strlen($password) < 8 )
    {
       // $_SESSION['errors']['usr_password_error'] = "Het wachtwoord moet minstens 8 tekens bevatten";
        $container->getMessageService()->AddMessage( "input_errors", "Het wachtwoord moet minstens 8 tekens bevatten", 'usr_password' );
        return false;
    }

    return true;
}

function ValidateUsrEmail( $email ,$container)
{
    //global $ms;
    if (filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        return true;
    }
    else
    {
      //  $_SESSION['errors']['usr_email_error'] = "Geen geldig e-mailadres!";

        $container->getMessageService()->AddMessage( "input_errors", "Geen geldig e-mailadres!", 'usr_email' );
        return false;
    }
}

function CheckUniqueUsrEmail( $email , $container)
{

   // global $ms;
    $sql = "SELECT * FROM user WHERE usr_email='" . $email . "'";

  //  $Logger = new Logger();

   // $dbm = new DBManager($Logger);
   // $rows = $dbm->getData($sql);

    $rows = $container->getDBManager()->getData($sql);



    if (count($rows) > 0)
    {
        //$_SESSION['errors']['usr_email_error'] = "Er bestaat al een gebruiker met dit e-mailadres";
        $container->getMessageService()->AddMessage( "input_errors", "Er bestaat al een gebruiker met dit e-mailadres", 'usr_email' );
        return false;
    }

    return true;
}

function isInt($value) {
    return is_numeric($value) && floatval(intval($value)) === floatval($value);
}

function isDate($date) {
    return date('Y-m-d', strtotime($date)) === $date;
}

function GetFieldType( $definition )
{
    $length = 0;
    $precision = 0;

    //zit er een haakje in de definitie?
    if ( strpos( $definition, "(" ) !== false )
    {
        $type_parts = explode(  "(", $definition );
        $type = $type_parts[0];
        $between_brackets = str_replace( ")", "", $type_parts[1] );

        //zit er een komma tussen de haakjes?
        if ( strpos( $between_brackets, "," ) !== false )
        {
            list( $length, $precision ) = explode( ",", $between_brackets);
        }
        else $length = (int) $between_brackets; //cast int type
    }
    //geen haakje
    else $type = $definition;

    $type = strtoupper( $type ); //bv. INTEGER

    return [ $type, $length, $precision ];
}