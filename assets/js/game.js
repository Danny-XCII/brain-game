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

            if ( score > lowestHighScore ) {

                console.log( "New high score!" );
                requiredColor.innerHTML = "<span class='scored'>You scored: " + score + "</span><span class='incorrect'>You got a new high score!</span><span class='incorrect'><form enctype='multipart/form-data' id='high-score-form' method='post'><input type='hidden' name='score' value='" + score + "'><input type='text' name='player' value='Player'><input type='submit' value='Submit Score'></form></span>";

                document.getElementById( "high-score-form" ).addEventListener( "submit", function( e ) {

                    e.preventDefault();
                    console.log( "Submitted!" );
                    let formData = new FormData( document.getElementById( "high-score-form" ) );
                    let xhr = new XMLHttpRequest();
                    let body = document.querySelector( "body" );

                    xhr.onreadystatechange = function() {

                        if ( this.readyState == 4 && this.status == 200 ) {

                            if ( this.responseText == "true" ) {

                                notify( "Added your high score!", "eb-success" );
                                refreshLeaderboard();
                                document.getElementById( "high-score-form" ).style.display = "none";

                            } else {

                                notify( "Your chosen name must be fewer than 7 characters and cannot be empty.", "eb-error" );

                            }

                        }

                    }

                    xhr.open( "POST", "add-high-score.php" );
                    xhr.send( formData );

                });

            } else {

                requiredColor.innerHTML = "<span class='incorrect'>Sorry, better luck next time!</span><span class='scored'>You scored: " + score + "</span>";

            }

            startButton.innerHTML = "New Game";
            startButton.parentElement.style.display = "inline-block";
            score = 0;
            scoreBoard.innerHTML = score;
            inPlay = false;

        }

    } else {

        console.log( "Not currently in play!" );

    }

}

function notify( message, errorType ) {

    let errorBar = document.querySelector( ".error-bar" );
    errorBar.id = errorType;
    errorBar.innerHTML = message;
    errorBar.style.opacity = "1";

    setTimeout( function() {

        errorBar.style.opacity = "0";

    }, 3000 );

}

function refreshLeaderboard() {

    let highScoreDiv = document.getElementById( "high-score-container" );
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {

        if ( this.readyState == 4 && this.status == 200 ) {

            highScoreDiv.innerHTML = this.responseText;

        }

    }

    xhr.open( "GET", "high-scores.php" );
    xhr.send();

}