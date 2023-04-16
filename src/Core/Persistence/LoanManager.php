<?php
  namespace Foxx\Library\Core\Persistence;

  use Foxx\Library\Core\Model\Loan;

  final class LoanManager extends Manager {
    const FILE = __DIR__ . DIRECTORY_SEPARATOR . "Files" . DIRECTORY_SEPARATOR . "Loans.json";

    /**
     * @var array $loans The loans
     */
    private $loans = array();

    public function __construct() {
      $this->load();
    }

    public function __destruct() {
      $this->save();
    }

    /**
     * load
     * 
     * Is a function that loads the loans from the json file
     * 
     * @return bool
     */
    protected function load():bool {
      try {
        /**
         * @var array $loans The loans from the json file
         */
        $loans = json_decode($this::FILE, true);
        foreach ($loans as $loan) {
          $this->loans[] = new Loan($loan["userId"], $loan["date"], $loan["due"], $loan["returned"], $loan["returned_date"], $loan["id"]);
        }
        return true;
      } catch (\Exception $e) {
        if(self::DEBUG) {
          echo $e->getMessage();
        }
        return false;
      }
    }

    /**
     * save
     * 
     * Is a function that saves the loans to the json file
     * 
     * @return bool
     */
    protected function save():bool {
      try {
        /**
         * @var array $loans The loans to save
         */
        $loans = array();
        foreach ($this->loans as $loan) {
          $loans[] = array(
            "userId" => $loan->getUserId(),
            "date" => $loan->getDate(),
            "due" => $loan->getDue(),
            "returned" => $loan->getReturned(),
            "returned_date" => $loan->getReturnedDate(),
            "id" => $loan->getId()
          );
        }
        file_put_contents($this::FILE, json_encode($loans));
        return true;
      } catch (\Exception $e) {
        if(self::DEBUG) {
          echo $e->getMessage();
        }
        return false;
      }
    }

    /**
     * add
     * 
     * Is a function that adds a loan to the loans array
     * 
     * @param Loan $loan The loan to add
     * @return bool
     */
    public function add(Loan $loan):bool {
      try {
        $this->loans[] = $loan;
        return true;
      } catch (\Exception $e) {
        if(self::DEBUG) {
          echo $e->getMessage();
        }
        return false;
      }
    }
  }