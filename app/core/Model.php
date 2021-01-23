<?php


namespace App\core;
use PDO;

class Model
{
    private static $connection;
    private $debug;
    private $server;
    private $user;
    private $password;
    private $database;

    public function __construct()
    {
        $this->debug = true;

        $this->server   = HOST;
        $this->user     = USER;
        $this->password = PASS;
        $this->database = DB_NAME;
    }

    public function getConnection()
    {
        try {
            if(self::$connection == null){
                self::$connection = new \PDO("mysql:host={$this->server};dbname={$this->database}; charset=utf8", $this->user, $this->password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$connection->setAttribute(PDO::ATTR_PERSISTENT, true);
            }

            return self::$connection;

        }catch (PDOException $e){
            if($this->debug){
                echo "<br>Error on getConnection(); </br>" . $e->getMessage() . "</br>";
            }
            return null;
        }
    }

    /**
     * Unset connection
     *
     * @return void
     */
    public function disconnect()
    {
        self::$connection = null;
    }

    /**
     *
     * Retorna o ultimo ID inserido na base de dados
     *
     * @return int
     */
    public function getLastID()
    {
       return $this->getConnection()->lastInsertId();
    }


    /**
     * Retorna somente uma linha do banco de dados
     *
     * @param $sql
     * @param null $params
     * @return mixed|null
     */
    public function executeQueryOneRow($sql, $params = null){

        try {

            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch(\PDO::FETCH_ASSOC);

        }catch (PDOException $e){

            if($this->debug){

                echo "<br>Error on executeQueryOneRow();</br> " . $e->getMessage() . "<br />";
                echo "<br /><br>SQL: </br>"  . $sql . "<br />";
                echo "<br /><br>Parameters: </br>"  . $sql . "<br />";
                print_r($params) . "<br />";
            }
        }
        return null;
    }

    /**
     *
     * Retorna uma lista de todos os resultado da pesquisa
     *
     * @param $sql
     * @param null $params
     * @return array|null
     */
    public function executeQuery($sql, $params = null){

        try {

            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        }catch (PDOException $e){

            if($this->debug){

                echo "<br>Error on executeQuery();</br> " . $e->getMessage() . "<br />";
                echo "<br /><br>SQL: </br>"  . $sql . "<br />";
                echo "<br /><br>Parameters: </br>"  . $sql . "<br />";
                print_r($params) . "<br />";
            }
        }
        return null;
    }

    /**
     *
     * Somente executa uma ação no banco de dados e não retorna nada
     *
     * @param $sql
     * @param null $params
     * @return null
     */
    public function executeNoQuery($sql, $params = null){

        try {

            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);

        }catch (PDOException $e){

            if($this->debug){

                echo "<br>Error on executeNoQuery();</br> " . $e->getMessage() . "<br />";
                echo "<br /><br>SQL: </br>"  . $sql . "<br />";
                echo "<br /><br>Parameters: </br>"  . $sql . "<br />";
                print_r($params) . "<br />";
            }
        }
        return null;
    }

    public function numberRows($sql, $params = null){

        try {

            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount();

        }catch (PDOException $e){

            if($this->debug){

                echo "<br>Error on numberRows();</br> " . $e->getMessage() . "<br />";
                echo "<br /><br>SQL: </br>"  . $sql . "<br />";
                echo "<br /><br>Parameters: </br>"  . $sql . "<br />";
                print_r($params) . "<br />";
            }
        }
        return -1;
    }

}