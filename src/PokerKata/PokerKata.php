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
        $combinations = array(
            new FourOfAKind(),
            new FullHouse(),
            new Flush(),
            new Straight(),
            new ThreeOfAKind(),
            new TwoPair(),
            new Pair(),
            new HighCard(),
        );

        foreach ($combinations as $combination) {
            if ($combination->match($cards)) {
                return $combination->getName();
            }
        }

        return null;
    }
}
