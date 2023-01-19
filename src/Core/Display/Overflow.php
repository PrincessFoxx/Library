<?php
  namespace Foxx\Library\Core\Display;

  use Foxx\Library\Core\Enums\UserTypes;
  use Foxx\Library\Core\Model\User;

  /**
   * Overflow
   * 
   * Is a class that is used to make overflow functions that dont fit anywhere else
   * 
   * @package Foxx\Library\Core\Display
   * @author Foxx Azalea Pinkerton
   */
  class Overflow {

    /**
     * Valid User
     * 
     * Validates the user is logged in and has the correct user type
     * 
     * @param UserTypes $userTypes
     * @param User $user
     * @return bool if the user is valid or not
     */
    public static function validUser(userTypes $userTypes, User $user): bool {
      if ($user->userTypes() != $userTypes) {
        return false;
      }

      return true;
    }
  }