<?php

namespace PokerKata\Combination;

use PokerKata\Card;
use PokerKata\SortedCardSet;

/**
 * Class Straight
 *
 * @package PokerKata\Combination
 */
class Straight extends AbstractCombination
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return Combination::STRAIGHT;
    }

    /**
     * {@inheritdoc}
     */
    public function match(SortedCardSet $cards)
    {
        $cards->resetIndex();

        $firstCard = $cards->getCurrent();
        $secondCard = $cards->getNext();

        if ($firstCard->getNumber() === 1 && $secondCard->getNumber() === 10) {
            $aceCard = $firstCard;

            $excludeIndices = array($aceCard->getIndex());
            $auxCards = $cards->getSubSortedSetCardExcluding($excludeIndices);

            $aceCard = new Card($firstCard->getSuit(), 14);
            $auxCards->append($aceCard);
        } else {
            $auxCards = $cards;
        }

        $currentCard = $auxCards->getCurrent();

        while ($auxCards->hasNext()) {
            $nextCard = $auxCards->getNext();
            if ($currentCard->getNumber() + 1 !== $nextCard->getNumber()) {
                return false;
            }

            $currentCard = $auxCards->next();
        }

        $indices = array_keys($cards->keys());
        $this->setIndices($indices);

        return true;
    }
}