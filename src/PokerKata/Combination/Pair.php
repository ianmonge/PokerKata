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
        $cards->resetIndex();

        $currentCard = $cards->getCurrent();

        while ($cards->hasNext()) {
            $nextCard = $cards->getNext();
            if ($currentCard->getNumber() === $nextCard->getNumber()) {
                $indices = array(
                    $currentCard->getIndex(),
                    $nextCard->getIndex(),
                );
                $this->setIndices($indices);
                return true;
            }

            $currentCard = $cards->next();
        }

        return false;
    }
}