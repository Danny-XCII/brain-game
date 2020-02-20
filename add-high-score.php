<?php

require_once "core/init.php";

$player = $_POST[ "player" ];
$score = $_POST[ "score" ];

if ( $player == "" or ( strlen( $player ) > 6 ) ) {

    echo "false";

} else {

    $database->addHighScore( $player, $score );
    echo "true";

}