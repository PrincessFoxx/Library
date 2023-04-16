<?php

namespace Foxx\Library\Core\Exception;

use Throwable;

use Foxx\Library\Core\Exception\BookException;
use Foxx\Library\Core\Model\Book;
use Foxx\Library\Core\Model\Loan;
use Foxx\Library\Core\Enums\GetBooksBy;

class BookNotFoundException extends BookException {
  public function __construct(
    protected GetBooksBy $searchingBy,
    protected string $message = "",
    protected int $code = 701,
    protected ?Throwable $previous = null,
  ) {
    $this->message = "Book not found by {$searchingBy}.";
    parent::__construct($this->message, $code, $previous);
  }

  public function __toString(): string {
    return "BookNotFoundException: {$this->message} ({$this->code})";
  }

  public function jsonSerialize(): array {
    return [
      "code" => $this->code,
      "message" => $this->message,
      "searchingBy" => $this->searchingBy,
      "time" => time(),
    ];
  }
}
