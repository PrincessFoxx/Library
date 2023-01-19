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
  enum UserTypes: string {
    case USER = "USER";
    case ADMIN = "ADMIN";

    /**
     * Returns UserTypes given a string.
     * 
     * get the user type corresponding to the string
     * 
     * @param string $type
     * @return UserTypes
     */
    public static function fromString(string $type): UserTypes {
      return match($type) {
        'USER' => static::USER,
        'ADMIN' => static::ADMIN,
        default => null
      };
    }
  }