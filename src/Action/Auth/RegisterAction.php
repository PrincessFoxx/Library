<?php
  namespace Foxx\Library\Action\Auth;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Slim\Views\Twig;

  use Foxx\Library\Core\Model\User;
  use Foxx\Library\Core\Persistence\UserManager;

  /**
   * RegisterAction
   * 
   * Is the action that is called when the user is registering
   * 
   * @package Foxx\Library\Action\Auth
   * @author Foxx Azalea Pinkerton
   */
  final class RegisterAction {
    /**
     * __construct
     * 
     * Is the constructor for the RegisterAction
     * 
     * @param Twig $twig The twig renderer
     * @param UserManager $userManager The user manager
     */
    public function __construct(
      private Twig $twig,
      private UserManager $userManager
    ){}

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
      if ($request->getMethod() == "GET") {
        return $this->twig->render($response, "Auth/register.twig");
      } else {

        /**
         * @var array $body The body of the request
         */
        $body = $request->getParsedBody();

        /**
         * @var User $user The user that is being created
         */
        $user = new User(
          $body["fname"],
          $body["lname"],
          $body["email"],
          password_hash($body["password"], PASSWORD_BCRYPT),
        );
        
        $this->userManager->AddUser($user); // Add the user to the database

        /**
         * @var string $id The id of the user that is being created
         */
        $_SESSION["user"] = $user->id();

        // Redirect the user to the home page
        return $response
          ->withHeader("Location", "/")
          ->withStatus(302);
      }
    }
  }

