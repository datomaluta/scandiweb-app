<?php

class Database {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function executeQuery($query, $parameters = []) {
        $statement = $this->pdo->prepare($query);
        $statement->execute($parameters);
        return $statement;
    }

    public function fetchAll($query, $parameters = []) {
        $statement = $this->executeQuery($query, $parameters);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
