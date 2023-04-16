<?php
  namespace Foxx\Library\Core\Model;

  use Foxx\Library\Core\Enums\LoanGetBy;

  /**
   * Loan
   * 
   * Is a model class that represents a loan of a book.
   * 
   * @package Foxx\Library\Core\Model
   * @author Foxx Azalea Pinkerton
   * @implements \JsonSerializable
   */
  final class Loan implements \JsonSerializable {

    /**
     * Constructor method for Loan
     * 
     * Constructor method for the loan model class.
     * 
     * @param string $userId ID of the user who is loaning the book
     * @param string $date Date the loan was applied
     * @param string $due Date the loan needs to be returned by
     * @param bool $returned Whether the book has been returned or not
     * @param string $returnedDate Date the book was returned, if it has been returned
     * @param string $id Unique ID given to the loan instance 
     */
    public function __construct(
      private string $userId,
      private ?string $date = null,
      private ?string $due = null,
      private ?bool $returned = null,
      private ?string $returnedDate = null,
      private ?string $id = null
    ) {
      $date = date('Y-m-d');
      $due = strtotime($date . " + 2 weeks");
      $id = uniqid("loan_");
      $returned = false;
    }

    /**
     * Json serialiser
     * 
     * Tells json_encode how to serialise the Loan object.
     * 
     * @return array Array of loan data
     */
    public function jsonSerialize(): array {
      return [
        "userId" => $this->userId,
        "date" => $this->date,
        "due" => $this->due,
        "returned" => $this->returned,
        "returnedDate" => $this->returnedDate,
        "id" => $this->id,
      ];
    }

    /**
     * Gets or sets the user ID.
     * 
     * Get or set the user ID of the user who is loaning the book.
     *
     * @param ?string $title The books title.
     * @return string|self
     * @author Command_String#6538
     */
    public function userID($userID = null): string|self {
      return is_null($userID) ? $this->userId : ($this->userId = $userID) && $this;
    }

    /**
     * Gets or sets the date.
     * 
     * Get or set the date the loan was created.
     *
     * @param ?string $title The books title.
     * @return string|self
     * @author Command_String#6538
     */
    public function date($date = null): string|self {
      return is_null($date) ? $this->date : ($this->date = $date) && $this;
    }

    /**
     * Gets or sets the due date.
     * 
     * Get or set the date the loan should be returned by.
     *
     * @param ?string $title The books title.
     * @return string|self
     * @author Command_String#6538
     */
    public function due($due = null): string|self {
      return is_null($due) ? $this->due : ($this->due = $due) && $this;
    }

    /**
     * Gets or sets the returned status.
     * 
     * Get or set the returned status of the book.
     *
     * @param ?string $title The books title.
     * @return string|self
     * @author Command_String#6538
     */
    public function returned($returned = null): string|self {
      return is_null($returned) ? $this->returned : ($this->returned = $returned) && $this;
    }

    /**
     * Gets or sets the returned date.
     * 
     * Get or set the date the book was returned.
     *
     * @param ?string $title The books title.
     * @return string|self
     * @author Command_String#6538
     */
    public function returnedDate($returnedDate = null): string|self {
      return is_null($returnedDate) ? $this->returnedDate : ($this->returnedDate = $returnedDate) && $this;
    }

    /**
     * Gets or sets the loan ID.
     * 
     * Get or set the unique ID given to the loan.
     *
     * @param ?string $title The books title.
     * @return string|self
     * @author Command_String#6538
     */
    public function id($id = null): string|self {
      return is_null($id) ? $this->id : ($this->id = $id) && $this;
    }

    /**
     * Returns the book.
     * 
     * Runs when the book is returned. It sets the return date as today and sets returned to true.
     * 
     * @return void
     */
    public function return(): void {
      $this->returned = true;
      $this->returnedDate = date("Y-m-d");
    }




    
  }