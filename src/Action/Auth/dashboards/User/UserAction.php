<?php 
  namespace Foxx\Library\Action\Auth\Dashboards\User;

  use Psr\Http\Message\ResponseInterface;
  use Psr\Http\Message\ServerRequestInterface;
  use Slim\Views\Twig;
  
  /**
   * UserAction
   * 
   * Is the action that is called when the user is a user
   * 
   * @package Foxx\Library\Action\Auth\Dashboards\User
   * @author Foxx Azalea Pinkerton
   */
  class UserAction {
    public function __construct(private Twig $twig) {}

    /**
     * __invoke
     * 
     * Is the function that is called when the action is called
     *
     * @param ServerRequestInterface $request The request that is being made
     * @param ResponseInterface $response The response that is being sent
     * @return ResponseInterface The response that is being sent
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
      /**
       * @var Foxx\Library\Core\Model\User $user The user that is logged in
       */
      $user = $request->getAttribute("user");

      return $this->twig->render($response, "Auth/Dashboards/user.twig");
    }
  }