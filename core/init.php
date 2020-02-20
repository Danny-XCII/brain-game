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

            $query = $this->pdo->prepare( "select * from `highscores` order by `score` desc limit 10;" );
            $query->execute();

            return $query->fetchAll( PDO::FETCH_CLASS );

        } catch ( PDOException $e ) {

            die( "Could not retrieve high scores from the database: " . $e->getMessage() );

        }

    }

    public function addHighScore( $player, $score ) {

        try {

            $query = $this->pdo->prepare( "insert into `highscores` ( `player`, `score` ) values ( :player, :score );" );
            $query->bindParam( ":player", $player );
            $query->bindParam( ":score", $score );
            $query->execute();

        } catch ( PDOException $e ) {

            die( "Could not add the high score to the database: " . $e->getMessage() );

        }

    }

}

function getPosition( $i ) {

    if ( ( $i + 1 ) == 1 ) {

        $position = "<img src='assets/imgs/trophy-1.svg'>";

    } elseif ( ( $i + 1 ) == 2 ) {

        $position = "<img src='assets/imgs/trophy-2.svg'>";

    } elseif ( ( $i + 1 ) == 3 ) {

        $position = "<img src='assets/imgs/trophy-3.svg'>";

    } else {

        $position = $i + 1;

    }

    return $position;

}

$database = new Database( $config );
$high_scores = $database->getHighScores();