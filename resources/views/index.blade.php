@extends('layouts.app')

@section('content')
<div class="page position-ref full-height flex-center">
    <div class="content container align-self-center bg-light overflow-auto animate__animated animate__backInUp">
        <div class="title m-b-md animate__animated animate__backInUp">
            Let's Play
        </div>

        <div>
        <form>
            <div class="form-group animate__animated animate__backInUp">
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
                    $('<div class="row animate__animated animate__backInLeft">').append(
                        `<div class="col-2 playerName font-weight-bold">Player ${person+1} :</div>
                        <div class="col-10 playerHand">
                            ${player_hand}
                        </div>`
                    )
                );
            }
        }
        else {
            $(".results").html( `<div class="alert alert-danger animate__animated animate__shakeX" role="alert">
                                    <h4 class="">Input value does not exist or value is invalid</h4>
                                </div>` );
            return;
        }
    }
</script>
@endsection