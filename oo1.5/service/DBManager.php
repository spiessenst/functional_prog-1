<?php

class DBManager
{

private $logger;


    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    function CreateConnection()
    {
        global $conn;
        global $servername, $dbname, $username, $password;

        // Create and check connection
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function GetData( $sql )
    {
        global $conn;

        $this->logger->Log($sql);
        $this->CreateConnection();

        //define and execute query
        $result = $conn->query( $sql );


        //show result (if there is any)
        if ( $result->rowCount() > 0 )
        {
            //$rows = $result->fetchAll(PDO::FETCH_ASSOC); //geeft array zoals ['lan_id'] => 1, ...
            //$rows = $result->fetchAll(PDO::FETCH_NUM); //geeft array zoals [0] => 1, ...
            $rows = $result->fetchAll(PDO::FETCH_BOTH); //geeft array zoals [0] => 1, ['lan_id'] => 1, ...
            //var_dump($rows);
            return $rows;
        }
        else
        {
            return [];
        }

    }

    function ExecuteSQL( $sql )
    {
        global $conn;
        $this->logger->Log($sql);
        $this->CreateConnection();

        //define and execute query
        $result = $conn->query( $sql );

        return $result;
    }

}