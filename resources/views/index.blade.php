<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tyrell Test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="page position-ref full-height flex-center">
            <div class="content container align-self-center bg-light overflow-auto">
                <div class="title m-b-md">
                    Let's Play
                </div>

                <div>
                <form>
                    <div class="form-group">
                        <input id="number_of_people" type="number" class="form-control shadow" max="99" placeholder="No. of People"></input>
                        <button id="shuffle_button" type="button" class="btn btn-primary shadow border-0" onclick="shuffleCards()">Shuffle</button>
                    </div>
                </div>

                <div class="results">
                </div>

                <footer>
                    <div class="row align-items-center justify-content-xl-between">
                        <div class="col-xl-12">
                            <div class="copyright text-center text-muted">
                                &copy; {{ now()->year }} <a href="/" class="font-weight-bold ml-1" target="_blank">Develop by Muhammad Izzat</a>

                            </div>
                        </div>
                    </div>
                </footer>

            </div>
        </div>

    </body>
</html>

<!-- JQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- Bootstrap JS CDN -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

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
            for (let x = 0; x < card_types.length; x++) {
                for (let y = 0; y < card_values.length; y++) {
                    let card = { cardValue: card_values[y], cardTypes: card_types[x] };
                    deck.push(card);
                }
            }

            // Shuffle the cards
            for (let x = deck.length - 1; x > 0; x--) {
                let y = Math.floor(Math.random() * x);
                let temp_value = deck[x];
                deck[x] = deck[y];
                deck[y] = temp_value;
            }

            // Clear content
            $(".results").html(``);

            // Distribute the card
            for (let person = 0; person < number_of_people; person++) {
                let player_hand = deck.splice(-Math.ceil(deck.length / (number_of_people - person))).map(card =>
                            `<span class="badge badge-primary">${card.cardTypes}-${card.cardValue}</span>`
                        ).join(", ");
                $(".results").append(
                    $('<div class="row">').append(
                        `<div class="col-2 playerName">Player ${person+1} :</div>
                        <div class="col-10 playerHand">
                            ${player_hand}
                        </div>`
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