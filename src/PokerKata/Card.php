<?php

namespace PokerKata;

/**
 * Class Card
 *
 * @package PokerKata
 */
class Card
{
    /**
     * Suits.
     */
    const SUIT_HEARTS   = 'hearts';     // corazón
    const SUIT_DIAMONTS = 'diamonts';   // diamante
    const SUIT_CLUB     = 'club';       // trébol
    const SUIT_SPADE    = 'spade';      // pica

    /**
     * Numbers.
     */
    const NUM_JACK   = 11;           // sota
    const NUM_QUEEN  = 12;           // reina
    const NUM_KING   = 13;           // rey

    /**
     * @var int
     */
    private $number;

    /**
     * @var int
     */
    private $suit;

    /**
     * @var int
     */
    private $index;

    /**
     * Construct.
     *
     * @param int $suit
     * @param int $number
     */
    public function __construct($suit, $number)
    {
        $this->number = $number;
        $this->suit   = $suit;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return int
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**
     * @param int $index
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }
}
