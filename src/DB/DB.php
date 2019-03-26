<?php

namespace src\DB;
use config;

/**
 * The DB class is designed to connect to the database and make requests to it.
 */
class DB {

    private $host;
    private $name;
    private $password;
    private $database;
    public $db;
    public $query;

    /**
     * @throws Exception
     */
    public function __construct ()
    {
        $configParams = new config\Conf();
        $databaseParameters = $configParams->getConfigParameters();

        $this->host = $databaseParameters['host'];
        $this->name = $databaseParameters['name'];
        $this->password = $databaseParameters['password'];
        $this->database = $databaseParameters['database'];

        if (!($this->db = mysqli_connect($this->host,$this->name,$this->password))){
            throw new Exception ("Can't connect to the server.");
        }
        if (!mysqli_select_db($this->db, $this->database)){
            throw new Exception ("Can't connect to DB.");
        }
        return $this->db;
    }

    /**
     * @param string $sqlQuery
     * @param string $getType
     * @return array
     * @throws Exception
     */
    public function query($sqlQuery, $getType = "assoc")
    {
        if (!($result = mysqli_query($this->db, $sqlQuery))){
            throw new Exception ("Can't execute query.".mysql_error());
        }
        $resultType = MYSQL_NUM;
        if ("assoc" == $getType) {
            $resultType = MYSQL_ASSOC;
        }
        while ($row = mysqli_fetch_array($result, $resultType)){
            $res[] = $row;
        }
        return $res;
    }
}