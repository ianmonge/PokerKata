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
            return $a->getNumber() > $a->getNumber() ? 1 : -1;
        };

        usort($cards, $sortFunction);

        return $cards;
    }

    /**
     * @param array $cards
     */
    private function findWinnerCombination(array $cards)
    {
        if ($this->isCombinationPair($cards)) {
            return CardSetCombination::COMB_PAIR;
        }
        return CardSetCombination::COMB_HIGH_CARD;
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
                return array($key-1, $key);
            }

            $previousNumber = $card->getNumber();
        }

        return array();
    }
}
