<?php

namespace PokerKata\Combination;

use PokerKata\SortedCardSet;

/**
 * Class FourOfAKind
 *
 * @package PokerKata\Combination
 */
class FourOfAKind extends AbstractCombination
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

        $indices = $combinationThreeOfAKind->getIndices();
        $threeCardIndex = end($indices);
        $fourCardIndex  = $threeCardIndex + 1;

        if (!$cards->offsetExists($fourCardIndex)) {
            return false;
        }

        $pairIndices = array(
            $threeCardIndex,
            $fourCardIndex,
        );
        $subset = $cards->getSubSortedSetCardIncluding($pairIndices);

        $combinationPair = new Pair();
        if (!$combinationPair->match($subset)) {
            return false;
        }

        $indices = array_merge($indices, (array) $fourCardIndex);
        $this->setIndices($indices);

        return true;
    }
}