<?php
  namespace Foxx\Library\Middleware;

  use Psr\Http\Message\ResponseFactoryInterface;
  use Psr\Http\Message\ResponseInterface;
  use Psr\Http\Message\ServerRequestInterface;
  use Psr\Http\Server\MiddlewareInterface;
  use Psr\Http\Server\RequestHandlerInterface;

  use Slim\Exception\HttpSpecializedException;
  use Slim\Views\Twig;

  /**
   * RoutingErrorMiddleware
   * 
   * Is a middleware that is used to handle routing errors
   * 
   * @package Foxx\Library\Middleware
   * @author Foxx Azalea Pinkerton
   */
  class RoutingErrorMiddleware implements MiddlewareInterface {
    /**
     * __construct
     * 
     * Is the constructor for the RoutingErrorMiddleware class
     *
     * @param ResponseFactoryInterface $responseFactory The response factory that is used to create responses
     * @param Twig $twig The twig that is used to render the error page
     */
    public function __construct(private ResponseFactoryInterface $responseFactory, private Twig $twig) {}

    /**
     * process
     * 
     * Is the function that is used to process the request
     *
     * @param ServerRequestInterface $request The request that is being processed
     * @param RequestHandlerInterface $handler The handler that is used to handle the request
     * @return ResponseInterface The response that is being returned
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
      try { // Try to handle the request
        /**
         * @var ResponseInterface $response The response that is being returned
         */
        $response = $handler->handle($request);

        /**
         * @var int $statusCode The status code of the response
         */
        $statusCode = $response->getStatusCode();
        switch ($statusCode) { // Switch on the status code
          case 503: // If the status code is 503
            throw new \Foxx\Library\Core\Exception\HttpServiceUnavailableExeption($request, "503 Service Unavailable"); // Throw a service unavailable exception
        }
      } catch (\Foxx\Library\Core\Exception\HttpServiceUnavailableExeption $e) { // If a service unavailable exception is thrown
        return $this->twig->render($response, '503.twig'); // Render the 503 page
      } catch (HttpSpecializedException $e) { // If a specialized exception is thrown
        /**
         * @var int $code The code of the exception
         * @var string $title The title of the exception
         * @var string $message The message of the exception
         * @var string $description The description of the exception
         */
        $code = $e->getCode();
        $title = $e->getTitle();
        $message = $e->getMessage();
        $description = $e->getDescription();

        $response = $this->responseFactory->createResponse($code); // Create a response with the code of the exception
        $response = $this->twig->render($response, 'error.twig', [
          'title' => $title,
          'message' => $message,
          'description' => $description
        ]);

      }

      return $response; // Return the response
    }  
  }