<?php

namespace PokerKata\Combination;

use PokerKata\SortedCardSet;

/**
 * Class FullHouse
 *
 * @package PokerKata\Combination
 */
class FullHouse extends AbstractCombination
{
    /**
     * {@inheritdoc}
     */
    public function match(SortedCardSet $cards)
    {
        $cards->resetIndex();

        $combinationThreeOfAKind = new ThreeOfAKind();

        if (!$combinationThreeOfAKind->match($cards)) {
            return false;
        }

        $threeOfAKindIndices = $combinationThreeOfAKind->getIndices();

        $middleThreeCardsIndices = array(1, 2, 3);

        // If the three of a kind are in the middle, there can not be a pair.
        if ($threeOfAKindIndices == $middleThreeCardsIndices) {
            return false;
        }

        $subset = $cards->getSubSortedSetCardExcluding($threeOfAKindIndices);

        $combinationPair = new Pair();

        if (!$combinationPair->match($subset)) {
            return false;
        }

        $indices = array_keys($cards->keys());
        $this->setIndices($indices);

        return true;
    }
}