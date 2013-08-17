<?php

namespace PokerKata\Combination;

use PokerKata\SortedCardSet;

/**
 * Class StraightFlush
 *
 * @package PokerKata\Combination
 */
class StraightFlush extends AbstractCombination
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return Combination::STRAIGHT_FLUSH;
    }

    /**
     * {@inheritdoc}
     */
    public function match(SortedCardSet $cards)
    {
        $combinationStraight = new Straight();
        if (!$combinationStraight->match($cards)) {
            return false;
        }

        $combinationFlush = new Flush();
        if (!$combinationFlush->match($cards)) {
            return false;
        }

        $this->setIndices($combinationFlush->getIndices());

        return true;
    }
}