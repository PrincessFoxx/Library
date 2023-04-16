<?php
  namespace Foxx\Library\Core\Exception;

  use \Exception;
  use JsonSerializable;
  use \Throwable;

  /**
   * MissingFileConstExeption
   * 
   * Is an exception that is thrown when a constant FILE is not defined on a subclass of Manager
   * 
   * @package Foxx\Library\Core\Exception
   * @final
   * @author Foxx Azalea Pinkerton
   */
  final class MissingFileConstExeption extends Exception implements JsonSerializable{

    /**
     * __construct
     *
     * @param string|null $message
     * @param integer|null $code
     * @param Throwable|null $previous
     */
    public function __construct(
      protected string $message = "",
      protected int $code = 600,
      protected ?Throwable $previous = null,
    ) {
      $this->message = "Constant FILE is not defined on subclass " . get_class($this);
      parent::__construct($this->message, $code, $previous);
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString(): string {
      return "MissingFileConstExeption: {$this->message} ({$this->code})";
    }

    /**
     * jsonSerialize
     *
     * @return array
     */
    public function jsonSerialize(): array {
      return [
        "code" => $this->code,
        "message" => $this->message,
        "time" => time(),
      ];
    }
  }