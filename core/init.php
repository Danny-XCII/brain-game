<?php

require_once "core/config.php";

class Database {

    protected $pdo;

    public function __construct( $config ) {

        try {

            $this->pdo = new PDO( "mysql:host=$config->host;dbname=$config->dbname;", $config->username, $config->password );

        } catch ( PDOException $e ) {

            die( "Failed to connect to the database: " . $e->getMessage() );

        }

    }

    public function getHighScores() {

        try {

            $query = $this->pdo->prepare( "select * from `highscores` order_by desc limit 10;" );
            $query->execute();

            return $query->fetchAll( PDO::FETCH_CLASS );

        } catch ( PDOException $e ) {

            die( "Could not retrieve high scores from the database: " . $e->getMessage() );

        }

    }

}

$database = new Database( $config );
$high_scores = $database->getHighScores();