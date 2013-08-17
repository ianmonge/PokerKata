<?php

namespace PokerKata\Combination;

use PokerKata\SortedCardSet;

/**
 * Class RoyalFlush
 *
 * @package PokerKata\Combination
 */
class RoyalFlush extends AbstractCombination
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return Combination::ROYAL_FLUSH;
    }

    /**
     * {@inheritdoc}
     */
    public function match(SortedCardSet $cards)
    {
        $firstCard = $cards->getCurrent();
        $secondCard = $cards->getNext();
        if ($firstCard->getNumber() !== 1 || $secondCard->getNumber() !== 10) {
            return false;
        }

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