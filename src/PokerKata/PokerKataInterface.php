<?php

namespace PokerKata;

/**
 * Class PokerKata
 *
 * @package PokerKata
 */
interface PokerKataInterface
{
    /**
     * @param SortedCardSet $cardSet
     *
     * @return string
     */
    public function getBestCombination(SortedCardSet $cardSet);
}
