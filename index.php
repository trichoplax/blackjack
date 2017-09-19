<?php

/*
 * Play a game of Blackjack.
 *
 * @return Bool true if player wins.
 */
function playGame() {
    $deck = newDeck();
    shuffle($deck);
    $yourHand = [];
    $dealerHand = [];
    for ($i = 0; $i < 2; $i++) {
        $yourHand[] = array_pop($deck);
        $dealerHand[] = array_pop($deck);
    }
    return handValue($yourHand) > handValue($dealerHand);
}

/*
 * Return an ordered deck of 52 cards.
 *
 * @return array ordered deck of 52 cards.
 */
function newDeck() {
    $suits = ['H', 'D', 'S', 'C'];
    $ranks = ['A', '2', '3', '4', '5', '6', '7', '8', '9', 'T', 'J', 'Q', 'K'];
    $deck = [];
    foreach ($suits as $suit) {
        foreach ($ranks as $rank) {
            $deck[] = $rank . $suit;
        }
    }
    return $deck;
}

/*
 * Return the value of a hand.
 *
 * @params $hand array The cards in the hand.
 *
 * @return Int The value of the hand.
 */
function handValue(array $hand) {
    $values = [];
    foreach($hand as $card) {
        $values[] = cardValue($card);
    }
    foreach ($values as $key => $value) {
        $total = array_sum($values);
        if ($total < 11) {
            if ($value === 1) {
                $values[$key] = 11;
            }
        }
    }
    return array_sum($values);
}

/*
 * Return the value of a card.
 *
 * @params $card string The rank and suit of the card.
 *
 * @return Int The value of the card.
 */
function cardValue(String $card) {
    $rank = substr($card, 0, 1);
    if ((int) $rank) {
        $value = $rank;
    } else {
        switch ($rank) {
            case 'A':
                $value = 1;
                break;
            case 'T':
            case 'J':
            case 'Q':
            case 'K':
                $value = 10;
                break;
            default:
                $value = 10;  // Consider error checking here
        }
    }
    return $value;
}

echo playGame()?"You win!":"You lose!";
