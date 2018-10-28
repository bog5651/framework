<?php
class DB
{
    private static $instance = null;
    private $connection = null;
    private $config = null;
    private $error = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->config = Configuration::getConfiguration();
        $this->connection = new PDO(
            'mysql:dbname=' . $this->config->database['dbname'] . ';host=' . $this->config->database['host'] . ';',
            $this->config->database['login'],
            $this->config->database['password']
        );
    }

    public function query(string $request, array $params = [])
    {
        $type = strtolower(explode(' ', $request)[0]);
        //$lastId = $this->getLastId();
        $statment = $this->connection->prepare($request);
        $result = $statment->execute($params);
        $this->error = $statment->errorInfo();
        if ($result) {
            if ($type == "select")
                return $statment->fetchAll(PDO::FETCH_ASSOC);
            else {
                return $result;
            }
        }
        return $result;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getLastId()
    {
        return $this->connection->lastInsertId();
    }
}