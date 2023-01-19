<?php
  namespace Foxx\Library\Middleware;

  use Psr\Http\Message\ResponseFactoryInterface;
  use Psr\Http\Message\ResponseInterface;
  use Psr\Http\Message\ServerRequestInterface;
  use Psr\Http\Server\MiddlewareInterface;
  use Psr\Http\Server\RequestHandlerInterface;

  use \Foxx\Library\Core\Enums\UserTypes;
  use \Foxx\Library\Core\Enums\GetUsersBy;
  use \Foxx\Library\Core\Persistence\UserManager;
  use \Foxx\Library\Core\Display\Overflow;

  /**
   * ReroutingMiddleware
   * 
   * Is a middleware that is used to reroute the user to the correct dashboard
   * 
   * @package Foxx\Library\Middleware
   * @author Foxx Azalea Pinkerton
   */
  class ReroutingMiddleware implements MiddlewareInterface{
    /**
     * __construct
     * 
     * Is the constructor for the ReroutingMiddleware class
     *
     * @param ResponseFactoryInterface $responseFactory The response factory that is used to create responses 
     * @param \Foxx\Library\Core\Persistence\UserManager $userManager The user manager that is used to get the user
     */
    public function __construct(
      private ResponseFactoryInterface $responseFactory,
      private UserManager $userManager = new UserManager()
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
      if(isset($_SESSION["user"])) { // If the user is logged in
        /**
         * @var \Foxx\Library\Core\Model\User $user The user that is being requested
         */
        $user = $this->userManager->GetUsersBy(GetUsersBy::ID, $_SESSION["user"])[0];

        if(Overflow::validUser(UserTypes::ADMIN, $user)) { // If the user is an admin
          return $this->responseFactory
            ->createResponse(302, "Redirecting")
            ->withHeader("Location", "/admin/dashboard");
        } elseif(Overflow::validUser(UserTypes::USER, $user)) { // If the user is a user
          return $this->responseFactory
            ->createResponse(302, "Redirecting")
            ->withHeader("Location", "/user/dashboard");
        }
      }
      
      return $handler->handle($request); // If the user is not logged in, continue
    }
  }