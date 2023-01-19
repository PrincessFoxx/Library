<?php
  namespace Foxx\Library\Action\Auth;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  use Foxx\Library\Core\Extras\Logout;

  /**
   * LogoutAction
   * 
   * Is a debug action that is used to logout the user
   * 
   * @package Foxx\Library\Action\Auth
   * @author Foxx Azalea Pinkerton
   */
  final class LogoutAction {
    /**
     * __invoke
     * 
     * Is the function that is called when the action is called
     *
     * @param Request $request The request that is being made
     * @param Response $response The response that is being sent
     * @return Response The response that is being sent
     */
    public function __invoke(Request $request, Response $response): Response {
      return (new Logout())($response);
    }
  }