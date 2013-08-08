<?php

namespace PokerKata;

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
    public function getWinnerCombination(CardSet $cardSet)
    {
        $cards = $cardSet->getCards();

        $sortedCards = $this->sortCards($cards);

        $winnerCombination = $this->findWinnerCombination($sortedCards);

        return $winnerCombination;
    }

    private function sortCards(array $cards)
    {
        $sortFunction = function(Card $a, Card $b) {
            return $a->getNumber() > $b->getNumber() ? 1 : -1;
        };

        usort($cards, $sortFunction);

        return $cards;
    }

    /**
     * @param array $cards
     */
    private function findWinnerCombination(array $cards)
    {
        if ($this->isCombinationFlush($cards)) {
            return CardSetCombination::COMB_FLUSH;
        } elseif ($this->isCombinationStraight($cards)) {
            return CardSetCombination::COMB_STRAIGHT;
        } elseif ($this->isCombinationThreeOfAKind($cards)) {
            return CardSetCombination::COMB_THREE_OF_A_KIND;
        } elseif ($this->isCombinationTwoPair($cards)) {
            return CardSetCombination::COMB_TWO_PAIR;
        } elseif ($this->isCombinationPair($cards)) {
            return CardSetCombination::COMB_PAIR;
        }
        return CardSetCombination::COMB_HIGH_CARD;
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
        $firstPairPositions = $this->findCardPair($cards);

        if (empty($firstPairPositions)) {
            return false;
        }

        $lastCardOfPair             = $cards[$firstPairPositions[1]];
        $nextCardTolastCardOfPair   = $cards[$firstPairPositions[1]+1];

        if ($lastCardOfPair->getNumber() === $nextCardTolastCardOfPair->getNumber()) {
            return true;
        }

        return false;
    }

    /**
     * @param array $cards
     *
     * @return bool
     */
    private function isCombinationTwoPair(array $cards)
    {
        $firstPairPositions = $this->findCardPair($cards);

        if (empty($firstPairPositions)) {
            return false;
        }

        $lastCardOfFirstPair = $firstPairPositions[1];

        $cards = array_slice($cards, $lastCardOfFirstPair+1);

        return $this->isCombinationPair($cards);
    }

    /**
     * @param array $cards
     *
     * @return bool
     */
    private function isCombinationPair(array $cards)
    {
        $positions = $this->findCardPair($cards);

        return !empty($positions);
    }

    /**
     * Find a card pair. If it find them, it return their positions. If not, it returns an empty array.
     *
     * @param array $cards
     *
     * @return array
     */
    private function findCardPair(array $cards)
    {
        $previousNumber = current($cards)->getNumber();
        array_shift($cards);

        foreach ($cards as $key => $card) {
            if ($previousNumber === $card->getNumber()) {
                return array($key, $key+1);
            }

            $previousNumber = $card->getNumber();
        }

        return array();
    }
}
