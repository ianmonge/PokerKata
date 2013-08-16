<?php

namespace PokerKata\Combination;

use PokerKata\SortedCardSet;

/**
 * Class AbstractCombination
 *
 * @package PokerKata\Combination
 */
abstract class AbstractCombination
{
    /**
     * Index of cards that matches the combination.
     *
     * @var int
     */
    protected $index = array();

    /**
     * @param SortedCardSet $cards
     *
     * @return bool
     */
    abstract public function match(SortedCardSet $cards);

    /**
     * Return the index.
     *
     * @return array
     */
    public function getIndices()
    {
        return $this->index;
    }

    /**
     * Set the index.
     *
     * @param $index
     */
    protected function setIndex(array $index)
    {
        $this->index = $index;
    }
}