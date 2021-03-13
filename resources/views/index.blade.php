<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Let's Play
                </div>

                <div>
                    <input id="number_of_people" type="number" max="99" placeholder="No. of People"></input>
                    <button onclick="shuffleCards()">Shuffle</button>
                </div>

                <div class="results">
                </div>
            </div>
        </div>
    </body>
</html>

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
</script>

<script>
    // Create a function to distribute card
    function shuffleCards() {
        // Get input value
        var number_of_people = document.getElementById("number_of_people").value

        // Declare card elements
        const card_types = ["S", "D", "C", "H"];
        const card_values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "X", "J", "Q", "K",];

        // Create deck array
        let deck = [];
        
        // Validate the value inserted by user
        if (number_of_people > 0 && number_of_people !== null) {
            // Create a deck of cards
            for (let i = 0; i < card_types.length; i++) {
                for (let x = 0; x < card_values.length; x++) {
                    let card = { cardValue: card_values[x], cardTypes: card_types[i] };
                    deck.push(card);
                }
            }

            // Shuffle the cards
            for (let i = deck.length - 1; i > 0; i--) {
                let j = Math.floor(Math.random() * i);
                let temp = deck[i];
                deck[i] = deck[j];
                deck[j] = temp;
            }

            // Clear content
            $(".results").html(``);

            // Distribute the card
            for (let i = 0; i < deck.length; i++) {
                console.log(`${deck[i].cardTypes}-${deck[i].cardValue}`)
                $(".results").append( `<p>${deck[i].cardTypes}-${deck[i].cardValue}, </p>` );
            }
        }

        else {
            $(".results").html( `<h3>Input value does not exist or value is invalid</h3>` );
            return;
        }
        
    }
</script>