<?php

namespace PokerKata;

use PokerKata\Combination;

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
        $combinations = $this->getCombinationsByPriority();

        foreach ($combinations as $combination) {
            if ($combination->match($cards)) {
                return $combination->getName();
            }
        }

        return null;
    }

    /**
     * Return the combinations by order of priority.
     *
     * @return array
     */
    private function getCombinationsByPriority()
    {
        $combinations = array(
            new Combination\RoyalFlush(),
            new Combination\StraightFlush(),
            new Combination\FourOfAKind(),
            new Combination\FullHouse(),
            new Combination\Flush(),
            new Combination\Straight(),
            new Combination\ThreeOfAKind(),
            new Combination\TwoPair(),
            new Combination\Pair(),
            new Combination\HighCard(),
        );

        return $combinations;
    }
}
