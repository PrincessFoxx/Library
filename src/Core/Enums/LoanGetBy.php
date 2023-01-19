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
  enum LoanGetBy {
    case USER_ID;
    case DATE;
    case DUE;
    case RETURNED;
    case RETURNED_DATE;
    case ID;
  }