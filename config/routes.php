<?php
  use Slim\App;
  use Slim\Routing\RouteCollectorProxy;

  use Psr\Http\Message\ResponseInterface;
  use Psr\Http\Message\ServerRequestInterface;

  use Foxx\Library\Middleware\AdminAuthorizationMiddleware;
  use Foxx\Library\Middleware\UserAuthorizationMiddleware;
  use Foxx\Library\Middleware\ReroutingMiddleware;

  return function (App $app) {
    // Debug routes
    if ($app->getContainer()->get("settings")["debug"]) {
      $app->get('/logout', \Foxx\Library\Action\Auth\LogoutAction::class);
      $app->get('/debug', \Foxx\Library\Action\DebugAction::class);
      $app->get('/unavailable', function (ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        return $response->withStatus(503);
      });

    }
    
    /**
     * @var callable NOT_FINISHED used to return a 503 response (Used for routes im adding in 40s project)
     */
    define("NOT_FINISHED", function (ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
      return $response->withStatus(503);
    });
    
    /**
     * @var AdminAuthorizationMiddleware $adminAuth used to check if the user is an admin
     */
    $adminAuth = new AdminAuthorizationMiddleware($app->getResponseFactory());

    /**
     * @var UserAuthorizationMiddleware $userAuth used to check if the user is a user
     */
    $userAuth = new UserAuthorizationMiddleware($app->getResponseFactory());

    /**
     * @var ReroutingMiddleware $rerouting used to reroute the user to the correct dashboard
     */
    $rerouting = new ReroutingMiddleware($app->getResponseFactory());


    // Routes
    $app->get('/', \Foxx\Library\Action\HomeAction::class);

    $app->get('/book/{id}', \Foxx\Library\Action\BookAction::class);

    $app->map(['GET', 'POST'], '/register', NOT_FINISHED);
    $app->map(['GET', 'POST'], '/login', \Foxx\Library\Action\Auth\LoginAction::class)->add($rerouting);

    $app->group('/admin', function (RouteCollectorProxy $group) {
      $group->map(['GET', 'POST'], '', function (ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        return $response->withHeader("Location", "/admin/dashboard")->withStatus(302);
      });

      $group->map(['GET', 'POST'], '/dashboard', NOT_FINISHED);

      $group->map(['GET', 'POST'], '/dashboard/books', NOT_FINISHED);
      $group->map(['GET', 'POST'], '/dashboard/books/add', NOT_FINISHED);
      $group->map(['GET', 'POST'], '/dashboard/books/edit/{id}', NOT_FINISHED);
      $group->map(['GET', 'POST'], '/dashboard/books/delete/{id}', NOT_FINISHED);

      $group->map(['GET', 'POST'], '/dashboard/users', NOT_FINISHED);
      $group->map(['GET', 'POST'], '/dashboard/users/add', NOT_FINISHED);
      $group->map(['GET', 'POST'], '/dashboard/users/edit/{id}', NOT_FINISHED);
      $group->map(['GET', 'POST'], '/dashboard/users/delete/{id}', NOT_FINISHED);

    })->add($adminAuth);

    $app->group('/user', function (RouteCollectorProxy $group) {
      $group->map(['GET', 'POST'], '', function (ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        return $response->withHeader("Location", "/user/dashboard")->withStatus(302);
      });
      $group->map(['GET', 'POST'], '/dashboard', NOT_FINISHED);

      $group->map(['GET', 'POST'], '/dashboard/books', NOT_FINISHED);
      $group->map(['GET', 'POST'], '/dashboard/card', NOT_FINISHED);
      $group->map(['GET', 'POST'], '/dashboard/edit', NOT_FINISHED);
    })->add($userAuth);
  };