<?php
  namespace Foxx\Library\Action;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  /**
   * DebugAction
   * 
   * Is a debug action that is used to display phpinfo
   * 
   * @package Foxx\Library\Action
   * @author Foxx Azalea Pinkerton
   */
  final class DebugAction {
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
      // display phpinfo

      phpinfo(); 
      die();
    }
  }