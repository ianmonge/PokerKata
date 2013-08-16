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
     * Index of the first card that matches the combination.
     *
     * @var int
     */
    protected $index;

    /**
     * @param SortedCardSet $cards
     *
     * @return bool
     */
    abstract public function match(SortedCardSet $cards);

    /**
     * Return the index.
     *
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Set the index.
     *
     * @param $index
     */
    protected function setIndex($index)
    {
        $this->index = $index;
    }
}