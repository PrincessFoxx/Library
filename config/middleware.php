<?php
  use Slim\App;
  use \Foxx\Library\Middleware\RoutingErrorMiddleware;

  return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    // Handle exceptions
    $app->addErrorMiddleware(true, true, true);
    $app->add(RoutingErrorMiddleware::class);
  };