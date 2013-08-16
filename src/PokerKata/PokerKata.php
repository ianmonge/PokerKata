<?php

namespace PokerKata;

use PokerKata\Combination\Flush;
use PokerKata\Combination\FourOfAKind;
use PokerKata\Combination\FullHouse;
use PokerKata\Combination\HighCard;
use PokerKata\Combination\Pair;
use PokerKata\Combination\Straight;
use PokerKata\Combination\ThreeOfAKind;
use PokerKata\Combination\TwoPair;

/**
 * Class PokerKata
 *
 * @package PokerKata
 */
class PokerKata implements PokerKataInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBestCombination(SortedCardSet $cards)
    {
        $combinationHighCard        = new HighCard();
        $combinationPair            = new Pair();
        $combinationTwoPair         = new TwoPair();
        $combinationThreeOfAKind    = new ThreeOfAKind();
        $combinationStraight        = new Straight();
        $combinationFlush           = new Flush();
        $combinationFullHouse       = new FullHouse();
        $combinationFourOfAKind     = new FourOfAKind();

        if ($combinationFourOfAKind->match($cards)) {
            return Combination::COMB_FOUR_OK_A_KIND;
        } elseif ($combinationFullHouse->match($cards)) {
            return Combination::COMB_FULL_HOUSE;
        } elseif ($combinationFlush->match($cards)) {
            return Combination::COMB_FLUSH;
        } elseif ($combinationStraight->match($cards)) {
            return Combination::COMB_STRAIGHT;
        } elseif ($combinationThreeOfAKind->match($cards)) {
            return Combination::COMB_THREE_OF_A_KIND;
        } elseif ($combinationTwoPair->match($cards)) {
            return Combination::COMB_TWO_PAIR;
        } elseif ($combinationPair->match($cards)) {
            return Combination::COMB_PAIR;
        } elseif ($combinationHighCard->match($cards)) {
            return Combination::COMB_HIGH_CARD;
        }

        return null;
    }
}
