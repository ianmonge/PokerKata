<?php

namespace PokerKata\Combination;

use PokerKata\SortedCardSet;

/**
 * Class Pair
 *
 * @package PokerKata\Combination
 */
class Pair extends AbstractCombination
{
    /**
     * {@inheritdoc}
     */
    public function match(SortedCardSet $cards)
    {
        $currentCard = $cards->getCurrent();

        while ($cards->hasNext()) {
            $nextCard = $cards->getNext();
            if ($currentCard->getNumber() === $nextCard->getNumber()) {
                $this->setIndex($cards->getIndex());
                return true;
            }

            $currentCard = $cards->next();
        }

        return false;
    }
}