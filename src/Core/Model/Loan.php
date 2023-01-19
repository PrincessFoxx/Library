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
      private string $date,
      private string $due,
      private bool $returned,
      private ?string $returned_date,
      private string $id
    ) {
      $date = date('Y-m-d');
      $due = strtotime($date . " + 2 weeks");
      $id = uniqid("loan_");
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
        "returned_date" => $this->returned_date,
        "id" => $this->id,
      ];
    }

    /**
     * Gets the loan by specified type
     * 
     * Fetches the specified value from loan
     * USER_ID is the id of the user who is loaning the book.
     * DATE is the date the loan was created.
     * DUE is the date the loan should be returned by.
     * RETURNED is whether the book has been returned or not.
     * RETURNED_DATE is the date the book was returned.
     * ID is the unique id given to the loan.
     * 
     * @param LoanGetBy $type
     * @return mixed The value of the loan attribute that was requested
     */
    public function get(LoanGetBy $getBy):mixed {
      switch ($getBy) {
        case LoanGetBy::USER_ID:
          return $this->userId;
        case LoanGetBy::DATE:
          return $this->date;
        case LoanGetBy::DUE:
          return $this->due;
        case LoanGetBy::RETURNED:
          return $this->returned;
        case LoanGetBy::RETURNED_DATE:
          return $this->returned_date;
        case LoanGetBy::ID:
          return $this->id;
        default:
          return null;
      }
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
      $this->returned_date = date("Y-m-d");
    }




    
  }