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
     * Construct.
     *
     * @param int $suit
     * @param int $number
     */
    public function __construct($suit, $number)
    {
        $this->setNumber($number);
        $this->setSuit($suit);
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
     * @param int $number
     */
    private function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @param int $suit
     */
    private function setSuit($suit)
    {
        $this->suit = $suit;
    }
}
