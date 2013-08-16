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
     * Current index in the set.
     *
     * @var int
     */
    private $index = 0;

    /**
     * @param array $cards
     *
     * @throws \Exception
     */
    public function __construct($cards = array())
    {
        // Validate that all the values are Card instances.
        foreach ($cards as $card) {
            if (!$card instanceof Card) {
                throw new \Exception('The "SortedCardSet" class only accepts "Card" instances.');
            }
        }

        parent::__construct($cards);

        $this->asort();

        // Reset the keys after the sort.
        $this->exchangeArray(array_values($this->getArrayCopy()));
    }

    /**
     * @return Card
     */
    public function getCurrent()
    {
        return $this->offsetGet($this->getIndex());
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @return bool
     */
    public function hasNext()
    {
        return $this->offsetExists($this->getIndex() + 1);
    }

    /**
     * Get the next Card, without move the index.
     *
     * @return Card
     */
    public function getNext()
    {
        $nextIndex = $this->getIndex() + 1;

        return $this->offsetGet($nextIndex);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($index)
    {
        $card = parent::offsetGet($index);

        $card->setIndex($index);

        return $card;
    }

    /**
     * Move to the next card and return it.
     *
     * @return Card
     */
    public function next()
    {
        $this->incrIndex();

        return $this->getCurrent();
    }

    /**
     * @param int $index
     *
     * @return SortedCardSet
     */
    public function setIndex($index)
    {
         $this->index = $index;

        return $this;
    }

    /**
     * @param array $includeIndex
     *
     * @return SortedCardSet
     */
    public function getSubSortedSetCardIncluding(array $includeIndex)
    {
        $cards = array();

        foreach ($this as $index => $card) {
            if (in_array($index, $includeIndex)) {
                $cards[] = $card;
            }
        }

        return new SortedCardSet($cards);
    }

    /**
     * @param array $excludeIndex
     *
     * @return SortedCardSet
     */
    public function getSubSortedSetCardExcluding(array $excludeIndex)
    {
        $cards = array();

        foreach ($this as $index => $card) {
            if (!in_array($index, $excludeIndex)) {
                $cards[] = $card;
            }
        }

        return new SortedCardSet($cards);
    }

    /**
     * Reset the index to the first position.
     */
    public function resetIndex()
    {
        $this->setIndex(0);
    }

    /**
     * Return all the indices.
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->getArrayCopy());
    }

    /**
     * Increment the index.
     *
     * @return SortedCardSet
     */
    private function incrIndex()
    {
        $this->setIndex($this->getIndex() + 1);

        return $this;
    }
}