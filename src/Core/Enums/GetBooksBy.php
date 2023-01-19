<?php
  namespace Foxx\Library\Core\Enums;

  /**
   * GetBooksBy
   * 
   * Is an enum that is used to get books by a certain value
   * 
   * @package Foxx\Library\Core\Enums
   * @author Foxx Azalea Pinkerton
   */
  enum GetBooksBy {
    case Id;
    case Title;
    case Author;
    case Genre;
  }