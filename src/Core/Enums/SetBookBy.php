<?php
  namespace Foxx\Library\Core\Enums;

  /**
   * LoanGetBy
   * 
   * Is an enum that is used to get loans by a certain value
   * 
   * @package Foxx\Library\Core\Enums
   * @author Foxx Azalea Pinkerton
   */
  enum SetBookBy {
    case Title;
    case Author;
    case Genres;
    case Description;
    case Cover;
    case AddRating;
    case AddLoan;
    case Id;
  }