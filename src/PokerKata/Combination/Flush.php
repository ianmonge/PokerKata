<?php

namespace PokerKata\Combination;

use PokerKata\SortedCardSet;

/**
 * Class Flush
 *
 * @package PokerKata\Combination
 */
class Flush extends AbstractCombination
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return Combination::FLUSH;
    }

    /**
     * {@inheritdoc}
     */
    public function match(SortedCardSet $cards)
    {
        $cards->resetIndex();

        $currentCard = $cards->getCurrent();

        while ($cards->hasNext()) {
            $nextCard = $cards->getNext();
            if ($currentCard->getSuit() !== $nextCard->getSuit()) {
                return false;
            }

            $currentCard = $cards->next();
        }

        $indices = array_keys($cards->keys());
        $this->setIndices($indices);

        return true;
    }
}