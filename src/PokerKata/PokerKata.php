<?php

namespace PokerKata;

use PokerKata\Combination\Pair;

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
//        } elseif ($this->isCombinationThreeOfAKind($cards)) {
//            return Combination::COMB_THREE_OF_A_KIND;
//        } elseif ($this->isCombinationTwoPair($cards)) {
//            return Combination::COMB_TWO_PAIR;
//        } else
        $combinationPair = new Pair();
        if ($combinationPair->match($cards)) {
            return Combination::COMB_PAIR;
        }
        return Combination::COMB_HIGH_CARD;
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

    /**
     * @param array $cards
     *
     * @return bool
     */
    private function isCombinationStraight(array $cards)
    {
        if (current($cards)->getNumber() === 1
            && $cards[1]->getNumber() === 10
        ) {
            $aceCard = array_shift($cards);
            $newAceCard = new Card($aceCard->getSuit(), 14);
            array_push($cards, $newAceCard);
        }

        $previousNumber = current($cards)->getNumber();
        array_shift($cards);

        foreach ($cards as $card) {
            if ($previousNumber+1 !== $card->getNumber()) {
                return false;
            }

            $previousNumber = $card->getNumber();
        }

        return true;
    }

    /**
     * @param array $cards
     *
     * @return bool
     */
    private function isCombinationThreeOfAKind(array $cards)
    {
        $firstCard = $this->findCardThreeOfAKind($cards);

        if (null === $firstCard) {
            return false;
        }

        return true;
    }

    /**
     * @param array $cards
     *
     * @return bool
     */
    private function isCombinationTwoPair(array $cards)
    {
        $firstPairPosition = $this->findCardPair($cards);

        if (null === $firstPairPosition) {
            return false;
        }

        $lastCardOfFirstPair = $firstPairPosition+1;

        $cards = array_slice($cards, $lastCardOfFirstPair+1);

        return $this->isCombinationPair($cards);
    }

    /**
     * Find a card three of a kind. If it find them, it return the position of the first card.
     * Else it returns null.
     *
     * @param SortedCardSet $cards
     *
     * @return int
     */
    private function findCardThreeOfAKind(SortedCardSet $cards)
    {
        $firstCard = $this->findCardPair($cards);

        if (null === $firstCard) {
            return null;
        }

        $lastCardOfPair             = $cards[$firstCard+1];
        $nextCardTolastCardOfPair   = $cards[$firstCard+2];

        if ($lastCardOfPair->getNumber() === $nextCardTolastCardOfPair->getNumber()) {
            return $firstCard;
        }

        /**
         * If the third card is no the equals, maybe the three cards that rests are a three of a kind.
         */
        if ($firstCard === 0 && 2 < count($cards)) {
            unset($cards[$firstCard]);
            unset($cards[$firstCard+1]);

            $cards = array_values($cards);

            $firstCard = $this->findCardThreeOfAKind($cards);
            if (null === $firstCard) {
                return null;
            }
            return $firstCard + 2;
        }

        return null;
    }

}
