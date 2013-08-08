<?php

namespace PokerKata\Tests;

use PokerKata\Card;
use PokerKata\CardSet;
use PokerKata\CardSetCombination;
use PokerKata\PokerKata;

/**
 * Class PokerKataTest
 *
 * @package PokerKata\Tests
 */
class PokerKataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PokerKata
     */
    protected $pokerKata;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->pokerKata = new PokerKata;
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        $this->pokerKata = null;

        parent::tearDown();
    }

    /**
     * @param array  $cards
     * @param string $expectedCombination
     *
     * @dataProvider getCardsDataProvider
     */
    public function testGetWinnerCombination(array $cards, $expectedCombination)
    {
        $cardSet = new CardSet($cards);

        $actualCombination = $this->pokerKata->getWinnerCombination($cardSet);

        $this->assertEquals($expectedCombination,$actualCombination);
    }

    public function getCardsDataProvider()
    {
        return array(
            'High card' => array(
                array(
                    new Card(Card::SUIT_CLUB, 1),
                    new Card(Card::SUIT_HEARTS, Card::NUM_KING),
                    new Card(Card::SUIT_HEARTS, 5),
                    new Card(Card::SUIT_SPADE, 8),
                    new Card(Card::SUIT_DIAMONTS, 3),
                ),
                CardSetCombination::COMB_HIGH_CARD,
            ),
            'Pair' => array(
                array(
                    new Card(Card::SUIT_HEARTS, 3),
                    new Card(Card::SUIT_CLUB, 1),
                    new Card(Card::SUIT_DIAMONTS, 3),
                    new Card(Card::SUIT_SPADE, 8),
                    new Card(Card::SUIT_HEARTS, Card::NUM_KING),
                ),
                CardSetCombination::COMB_PAIR,
            ),
            'Two pair' => array(
                array(
                    new Card(Card::SUIT_HEARTS, 3),
                    new Card(Card::SUIT_CLUB, 1),
                    new Card(Card::SUIT_HEARTS, 1),
                    new Card(Card::SUIT_DIAMONTS, 3),
                    new Card(Card::SUIT_SPADE, 8),
                ),
                CardSetCombination::COMB_TWO_PAIR,
            ),
            'Three of a king' => array(
                array(
                    new Card(Card::SUIT_HEARTS, 3),
                    new Card(Card::SUIT_CLUB, 1),
                    new Card(Card::SUIT_HEARTS, 1),
                    new Card(Card::SUIT_DIAMONTS, 3),
                    new Card(Card::SUIT_HEARTS, 1),
                ),
                CardSetCombination::COMB_THREE_OF_A_KIND,
            ),
            'Straight at the begining' => array(
                array(
                    new Card(Card::SUIT_HEARTS, 5),
                    new Card(Card::SUIT_HEARTS, 1),
                    new Card(Card::SUIT_HEARTS, 3),
                    new Card(Card::SUIT_DIAMONTS, 2),
                    new Card(Card::SUIT_CLUB, 4),
                ),
                CardSetCombination::COMB_STRAIGHT,
            ),
            'Straight in the middle' => array(
                array(
                    new Card(Card::SUIT_HEARTS, 7),
                    new Card(Card::SUIT_HEARTS, 3),
                    new Card(Card::SUIT_DIAMONTS, 6),
                    new Card(Card::SUIT_CLUB, 4),
                    new Card(Card::SUIT_HEARTS, 5),
                ),
                CardSetCombination::COMB_STRAIGHT,
            ),
            'Straight at the end' => array(
                array(
                    new Card(Card::SUIT_HEARTS, 1),
                    new Card(Card::SUIT_CLUB, Card::NUM_JACK),
                    new Card(Card::SUIT_HEARTS, Card::NUM_KING),
                    new Card(Card::SUIT_HEARTS, 10),
                    new Card(Card::SUIT_DIAMONTS, Card::NUM_QUEEN),
                ),
                CardSetCombination::COMB_STRAIGHT,
            ),
        );
    }
}