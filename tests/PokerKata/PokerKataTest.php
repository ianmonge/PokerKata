<?php

namespace PokerKata\Tests;

use PokerKata\Card;
use PokerKata\SortedCardSet;
use PokerKata\Combination;
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
     * @param array  $cardsArray
     * @param string $expectedCombination
     *
     * @dataProvider getDataProviderCards
     */
    public function testGetWinnerCombination(array $cardsArray, $expectedCombination)
    {
        $cards = new SortedCardSet($cardsArray);

        $actualCombination = $this->pokerKata->getBestCombination($cards);

        $this->assertEquals($expectedCombination,$actualCombination);
    }

    /**
     * Return the data provider of cards.
     *
     * @return array
     */
    public function getDataProviderCards()
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
                Combination::COMB_HIGH_CARD,
            ),
            'Pair' => array(
                array(
                    new Card(Card::SUIT_HEARTS, 3),
                    new Card(Card::SUIT_CLUB, 1),
                    new Card(Card::SUIT_DIAMONTS, 3),
                    new Card(Card::SUIT_SPADE, 8),
                    new Card(Card::SUIT_HEARTS, Card::NUM_KING),
                ),
                Combination::COMB_PAIR,
            ),
            'Two pair' => array(
                array(
                    new Card(Card::SUIT_HEARTS, 3),
                    new Card(Card::SUIT_CLUB, 1),
                    new Card(Card::SUIT_HEARTS, 1),
                    new Card(Card::SUIT_DIAMONTS, 3),
                    new Card(Card::SUIT_SPADE, 8),
                ),
                Combination::COMB_TWO_PAIR,
            ),
//            'Three of a king' => array(
//                array(
//                    new Card(Card::SUIT_HEARTS, 3),
//                    new Card(Card::SUIT_CLUB, 1),
//                    new Card(Card::SUIT_HEARTS, 7),
//                    new Card(Card::SUIT_DIAMONTS, 3),
//                    new Card(Card::SUIT_HEARTS, 3),
//                ),
//                Combination::COMB_THREE_OF_A_KIND,
//            ),
//            'Straight at the begining' => array(
//                array(
//                    new Card(Card::SUIT_HEARTS, 5),
//                    new Card(Card::SUIT_HEARTS, 1),
//                    new Card(Card::SUIT_HEARTS, 3),
//                    new Card(Card::SUIT_DIAMONTS, 2),
//                    new Card(Card::SUIT_CLUB, 4),
//                ),
//                Combination::COMB_STRAIGHT,
//            ),
//            'Straight in the middle' => array(
//                array(
//                    new Card(Card::SUIT_HEARTS, 7),
//                    new Card(Card::SUIT_HEARTS, 3),
//                    new Card(Card::SUIT_DIAMONTS, 6),
//                    new Card(Card::SUIT_CLUB, 4),
//                    new Card(Card::SUIT_HEARTS, 5),
//                ),
//                Combination::COMB_STRAIGHT,
//            ),
//            'Straight at the end' => array(
//                array(
//                    new Card(Card::SUIT_HEARTS, 1),
//                    new Card(Card::SUIT_CLUB, Card::NUM_JACK),
//                    new Card(Card::SUIT_SPADE, Card::NUM_KING),
//                    new Card(Card::SUIT_HEARTS, 10),
//                    new Card(Card::SUIT_DIAMONTS, Card::NUM_QUEEN),
//                ),
//                Combination::COMB_STRAIGHT,
//            ),
//            'Flush' => array(
//                array(
//                    new Card(Card::SUIT_HEARTS, 10),
//                    new Card(Card::SUIT_HEARTS, 1),
//                    new Card(Card::SUIT_HEARTS, Card::NUM_QUEEN),
//                    new Card(Card::SUIT_HEARTS, 5),
//                    new Card(Card::SUIT_HEARTS, 4),
//                ),
//                Combination::COMB_FLUSH,
//            ),
//            'Full house Low' => array(
//                array(
//                    new Card(Card::SUIT_HEARTS, 3),
//                    new Card(Card::SUIT_CLUB, Card::NUM_JACK),
//                    new Card(Card::SUIT_SPADE, Card::NUM_JACK),
//                    new Card(Card::SUIT_HEARTS, 3),
//                    new Card(Card::SUIT_DIAMONTS, 3),
//                ),
//                Combination::COMB_FULL_HOUSE,
//            ),
//            'Full house High' => array(
//                array(
//                    new Card(Card::SUIT_HEARTS, 3),
//                    new Card(Card::SUIT_CLUB, Card::NUM_JACK),
//                    new Card(Card::SUIT_SPADE, Card::NUM_JACK),
//                    new Card(Card::SUIT_HEARTS, 3),
//                    new Card(Card::SUIT_DIAMONTS, Card::NUM_JACK),
//                ),
//                Combination::COMB_FULL_HOUSE,
//            ),
//            'Four of a kind High' => array(
//                array(
//                    new Card(Card::SUIT_HEARTS, Card::NUM_JACK),
//                    new Card(Card::SUIT_CLUB, Card::NUM_JACK),
//                    new Card(Card::SUIT_SPADE, Card::NUM_JACK),
//                    new Card(Card::SUIT_HEARTS, 3),
//                    new Card(Card::SUIT_DIAMONTS, Card::NUM_JACK),
//                ),
//                Combination::COMB_FOUR_OK_A_KIND,
//            ),
//            'Four of a kind Low' => array(
//                array(
//                    new Card(Card::SUIT_CLUB, 7),
//                    new Card(Card::SUIT_HEARTS, Card::NUM_JACK),
//                    new Card(Card::SUIT_SPADE, 7),
//                    new Card(Card::SUIT_HEARTS, 7),
//                    new Card(Card::SUIT_DIAMONTS, 7),
//                ),
//                Combination::COMB_FOUR_OK_A_KIND,
//            ),
        );
    }
}
