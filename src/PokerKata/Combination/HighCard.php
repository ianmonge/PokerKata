<?php

namespace PokerKata\Combination;

use PokerKata\SortedCardSet;

/**
 * Class HighCard
 *
 * @package PokerKata\Combination
 */
class HighCard extends AbstractCombination
{
    /**
     * {@inheritdoc}
     */
    public function match(SortedCardSet $cards)
    {
        $cards->resetIndex();

        $firstCard = $cards->getCurrent();

        if (1 === $firstCard->getNumber()) {
            $highCard = $firstCard;
        } else {
            while ($cards->hasNext()) {
                $highCard = $cards->next();
            }
        }

        $indices = array($highCard->getIndex());
        $this->setIndices($indices);

        return true;
    }
}