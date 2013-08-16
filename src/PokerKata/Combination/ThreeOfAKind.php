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

        $firstPairIndices = $combinationPair->getIndices();
        $secondCardIndex = $firstPairIndices[1];
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
            $subset = $cards->getSubSortedSetCardExcluding($firstPairIndices);

            if (!$this->match($subset)) {
                return false;
            }

            $indices = array();
            foreach ($this->getIndices() as $index) {
                $indices[] = $index + 2;
            }
            $indices[] = $index + 3;
        } else {
            $indices = $includeIndices;
        }

        sort($indices);
        $this->setIndices($indices);

        return true;
    }
}