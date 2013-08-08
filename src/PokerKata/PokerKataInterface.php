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
     * @param CardSet $cardSet
     *
     * @return string
     */
    public function getWinnerCombination(CardSet $cardSet);
}
