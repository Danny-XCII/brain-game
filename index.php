<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<link rel="stylesheet" type="text/css" href="css/style.css">

<header style="text-align: center; width: 300px; margin: 0 auto;">

    <h1 style="font-size: 3rem;"><span class="blue">B</span><span class="green">r</span><span class="black">a</span><span class="yellow">i</span><span class="red">n</span> Game</h1>

    <p>Each round, five coloured tiles are randomly sorted into the tile grid. You will be shown the coloured tiles for 1 second, try and take them in as best you can!</p>

    <p>Of the five available colours, you'll be asked to remember the location of one of them. Simply click the tile you think contains the required colour - try to score as many as you can!</p>

</header>

<main>

    <div id="score-panel" style="">Your Score: <span id="score"></span></div>

    <div id="game">

        <?php include "game.php"; ?>

    </div>

    <script>
        let color = "";
        let inPlay = false;
        let score = 0;
        let scoreBoard = document.querySelector( "#score" );
        scoreBoard.innerHTML = score;

        function newRound() {

            let startButton = document.querySelector( "#button-text" );
            startButton.parentElement.style.display = "none";
            inPlay = true;
            let gameBoard = document.querySelector( "#game" );
            let requiredColor = document.querySelector( "#required-color" );
            requiredColor.innerHTML = "";
            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {

                if ( this.status == 200 && this.readyState == 4 ) {

                    gameBoard.innerHTML = this.responseText;

                }

            }

            xhr.open( "GET", "game.php", false );
            xhr.send( null );

            let colors = [ "green", "yellow", "red", "blue", "black" ];
            let colorTiles = document.getElementsByClassName( "color" );
            let tile = 0;

            while ( tile < colorTiles.length ) {

                let cdiv = colorTiles[ tile ].querySelector( "div" );
                cdiv.style.opacity = "0";

                setTimeout( function() {

                    cdiv.style.opacity = "1";

                }, 1000 );

                tile++;

            }

            color = colors[ Math.floor( Math.random() * 5 ) ];
            let cap = color.charAt( 0 ).toUpperCase();
            let substr = color.substr( 1 );
            color = cap + substr;

            window.setTimeout( function() {

                requiredColor.innerHTML = "Find the <span class='color-span' id='" + color + "-span'>" + color + "</span> tile!";

            }, 1000 );

        }

        function isCorrect( e ) {

            let requiredColor = document.querySelector( "#required-color" );
            let startButton = document.querySelector( "#button-text" );

            if ( inPlay ) {

                let realDiv = e.parentElement;

                if ( realDiv.id == color.toLowerCase() ) {

                    startButton.innerHTML = "Next Round";
                    startButton.parentElement.style.display = "inline-block";
                    e.style.opacity = "0";
                    score++;
                    requiredColor.innerHTML = "<span class='correct'>Found it!</span>";
                    scoreBoard.innerHTML = score;
                    inPlay = false;

                } else {

                    let gridItems = document.getElementsByClassName( "grid-item" );
                    let searchingCorrect = true;

                    for ( let i = 0; i < gridItems.length; i++ ) {

                        if ( gridItems[ i ].id == color.toLowerCase() ) {

                            let cdiv = gridItems[ i ].querySelector( "div" );
                            cdiv.style.opacity = "0";

                        }

                    }

                    startButton.innerHTML = "New Game";
                    startButton.parentElement.style.display = "inline-block";
                    requiredColor.innerHTML = "<span class='incorrect'>Sorry, better luck next time!</span><span class='scored'>You scored: " + score + "</span>";
                    score = 0;
                    scoreBoard.innerHTML = score;
                    inPlay = false;

                }

            } else {

                console.log( "Not currently in play!" );

            }

        }

        window.addEventListener( "load", function() {

        });
    </script>

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