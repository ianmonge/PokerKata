<?php

namespace PokerKata;

/**
 * Class CardSet
 *
 * @package PokerKata
 */
class CardSet
{
    /**
     * @var array
     */
    private $cards = array();

    /**
     * Construct.
     *
     * @param array $cards
     */
    public function __construct(array $cards)
    {
        $this->setCards($cards);
    }

    /**
     * @param array $cards
     */
    public function setCards($cards)
    {
        $this->cards = $cards;
    }

    /**
     * @param Card $card
     */
    public function addCard(Card $card)
    {
        $this->cards[] = $card;
    }

    /**
     * @return array
     */
    public function getCards()
    {
        return $this->cards;
    }
}