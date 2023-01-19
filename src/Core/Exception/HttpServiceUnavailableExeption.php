<?php
  declare(strict_types=1);

  namespace Foxx\Library\Core\Exception;

  use Slim\Exception\HttpSpecializedException;

  /**
   * HttpServiceUnavailableExeption
   * 
   * Is an exception that is thrown when the server is unable to handle the request
   * 
   * @package Foxx\Library\Core\Exception
   * @author Foxx Azalea Pinkerton
   */
  final class HttpServiceUnavailableExeption extends HttpSpecializedException {
    /**
     * @var int
     */
    protected $code = 503;

    /**
     * @var string
     */
    protected $message = "Service Unavailable.";

    protected string $title = "503 Service Unavailable";
    protected string $description = "The server is currently unable to handle the request due to waiting till 40S project time.
    (Yes Mr.Wachs, that means I held off from finishing this project so i can build off of it for my 40S project)";
  }
  
