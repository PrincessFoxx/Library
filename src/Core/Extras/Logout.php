<?php
  namespace Foxx\Library\Core\Extras;

  use Psr\Http\Message\ResponseInterface as Response;

  /**
   * Logout
   * 
   * Is a class that is used to logout the user
   * 
   * @package Foxx\Library\Core\Extras
   * @author Foxx Azalea Pinkerton
   */
  final class Logout {
    /**
     * __invoke
     * 
     * Is the function that is called when the class is called
     *
     * @param Response $response The response that is being sent
     * @return Response The response that is being sent
     */
    public function __invoke(Response $response): Response {
      unset($_SESSION["user"]); // unset the user session
      return $response->withHeader("Location", "/login")->withStatus(302); // redirect to the login page
    }
  }