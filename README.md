PokerKata
=========

Travis status: [![Build Status](https://travis-ci.org/ianmonge/PokerKata.png?branch=master)](https://travis-ci.org/ianmonge/PokerKata)

Source: [Solveet - Poker kata](http://www.solveet.com/exercises/Poker-Kata/193)

### Classes

* __Card__: simple POPO (Plain Old PHP Object) class that contains the suit and the number of a card.
* __SortedCardSet__: class that extends `ArrayObject` class, that groups the cards. When it is created, it sorts the cards by its number.

Also, there is a class for each combination, that try to match the combination with a `SortedCardSet`. Every combination extends an abstract class. Some combinations use other combinations to match. For example, the combination `TwoPair` use combination `Pair` twice.

The `PokerKata` class create a `SortedCardSet`, and iterate over the combinations trying to match.