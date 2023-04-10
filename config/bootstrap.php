<?php
  use DI\ContainerBuilder;
  use Slim\App;

  require_once __DIR__ . '/../vendor/autoload.php';

  /**
   * @var array DB_FILES - The database files
   */
  define("DB_FILES", array(
    "Books" => __DIR__ . "/../src/Core/Persistence/Files/Books.json",
    "Users" => __DIR__ . "/../src/Core/Persistence/Files/Users.json",
    "Loans" => __DIR__ . "/../src/Core/Persistence/Files/Loans.json",
  ));

  // Create the database files if they don't exist
  foreach (DB_FILES as $file) {
    if (!file_exists($file)) {
      file_put_contents($file, "[]");
    }
  }

  /**
   * @var ContainerBuilder $containerBuilder - The application container builder
   * @see https://php-di.org/doc/container-configuration.html
   */
  $containerBuilder = new ContainerBuilder();

  // Add DI container definitions
  $containerBuilder->addDefinitions(__DIR__ . '/container.php');

  /**
   * @var ContainerInterface $container - The application container
   * @see https://php-di.org/doc/container-configuration.html
   */
  $container = $containerBuilder->build();

  /**
   * @var App $app - The application
   * @see https://www.slimframework.com/docs/v4/objects/application.html
   */
  $app = $container->get(App::class);

  if (!$container->get('settings')['debug']) {
    /**
     * @var RouteCollectorProxy $routeCollector - The route collector
     * @see https://www.slimframework.com/docs/v4/objects/routing.html#route-caching
     * 
     * To generate the route cache data, you need to set the file to one that does not exist in a writable directory.
     * After the file is generated on first run, only read permissions for the file are required.
     *
     * You may need to generate this file in a development environment and comitting it to your project before deploying
     * if you don't have write permissions for the directory where the cache file resides on the server it is being deployed to
     */
    $routeCollector = $app->getRouteCollector();
    $routeCollector->setCacheFile(__DIR__ . '/Cache/RoauteCaching.php');
  }


  // Register routes
  (require __DIR__ . '/routes.php')($app);

  // Register middleware
  (require __DIR__ . '/middleware.php')($app);

  // Start PHP session
  session_start();

  return $app;