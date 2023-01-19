<?php 
  namespace Foxx\Library\Core\Display;
  use Foxx\Library\Core\Model\Book;

  /**
   * BookCardMaker
   * 
   * Is a class that is used to make book cards
   * 
   * @package Foxx\Library\Core\Display
   * @author Foxx Azalea Pinkerton
   */
  class BookCardMaker {

    /**
     * makeCardList
     * 
     * Is a function that is used to make a book card
     *
     * @param array $cards The cards that are being made
     * @return string The card that is being made
     */
    public function makeCardList(array $cards) {
      /**
       * @var string $cardList The list of cards that is being made
       */
      $cardList = '<div class="card-group">';

      /**
       * @var int $count The number of cards that have been made
       */
      $count = 0;

      
      foreach ($cards as $card) { // make the cards into a list
        $cardList .= $card;
        $count++;

        if ($count % 3 == 0) { // make a new row every 3 cards
          $cardList .= '</div>';
          $cardList .= '<div class="card-group">';
        }
      }

      $cardList .= '</div>'; // close the card list

      return $cardList; // return the card list
    }
  }