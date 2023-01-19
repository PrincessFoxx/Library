<?php
  namespace Foxx\Library\Core\Model;

  use Foxx\Library\Core\Model\Book;
  use Foxx\Library\Core\Enums\UserTypes;

  /**
   * User
   * 
   * Is a class that is used to represent a user
   * 
   * @package Foxx\Library\Core\Model
   * @author Foxx Azalea Pinkerton
   */
  class User implements \JsonSerializable {

    /**
     * The constructor method for the user.
     *
     * This creates a new instance of a user. It takes a first name, last name, email and password.
     *
     * @param string $fname The user's first name.
     * @param string $lname The user's last name.
     * @param string $email The user's unique email.
     * @param string $password The user's unique hashed password.
     * @param UserTypes $role The user's role. defaults to UserTypes::USER
     * @param string $id The user's unique id number. Defaults to uniqid("user_")
     * @param array $books The user's borrowed books. Defaults to empty array()
     * @param string $notes The user's notes. Defaults to empty string
     */
    public function __construct(
      private string $fname,
      private string $lname,
      private string $email,
      private string $password,
      private UserTypes $role = UserTypes::USER,
      private string $id = "",
      private array $books = array(),
      private string $notes = ""
    ) {
      if ($id == "") $this->id = uniqid("user_");
      else $this->id = $id;
    }

    /**
     * Called when attempting to convert to json.
     * 
     * This method should return an array that gets json_encoded when converting to json when saving to database.
     * 
     * @return array
     * @see \Foxx\Library\Core\Persistence\UserManager::saveUsers()
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array {
      return [
        "fname" => $this->fname,
        "lname" => $this->lname,
        "email" => $this->email,
        "password" => $this->password,
        "role" => $this->role,
        "id" => $this->id,
        "books" => $this->books,
        "notes" => $this->notes
      ];
    }

    // Getters and Setters

    /**
     * Gets or sets the user's first name.
     * 
     * Get or set the user's first name as needed.
     * With no arguments, this is a getter.
     * With one argument, this is a setter and the first name get's set to the argument.
     * 
     * @param ?string $fname The user's first name.
     * @return string|self
     */
    public function fname(?string $fname = null): string|self {
      if (is_null($fname)) {
        return $this->fname;
      }
      $this->fname = $fname;
      return $this;
    }

    /**
     * Gets or sets the user's last name.
     * 
     * Get or set the user's last name as needed.
     * With no arguments, this is a getter.
     * With one argument, this is a setter and the last name get's set to the argument.
     * 
     * @param ?string $lname The user's last name.
     * @return string|self
     */
    public function lname(?string $lname = null): string|self {
      if (is_null($lname)) {
        return $this->lname;
      }
      $this->lname = $lname;
      return $this;
    }

    /**
     * Gets or sets the user's email.
     * 
     * Get or set the user's email as needed.
     * With no arguments, this is a getter.
     * With one argument, this is a setter and the email get's set to the argument.
     * 
     * @param ?string $email The user's email.
     * @return string|self
     */
    public function email(?string $email = null): string|self {
      if (is_null($email)) {
        return $this->email;
      }
      $this->email = $email;
      return $this;
    }

    /**
     * Gets or sets the user's unique password hash.
     * 
     * Get or set the user's unique password hash as needed.
     * With no arguments, this is a getter.
     * With one argument, this is a setter and the password hash get's set to the argument.
     * 
     * @param ?string $password The user's password hash.
     * @return string|self
     */
    protected function password(?string $password = null): string|self {
      if (is_null($password)) {
        return $this->password;
      }
      $this->password = $password;
      return $this;
    }

    /**
     * Gets or sets the user's notes.
     *
     * Get or set the user's Notes when needed.
     * With no arguments, this is a getter.
     * With one argument, this is a setter and the notes gets set to the argument.
     *
     * @param string|null $notes
     * @return string|$this
     */
    public function notes(?string $notes = null): string|self {
      if (is_null($notes)) {
        return $this->notes;
      }
      $this->notes = $notes;
      return $this;
    }

    /**
     * Gets or sets the user's unique id number.
     * 
     * Get or set the user's unique id number when needed.
     * With no arguments, this is a getter.
     * With one argument, this is a setter and the id gets set to the argument.
     * 
     * @param ?string $id The user's unique id number.
     * @return string|self
     */
    public function id(?string $id = null): string|self {
      if (is_null($id)) {
        return $this->id;
      }
      $this->id = $id;
      return $this;
    }

    /**
     * User Types
     * 
     * Get or set the user's role as needed.
     *
     * @param ?UserTypes $role
     * @return self|UserTypes
     */
    public function userTypes(UserTypes $role = null): self|UserTypes {
      if (is_null($role)) {
        return $this->role;
      }
      $this->role = $role;
      return $this;
    }

    /**
     * Adds a book to the user's borrowed book list.
     * 
     * This method adds a book to the user's borrowed book list.
     * 
     * @param Book $book The book to be added to the user's borrowed book list.
     * @return self
     */
    public function addBook(Book $book): self {
      $this->books[] = $book;
      return $this;
    }

    /**
     * Removes a book from this user's borrowed book list.
     * 
     * This method removes a book from this user's borrowed book list.
     * 
     * @param Book $book The book to be removed from the user's borrowed book list.
     * @return self
     */
    public function removeBook(Book $book): self {
      $this->books = array_filter($this->books, function($b) use ($book) {
        return $b->id() != $book->id();
      });
      return $this;
    }
   
    /**
     * Verifies the user's password.
     * 
     * This method verifies the user's password to the password hash.
     * 
     * @param string $password The user's password.
     * @return bool
     */
    public function verifyPassword(string $password): bool {
      return password_verify($password, $this->password());
    }

    /**
     * Resets the user's password.
     * 
     * This method resets the user's password to the password hash provided.
     * 
     * @param string $hash The user's password hash.
     * @return void
     */
    public function resetPassword(string $hash) {
      $this->password($hash);
    }
  }