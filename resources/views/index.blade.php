<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tyrell Test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
        var number_of_people =+ document.getElementById("number_of_people").value;

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
            for (let person = 0; person < number_of_people; person++) {
                $(".results").append(
                    $("<p>").append(
                        `Person ${person+1}: `,
                        deck.splice(-Math.ceil(deck.length / (number_of_people - person))).map(card =>
                            `${card.cardTypes}-${card.cardValue}`
                        ).join(", ")
                    )
                );
            }
        }

        else {
            $(".results").html( `<h3>Input value does not exist or value is invalid</h3>` );
            return;
        }
    }
</script>