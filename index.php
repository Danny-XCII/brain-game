<?php require_once "core/init.php"; ?>

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">

<div class="error-bar"></div>

<header style="text-align: center; width: 300px; margin: 0 auto;">

    <h1><span class="blue">B</span><span class="green">r</span><span class="black">a</span><span class="yellow">i</span><span class="red">n</span> Game</h1>

    <p>Each round, five coloured tiles are randomly sorted into the tile grid. You will be shown the coloured tiles for 1 second, try and take them in as best you can!</p>

    <p>Of the five available coloured tiles, you'll be asked to remember the location of one of them. Simply click the tile you think contains the required colour - try to score as many points as you can!</p>

    <div class="high-scores" id="high-score-container">

        <?php include "high-scores.php"; ?>

    </div>

</header>

<main>

    <div id="score-panel">Your Score: <span id="score"></span></div>

    <div id="game">

        <?php include "game.php"; ?>

    </div>

    <script src="assets/js/game.js"></script>

    <div id="ui">

        <div class="instructions">

            <div id="required-color"></div>

            <div>

                <button id="start-button" onclick="newRound();"><span id="button-text">New Game!</span></button>

            </div>

        </div>

    </div>

    <div id="my-vog"></div>

    <script src="https://tools.winningweb.co.uk/view-on-github/ViewOnGithub.js"></script>
    <script>
        new ViewOnGithub( "my-vog", "Danny-XCII", "brain-game", "green" );
    </script>

    <style>#my-vog img { color: #fff; }</style>

</main>