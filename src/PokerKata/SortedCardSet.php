<?php

namespace PokerKata;

use ArrayObject;

/**
 * Class SortedCardSet
 *
 * @package PokerKata
 */
class SortedCardSet extends ArrayObject
{
    /**
     * @param array $cards
     */
    public function __construct($cards = array())
    {
        $sortedCards = $this->sortCards($cards);

        parent::__construct($sortedCards);
    }

    /**
     * Sort the cards by their numbers.
     *
     * @param array $cards
     *
     * @return array
     */
    private function sortCards(array $cards)
    {
        $sortFunction = function(Card $a, Card $b) {
            return $a->getNumber() > $b->getNumber() ? 1 : -1;
        };

        usort($cards, $sortFunction);

        return $cards;
    }
}