<?php

require_once 'config.php';

class Database {
    public PDO $pdo;
    private config $config;

    public function __construct() {
        $this->config = new Config();
        if($this->config->DB_ENABLED) {
            try {
                $this->pdo = new PDO($this->config->DB_DSN, $this->config->DB_USER, $this->config->DB_PASSWORD);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
            /* $this->pdo = new PDO($this->config->DB_DSN, $this->config->DB_USER, $this->config->DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); */
        }
    }

    public function prepare($sql) : PDOStatement {
        return $this->pdo->prepare($sql);
    }

}