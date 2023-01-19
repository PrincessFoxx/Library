<?php
namespace Foxx\Library\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Foxx\Library\Core\Persistence\BookManager;
use Foxx\Library\Core\Display\BookCardMaker;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * HomeAction
 *
 * Is the action that is called when the user goes to the home page
 *
 * @package Foxx\Library\Action\Auth\Dashboards\User
 * @author Foxx Azalea Pinkerton
 */
final class HomeAction {
  /**
   * __construct
   *
   * Is the constructor for the HomeAction
   *
   * @param BookManager $bookManager The book manager
   * @param BookCardMaker $bookCardMaker The book card maker
   * @param Twig $twig The twig renderer
   */
  public function __construct(private BookManager $bookManager, private BookCardMaker $bookCardMaker, private Twig $twig) {}

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
    /**
     * @var Foxx\Library\Core\Persistence\BookManager $bookManager The book manager
     */
    $bookManager = $this->bookManager;

    /**
     * @var Twig $twig The twig renderer
     */
    $twig = $this->twig;

    /**
     * @var Foxx\Library\Core\Model\Book[] $books The books that are being displayed
     */
    $books = $bookManager->getBooks();

    /**
     * @var Foxx\Library\Core\Display\Card[] $bookCards The cards that are being displayed
     */
    $bookCards = array();
    foreach ($books as $book) {
      $bookCards[] = $book->makeCard();
    }

    /**
     * @var Foxx\Library\Core\Display\CardList $cardList The list of cards that are being displayed
     */
    $cardList = $this->bookCardMaker->makeCardList($bookCards);

    // Render the page
    return $twig->render($response, "home.twig", [
      "cardList" => $cardList
    ]);
  }
}