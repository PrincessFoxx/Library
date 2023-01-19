<?php
  namespace Foxx\Library\Core\Exception;

  use Exception;
  use Throwable;

  /**
   * BookException
   * 
   * Is an exception that is thrown when there is an error with the book class.
   * 
   * @package Foxx\Library\Core\Exception
   * @author Foxx Azalea Pinkerton
   */
  class BookException extends Exception {

    /**
     * @var string The error message for when the book is already checked out.
     */
    const LOANED = "Another user is already using the book! ";

    /**
     * @var string The error message for when the book is not found.
     */
    const NO_RECORD = "There are no records of this book in the library! ";

    /**
     * @var string The error message for when the book is not found by the author.
     */
    const NO_RECORD_BY_AUTHOR = "No objects with this author were found! ";

    /**
     * @var string The error message for when the book is not found by the ID.
     */
    const NO_RECORD_BY_ID = "No objects with this id were found! ";

    /**
     * @var string The error message for when the book is not found by the title.
     */
    const NO_RECORD_BY_TITLE = "No objects with this title were found! ";

    /**
     * @var string The error message for when the book is not found by the genre.
     */
    const NO_RECORD_BY_GENRE = "No objects with this genre were found! ";


    /**
     * @var integer The error code for when the book is already checked out.
     */
    const LOANED_CODE = 0x01;

    /**
     * @var integer The error code for when the book is not found.
     */
    const NO_RECORD_CODE = 0x02;

    /**
     * @var integer The error code for when the book is not found by the author.
     */
    const NO_RECORD_BY_AUTHOR_CODE = 0x03;

    /**
     * @var integer The error code for when the book is not found by the ID.
     */
    const NO_RECORD_BY_ID_CODE = 0x04;

    /**
     * @var integer The error code for when the book is not found by the title.
     */
    const NO_RECORD_BY_TITLE_CODE = 0x05;

    /**
     * @var integer The error code for when the book is not found by the genre.
     */
    const NO_RECORD_BY_GENRE_CODE = 0x06;



    /**
     * BookException
     * 
     * Is the constructor for the BookException class.
     * 
     * @param string $message The error message.
     * @param int $code The error code.
     * @param Throwable $previous The previous error.
     */
    public function __construct(
      string $message,
      int $code = 0,
      Throwable $previous = null
    ) {
      parent::__construct($message, $code, $previous); // Call the parent constructor
    }

    /**
     * __toString
     * 
     * Is the function that is called when the exception is converted to a string.
     * 
     * @return string The error message.
     */
    public function __toString() {
      $errorMessage = "ERROR " . __CLASS__ . " [{$this->code}]: {$this->message} in {$this->file} on line {$this->line}";
      return $errorMessage;
    }
  }