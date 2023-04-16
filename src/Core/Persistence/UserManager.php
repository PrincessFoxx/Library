<?php
  namespace Foxx\Library\Core\Persistence;

  use Foxx\Library\Core\Model\User;
  use Foxx\Library\Core\Model\Book;

  use Foxx\Library\Core\Enums\UserTypes;
  use Foxx\Library\Core\Enums\GetUsersBy;

  /**
   * UserManager
   * 
   * Is a class that is used to manage the users in the database
   * 
   * @package Foxx\Library\Core\Persistence
   * @author Foxx Azalea Pinkerton
   */
  final class UserManager {
    const DEBUG = true;
    const FILE = __DIR__ . DIRECTORY_SEPARATOR . "Files" . DIRECTORY_SEPARATOR . "Users.json";

    /**
     * @var array $users The users in the database
     */
    private array $users = array();

    public function __construct() {
      $this->load();
    }

    public function __destruct() {
      $this->save();
    }

    /**
     * load
     * 
     * Loads the users from the database
     *
     * @return void
     */
    protected function load(): bool {
      try {
        /**
         * @var array $users The users from the database
         */
        $users = json_decode(self::FILE, true);
          
        foreach ($users as $user) {
          $this->users[] = new User(
            $user["fname"],
            $user["lname"],
            $user["email"],
            $user["password"],
            UserTypes::fromString($user["role"]),
            $user["id"],
            $user["books"],
            $user["notes"]
          );
        }
      } catch (\Exception $e) {
        if (self::DEBUG) {
          echo $e->getMessage();
        }
        return false;
      }
    }

    /**
     * save
     * 
     * Saves the users to the database
     *
     * @return void
     */
    protected function save(): bool {
      try {
        $users = array();
        foreach ($this->users as $user) {
          $users[] = $user->jsonSerialize();
        }
        file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . "Files" . DIRECTORY_SEPARATOR . "Users.json", json_encode($users));
        return true;
      } catch (\Exception $e) {
        if (self::DEBUG) {
          echo $e->getMessage();
        }
        return false;
      }
    }

    /**
     * Gets a user by criteria
     * 
     * Gets all users with the specified criteria like id, email etc.
     * If an id is specified it uses that id to get the user, same goes for other fields.
     * 
     * @param GetUsersBy $type
     * @param string $value
     * @return array
    */
    public function GetUsersBy(GetUsersBy $by, string $value): array {
      $users = array();
      foreach ($this->users as $user) {
        switch ($by) {
          case GetUsersBy::ID:
            if ($user->id() == $value) {
              $users[] = $user;
            }
            break;
          case GetUsersBy::EMAIL:
            if ($user->email() == $value) {
              $users[] = $user;
            }
            break;
        }
      }
      return $users;
    }

    /**
     * verifyUser
     * 
     * Checks if the user exists in the database and if the password is correct
     * 
     * @param string $email
     * @param string $password
     * @return User|null 
     */
    public function verifyUser(string $email, string $password): User|null {
      $users = $this->GetUsersBy(GetUsersBy::EMAIL, $email);
      if (count($users) == 1) {
        $u = $users[0];
        return password_verify($password, $u->password()) ? $u : null;
      }
      return null;
    }

    /**
     * add
     * 
     * Adds a user to the database
     * 
     * @param User $user
     * @return void
     */
    public function add(User $user): bool {
      try {
        $this->users[] = $user;
        self::DEBUG ? $this->save() : null;
        return true;
      } catch (\Exception $e) {
        if (self::DEBUG) {
          echo $e->getMessage();
        }
        return false;
      }
    }
  }