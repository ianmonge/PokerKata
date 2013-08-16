<?php

namespace PokerKata\Combination;

use PokerKata\SortedCardSet;

/**
 * Class ThreeOfAKind
 *
 * @package PokerKata\Combination
 */
class ThreeOfAKind extends AbstractCombination
{
    /**
     * {@inheritdoc}
     */
    public function match(SortedCardSet $cards)
    {
        $cards->resetIndex();

        $combinationPair = new Pair();

        if (!$combinationPair->match($cards)) {
            return false;
        }

        $pairIndices = $combinationPair->getIndices();
        $secondCardIndex = $pairIndices[1];
        $thirdCardIndex = $secondCardIndex + 1;

        if (!$cards->offsetExists($thirdCardIndex)) {
            return false;
        }

        $includeIndices = array(
            $secondCardIndex,
            $thirdCardIndex,
        );
        $subset = $cards->getSubSortedSetCardIncluding($includeIndices);

        if (!$combinationPair->match($subset)) {
            return false;
        }

        $indices = array_merge($pairIndices);
        $this->setIndices($indices);

        return true;
    }
}