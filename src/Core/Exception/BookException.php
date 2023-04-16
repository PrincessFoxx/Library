<?php
  namespace Foxx\Library\Core\Exception;

  use Exception;
  use Throwable;
  use JsonSerializable;

  use Foxx\Library\Core\Model\Book;

  /**
   * BookException
   * 
   * Is an exception that is thrown when there is a problem with a book
   * 
   * @param string $message The message of the exception
   * @param int $code The code of the exception
   * @param Throwable|null $previous The previous exception
   * @param Book|null $book The book that caused the exception
   * 
   * @package Foxx\Library\Core\Exception
   * @abstract
   * @author Foxx Azalea Pinkerton
   * @version 1.0.0
   */
  abstract class BookException extends Exception implements JsonSerializable
  {
      protected ?Book $book;
  
      public function __construct(string $message, int $code, ?Throwable $previous = null, ?Book $book = null)
      {
          parent::__construct($message, $code, $previous);
          $this->book = $book;
      }
  
      public function getBook(): ?Book
      {
          return $this->book;
      }
  
      abstract public function __toString(): string;
      abstract public function jsonSerialize(): array;
  }
  