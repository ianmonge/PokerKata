<?php

namespace PokerKata;

use PokerKata\Combination\HighCard;
use PokerKata\Combination\Pair;
use PokerKata\Combination\Straight;
use PokerKata\Combination\ThreeOfAKind;
use PokerKata\Combination\TwoPair;

/**
 * Class PokerKata
 *
 * @package PokerKata
 */
class PokerKata implements PokerKataInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBestCombination(SortedCardSet $cards)
    {
//        if ($this->isCombinationFourOfAKind($cards)) {
//            return Combination::COMB_FOUR_OK_A_KIND;
//        } elseif ($this->isCombinationFullHouse($cards)) {
//            return Combination::COMB_FULL_HOUSE;
//        } elseif ($this->isCombinationFlush($cards)) {
//            return Combination::COMB_FLUSH;
//        } elseif ($this->isCombinationStraight($cards)) {
//            return Combination::COMB_STRAIGHT;
        $combinationHighCard        = new HighCard();
        $combinationPair            = new Pair();
        $combinationTwoPair         = new TwoPair();
        $combinationThreeOfAKind    = new ThreeOfAKind();
        $combinationStraight        = new Straight();

        if ($combinationStraight->match($cards)) {
            return Combination::COMB_STRAIGHT;
        } elseif ($combinationThreeOfAKind->match($cards)) {
            return Combination::COMB_THREE_OF_A_KIND;
        } elseif ($combinationTwoPair->match($cards)) {
            return Combination::COMB_TWO_PAIR;
        } elseif ($combinationPair->match($cards)) {
            return Combination::COMB_PAIR;
        } elseif ($combinationHighCard->match($cards)) {
            return Combination::COMB_HIGH_CARD;
        }
    }

    /**
     * @param array $cards
     *
     * @return bool
     */
    private function isCombinationFourOfAKind(array $cards)
    {
        $firstCardOfThreeIndex = $this->findCardThreeOfAKind($cards);

        if (null === $firstCardOfThreeIndex || $firstCardOfThreeIndex > 1) {
            return false;
        }

        $lastCardOfThree           = $cards[$firstCardOfThreeIndex+2];
        $nextCardToLastCardOfThree = $cards[$firstCardOfThreeIndex+3];

        if ($lastCardOfThree->getNumber() === $nextCardToLastCardOfThree->getNumber()) {
            return true;
        }

        return false;
    }

    /**
     * @param array $cards
     *
     * @return bool
     */
    private function isCombinationFullHouse(array $cards)
    {
        $firstCardIndex = $this->findCardThreeOfAKind($cards);

        if (null === $firstCardIndex || 1 === $firstCardIndex) {
            return false;
        }

        unset($cards[$firstCardIndex]);
        unset($cards[$firstCardIndex+1]);
        unset($cards[$firstCardIndex+2]);

        return $this->isCombinationPair($cards);
    }

    /**
     * @param array $cards
     *
     * @return bool
     */
    private function isCombinationFlush(array $cards)
    {
        $previousSuit = current($cards)->getSuit();
        array_shift($cards);

        foreach ($cards as $card) {
            if ($previousSuit !== $card->getSuit()) {
                return false;
            }

            $previousSuit = $card->getSuit();
        }

        return true;
    }
}
