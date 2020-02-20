<table>

    <thead>

    <tr>

        <td>#</td>
        <td>Player</td>
        <td>Points</td>

    </tr>

    </thead>

    <tbody>

    <?php

    require_once "core/init.php";

    if ( empty( $high_scores ) ) {

        for ( $i = 0; $i < 10; $i++ ) {

            $position = getPosition( $i );

            echo "<tr><td>$position</td><td>-</td><td>0</td></tr>";

        }

    } else {

        $number_of_scores = count( $high_scores );

        $n = 0;

        for ( $i = 0; $i < $number_of_scores; $i++ ) {

            $position = getPosition( $i );

            echo "<tr><td>$position</td><td>" . $high_scores[ $i ]->player . "</td><td>" . $high_scores[ $i ]->score . "</td></tr>";

        }


    }

    ?>

    </tbody>

</table>

<?php

if ( empty( $high_scores ) ) {

    echo "<script>let lowestHighScore = 0;</script>";

} elseif ( count( $high_scores ) == 10 ) {

    echo "<script>let lowestHighScore = " . $high_scores[ 9 ]->score . "</script>";

} elseif ( count( $high_scores ) < 10 ) {

    $index = count( $high_scores ) - 1;

    echo "<script>let lowestHighScore = " . $high_scores[ $index ]->score . "</script>";

}

?>