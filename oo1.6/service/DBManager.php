<?php

class DBManager
{

private Logger $logger;

private  $pdo;

    public function __construct($logger  , $pdo )
    {
        $this->logger = $logger;

        $this->pdo = $pdo;
    }

    public function CreateConnection()
    {
       // global $conn;


        // Create and check connection

        try {
            $conn = $this->pdo;
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function GetData( $sql )
    {



        $conn =  $this->pdo;
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

        $this->logger->Log($sql);
        $this->CreateConnection();

        $conn =   $this->pdo;
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //define and execute query
        $result = $conn->query( $sql );

        return $result;
    }

}