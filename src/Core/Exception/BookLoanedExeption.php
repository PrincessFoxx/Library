<?php
  namespace Foxx\Library\Core\Exception;

  use Throwable;

  use Foxx\Library\Core\Exception\BookException;
  use Foxx\Library\Core\Model\Book;
  use Foxx\Library\Core\Model\Loan;

  final class BookLoanedExeption extends BookException {
    protected Loan $existingLoan;

    public function __construct(
      protected Loan $newLoan,
      protected string $message = "",
      protected int $code = 702,
      protected ?Throwable $previous = null,
    ) {
      $this->message = "Book is already loaned.";
      parent::__construct($this->message, $code, $previous);
      $this ->existingLoan = $newLoan->getBook()->getLoan();
    }

    public function __toString(): string {
      return "BookLoanedExeption: {$this->message} ({$this->code})";
    }

    public function jsonSerialize(): array {
      return [
        "code" => $this->code,
        "message" => $this->message,
        "loan" => $this->loan,
        "time" => time(),
      ];
    }
  }