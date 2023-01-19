<?php
  namespace Foxx\Library\Middleware;

  use Psr\Http\Message\ResponseFactoryInterface;
  use Psr\Http\Message\ResponseInterface;
  use Psr\Http\Message\ServerRequestInterface;
  use Psr\Http\Server\MiddlewareInterface;
  use Psr\Http\Server\RequestHandlerInterface;

  use \Foxx\Library\Core\Enums\UserTypes;
  use \Foxx\Library\Core\Display\Overflow;
  use \Foxx\Library\Core\Persistence\UserManager;
  use \Foxx\Library\Core\Enums\GetUsersBy;

  /**
   * UserAuthorizationMiddleware
   * 
   * Is a middleware that is used to authorize the user as a user
   * 
   * @package Foxx\Library\Middleware
   * @author Foxx Azalea Pinkerton
   */
  class UserAuthorizationMiddleware implements MiddlewareInterface{

    /**
     * __construct
     * 
     * Is the constructor for the UserAuthorizationMiddleware class
     *
     * @param ResponseFactoryInterface $responseFactory The response factory that is used to create responses 
     * @param \Foxx\Library\Core\Persistence\UserManager $userManager The user manager that is used to get the user
     */
    public function __construct(
      private ResponseFactoryInterface $responseFactory,
      private UserManager $userManager = new UserManager()
    ) {}

    /**
     * process
     * 
     * Is the function that is called when the middleware is called
     *
     * @param ServerRequestInterface $request The request that is being made
     * @param RequestHandlerInterface $handler The handler that is handling the request
     * @return ResponseInterface The response that is being sent
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
      /**
       * @var int $userId The id of the user that is being requested
       */
      $userId = $_SESSION["user"];

      /**
       * @var \Foxx\Library\Core\Model\User $user The user that is being requested
       */
      $user = $this->userManager->GetUsersBy(GetUsersBy::ID, $userId)[0];

      if(!Overflow::validUser(UserTypes::USER, $user)) { // If the user is not a user
        return $this->responseFactory
          ->createResponse(401, "Unauthorized")
          ->withHeader("Location", "/login");
      }

      $request = $request->withAttribute("user", $user);
      return $handler->handle($request);
    }
  }