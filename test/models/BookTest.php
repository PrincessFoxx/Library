<?php

use PHPUnit\Framework\TestCase;
use Foxx\Library\Core\Model\Book;
use Foxx\Library\Core\Model\Loan;

/**
 * BookTest
 * @group group
 */
class BookTest extends TestCase
{
    protected Book $book;

    public function setUp():void
    {
        parent::setUp();

        $this->book = new Book(
            "The Book",
            "The Author",
            array("Genre"),
            "The Description",
        );
    }

    public function tearDown():void
    {
        parent::tearDown();

    }

    public function testGetsInfomation()
    {
        $this->assertEquals("The Book", $this->book->title());
        $this->assertEquals("The Author", $this->book->author());
        $this->assertEquals(array("Genre"), $this->book->genres());
        $this->assertEquals("The Description", $this->book->description());
    }

    public function testSetsInfomation()
    {
        $this->book->title("New Title"); 
        $this->book->author("New Author");
        $this->book->genres(array("New Genre"));
        $this->book->description("New Description");

        $this->assertEquals("New Title", $this->book->title());
        $this->assertEquals("New Author", $this->book->author());
        $this->assertEquals(array("New Genre"), $this->book->genres());
        $this->assertEquals("New Description", $this->book->description());
    }

    public function testSeeingIfLoansWork()
    {
        $this->assertFalse($this->book->isLoaned());

        $loan = new Loan("UserID", time(), time() + 1000);
        $this->book->addLoan($loan);

        $this->assertTrue($this->book->isLoaned());
    }

    public function testSerializing()
    {
        $json = $this->book->jsonSerialize();
        
        $this->assertEquals("The Book", $json["title"]);
        $this->assertEquals("The Author", $json["author"]);
        $this->assertEquals(array("Genre"), $json["genres"]);
    }

    public function testFailAddingLoan()
    {
        $this->expectException(\Foxx\Library\Core\Exception\BookException::class);

        $loan = new Loan("UserID", time(), time() + 1000);
        $this->book->addLoan($loan);

        $loan = new Loan("NewUserID", time(), time() + 1000);
        $this->book->addLoan($loan); // This should throw an exception
    }

}
