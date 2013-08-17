<?php

namespace PokerKata\Combination;

use PokerKata\SortedCardSet;

/**
 * Class TwoPair
 *
 * @package PokerKata\Combination
 */
class TwoPair extends AbstractCombination
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return Combination::TWO_PAIR;
    }

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
        $subset = $cards->getSubSortedSetCardExcluding($firstPairIndices);

        if (!$combinationPair->match($subset)) {
            return false;
        }

        $secondPairIndices = $combinationPair->getIndices();

        $indices = array_merge($firstPairIndices, $secondPairIndices);
        $this->setIndices($indices);

        return true;
    }
}