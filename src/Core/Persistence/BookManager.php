<?php
  namespace Foxx\Library\Core\Persistence;
  use InvalidArgumentException;

  use Foxx\Library\Core\Persistence\Manager;

  use Foxx\Library\Core\Model\Book;
  use Foxx\Library\Core\Model\Loan;
  use Foxx\Library\Core\Enums\GetBooksBy;
  use Foxx\Library\Core\Enums\SetBookBy;
  use Foxx\Library\Core\Exception\BookException;


  /**
   * BookManager
   * 
   * Is a class that manages the books and loans
   * 
   * @package Foxx\Library\Core\Persistence
   * @author Foxx Azalea Pinkerton
   */
  class BookManager extends Manager {
    const FILE = __DIR__ . DIRECTORY_SEPARATOR . "Files" . DIRECTORY_SEPARATOR . "Books.json";

    /**
     * @var array $books The books
     */
    private $books = array();

    // /**
    //  * @var array $loans The loans
    //  */
    // private $loans = array();


    public function __construct() {
      $this->load();
    }

    public function __destruct() {
      $this->save();
    }

    /**
     * load
     * 
     * Is a function that loads the books from the json file
     * 
     * @return bool
     */
    protected function load():bool {
      try {
        /**
         * @var array $books The books from the json file
         */
        $books = json_decode($this::FILE, true);
        foreach ($books as $book) {
          $bookLoans = array();
          foreach ($book["loan"] as $loan) {
            $bookLoans[] = new Loan($loan["userId"], $loan["date"], $loan["due"], $loan["returned"], $loan["returned_date"], $loan["id"]);
          }
          $this->books[] = new Book(
            $book["title"],
            $book["author"],
            $book["genres"],
            $book["description"],
            $bookLoans,
            $book["cover"],
            $book["rating"],
            $book["ratings"],
            $book["id"]
          );
        }
      } catch (\Exception $e) {
        if(self::DEBUG) {
          echo $e->getMessage();
        } 
        return false;
      }
    }

    /**
     * save
     * 
     * Is a function that saves the books to the json file
     * 
     * @return bool Whether the save was successful or not
     */
    protected function save():bool {
      try{
        $books = array();
        foreach ($this->books as $book) {
          $books[] = $book->jsonSerialize();
        }
        file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . "Files" . DIRECTORY_SEPARATOR . "Books.json", json_encode($books));
        return true;
      } catch (\Exception $e) {
        if(self::DEBUG) {
          echo $e->getMessage();
        }
        return false;
      }
    }

    /**
     * add
     * 
     * Is a function that adds a book to the books array
     */
    public function add(Book $book):bool {
      try {
        $this->books[] = $book;
        self::DEBUG ? $this->save() : null;

        return true;
      } catch (\Exception $e) {
        if(self::DEBUG) {
          echo $e->getMessage();
        }
        return false;
      }
    }

    /**
     * addLoan
     * 
     * Is a function that adds a loan to the loans array
     */
    public function addLoan(Loan $loan) {
      $this->loans[] = $loan;
    }

    /**
     * getBooks
     * 
     * Is a function that returns the books array
     */
    public function getBooks() {
      return $this->books;
    }

    /**
     * getLoans
     * 
     * Is a function that returns the loans array
     */
    public function getLoans() {
      return $this->loans;
    }

    /**
     * getLoanById
     * 
     * Is a function that returns a loan by its id
     * 
     * @param int $id The id of the loan
     * @return Loan|null The loan or null if not found
     */
    public function getLoanById($id) {
      foreach ($this->loans as $loan) {
        if ($loan->getId() == $id) {
          return $loan;
        }
      }
      return null;
    }

    /**
     * Get an array of books by the specified criteria.
     *
     * @param GetBooksBy $getBy The criteria by which to search for books.
     * @param string|int $value The value to search for.
     * @return Book[] An array of books that match the criteria.
     * @throws BookException If no books match the criteria.
     * @author Command_String#6538
     */
    public function getBooksBy(GetBooksBy $getBy, string|int $value): array
    {
      $books = [];
      foreach ($this->books as $book) {
        switch ($getBy) {
          case GetBooksBy::Author:
            $get = $book->author();
            break;
          case GetBooksBy::Genre:
            $get = $book->genre();
            break;
          case GetBooksBy::Title:
            $get = $book->title();
            break;
          case GetBooksBy::Id:
            $get = $book->id();
            break;
          default:
            throw new InvalidArgumentException('Invalid search criteria.');
        }
        if ($get === $value) {
          $books[] = $book;
        }
      }
      if (count($books) > 0) {
        return $books;
      }
      throw new BookException(
        match ($getBy) {
          GetBooksBy::Author => BookException::NO_RECORD_BY_AUTHOR . $value,
          GetBooksBy::Genre => BookException::NO_RECORD_BY_GENRE . $value,
          GetBooksBy::Title => BookException::NO_RECORD_BY_TITLE . $value,
          GetBooksBy::Id => BookException::NO_RECORD_BY_ID . $value,
        },
        match ($getBy) {
          GetBooksBy::Author => BookException::NO_RECORD_BY_AUTHOR_CODE,
          GetBooksBy::Genre => BookException::NO_RECORD_BY_GENRE_CODE,
          GetBooksBy::Title => BookException::NO_RECORD_BY_TITLE_CODE,
          GetBooksBy::Id => BookException::NO_RECORD_BY_ID_CODE,
        }
      );
    }

  }