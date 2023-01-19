<?php 
  namespace Foxx\Library\Action;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Slim\Views\Twig;

  use Foxx\Library\Core\Persistence\BookManager;
  use Foxx\Library\Core\Enums\GetBooksBy;
  use Foxx\Library\Core\Enums\SetBookBy;

  /**
   * BookAction
   * 
   * Is the action that is called when the user requests details about a book
   * 
   * @package Foxx\Library\Action\Auth\Dashboards\User
   * @author Foxx Azalea Pinkerton
   */
  final class BookAction {

    /**
     * __construct
     * 
     * Is the constructor for the BookAction
     *
     * @param Twig $twig The twig renderer
     * @param BookManager $bookManager The book manager
     */
    public function __construct(
      private Twig $twig,
      private BookManager $bookManager
    ) {}

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
       * @var int $id The id of the book that is being requested
       */
      $id = $request->getAttribute("id");

      /**
       * @var Foxx\Library\Core\Model\Book $book The book that is being requested
       */
      $book = $this->bookManager->getBooksBy(GetBooksBy::Id, $id)[0];

      /**
       * @var string $title The title of the book
       */
      $title = $book->title();

      /**
       * @var string $author The author of the book
       */
      $author = $book->author();

      /**
       * @var string $description The description of the book
       */
      $description = $book->description();

      /**
       * @var string $cover The cover of the book
       */
      $cover = $book->cover();

      /**
       * @var float $rating The rating of the book
       */
      $rating = $book->rating();

      /**
       * @var int $ratings The number of ratings of the book
       */
      $ratings = $book->ratings();

      /**
       * @var bool $loanedOut If the book is loaned out
       */
      $loanedOut = $book->isLoaned();

      /**
       * @var string[] $checkoutClasses The classes for the checkout button
       */
      $checkoutClasses = ["btn"]; // constant classes
      $checkoutClasses[] = $loanedOut ? "btn-outline-danger" : "btn-outline-success"; // conditional classes

      /**
       * @var string $checkoutText The text for the checkout button
       */
      $checkoutText = $loanedOut ? "Checked Out" : "Check Out"; 

      /**
       * @var string $disabled If the button is disabled
       */
      $disabled = $loanedOut ? "disabled" : "";

      /**
       * @var string[] $genreList The list of genres for the book
       */
      $genreList = $book->genreList();

      /**
       * @var string $btnID The id for the checkout button
       */
      $btnID = $loanedOut ? "" : "id=btn-checkout";

      // Render the page
      return $this->twig->render($response, "book.twig", [
        "title" => $title,
        "author" => $author,
        "genres" => $genreList,
        "description" => $description,
        "cover" => $cover,
        "rating" => $rating,
        "ratings" => $ratings,
        "btnClasses" => implode(" ", $checkoutClasses),
        "btnText" => $checkoutText,
        "isDisabled" => $disabled,
        "id" => $btnID
      ]);
    }
  }