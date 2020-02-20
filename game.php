<?php

$colors = [ "green", "yellow", "red", "blue", "black" ];
$locations = [];

for ( $i = 0; $i < 5; $i++ ) {

    $generatingUniqueNumber = true;

    while ( $generatingUniqueNumber ) {

        $n = rand( 0, 15 );

        if ( !in_array( $n, $locations ) ) {

            $locations[] = $n;
            $generatingUniqueNumber = false;

        }

    }

}

$mapped_locations = array_combine( $locations, $colors );

for ( $i = 0; $i < 16; $i++ ) {

    if ( array_key_exists( $i, $mapped_locations ) ) {

        echo "<div class='grid-item color' id='" . $mapped_locations[ $i ] . "'><div onclick='isCorrect( this )'></div></div>";

    } else {

        echo "<div class='grid-item'><div onclick='isCorrect( this )'></div></div>";

    }

}

?>