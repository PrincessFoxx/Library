<?php 
  namespace Foxx\Library\Action\Auth\Dashboards\Admin;

  use Psr\Http\Message\ResponseInterface;
  use Psr\Http\Message\ServerRequestInterface;
  use Slim\Views\Twig;
    
  /**
   * AdminAction
   * 
   * Is the action that is called when the user is an admin
   * 
   * @package Foxx\Library\Action\Auth\Dashboards\Admin
   * @author Foxx Azalea Pinkerton
   */
  class AdminAction {
    /**
     * __construct
     * 
     * Is the constructor for the AdminAction
     * 
     * @param Twig $twig The twig renderer
     */
    public function __construct(private Twig $twig) {}

    /**
     * __invoke
     * 
     * Is the function that is called when the action is called
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
      /**
       * @var Foxx\Library\Core\Model\User $user The user that is logged in
       */
      $user = $request->getAttribute("user");

      return $this->twig->render($response, "Auth/Dashboards/admin.twig");
    }
  }