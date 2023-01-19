<?php

  use Psr\Container\ContainerInterface;
  use Slim\App;
  use Slim\Factory\AppFactory;

  /**
   * @var array $container - The application container definitions
   */
  return [
    'settings' => function () {
      return require __DIR__ . '/settings.php';
    },

    App::class => function (ContainerInterface $container) {
      AppFactory::setContainer($container);

      return AppFactory::create();
    },

    \Slim\Views\Twig::class => function (ContainerInterface $container) {
      $filesystemLoader = new \Twig\Loader\FilesystemLoader();
      $filesystemLoader->addPath(dirname(__DIR__) . '/templates');

      return new \Slim\Views\Twig($filesystemLoader, [
        'cache' => $container->get('settings')['debug'] ? false : dirname(__DIR__) . '/cache',
      ]);
    },

    Psr\Http\Message\ResponseFactoryInterface::class => function (ContainerInterface $container) {
      return $container->get(App::class)->getResponseFactory();
    },
  ];