<?php

namespace PokerKata;

/**
 * Class CardSetCombination
 *
 * @package PokerKata
 */
final class CardSetCombination
{
    const COMB_ROYAL_FLUSH = 'royal flush';             // Escalera real
    const COMB_STRAIGHT_FLUSH = 'straight flush';       // Escalera de color
    const COMB_FOUR_OK_A_KIND = 'four of a Kind';       // Póquer
    const COMB_FULL_HOUSE = 'full house';               // Full
    const COMB_FLUSH = 'flush';                         // Color
    const COMB_STRAIGHT = 'straight';                   // Escalera
    const COMB_THREE_OF_A_KIND = 'three of a kind';     // Trio
    const COMB_TWO_PAIR = 'two pair';                   // Dobles parejas
    const COMB_PAIR = 'pair';                           // Pareja
    const COMB_HIGH_CARD = 'high card';                 // Pareja
}
