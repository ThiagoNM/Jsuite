<?php

namespace My;

class Database {
    // Config
    private $_dsn;
    private $_user;
    private $_password;
    private $_options;
    // PDO
    private $_pdo;
  
    /**
     * Constructs custom PDO
     */
    public function __construct()
    {
        $cnf = include(__DIR__ . "/../config/database.php");
        $this->_dsn = $cnf["driver"].":". implode(";",[
            "host=".$cnf["host"],
            "port=".$cnf["port"],
            "dbname=".$cnf["database"]
        ]);
        $this->_user = $cnf["user"];
        $this->_password = $cnf["password"];
        $this->_options = $cnf["options"] ?? [];
        $this->open();
    }
  
    /**
     * Create PDO connection
     */
    public function open() : void
    {
        if (is_null($this->_pdo)) {
            try {
                $this->_pdo = new \PDO(
                    $this->_dsn, $this->_user, $this->_password, $this->_options
                );
            } catch (\PDOException $e) {
                throw new \Exception("DB connection error: " . $e->getMessage());
            }
        }
    }
  
    /**
     * Closes PDO connection
     */
    public function close() : void
    {
        $this->_pdo = null;
    }
  
    /**
     * Proxy pattern using magic overloading methods
     * https://www.php.net/manual/en/language.oop5.overloading.php#object.call
     */
    public function __call($name, $arguments)
    {
        if (is_null($this->_pdo)) {
            throw new \Exception("DB closed");
        }
        return $this->_pdo->{$name}(...$arguments);
    }
 }
?>