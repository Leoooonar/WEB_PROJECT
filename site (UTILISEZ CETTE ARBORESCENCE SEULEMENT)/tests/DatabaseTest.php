<?php 

declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class DatabaseTest extends TestCase
{
    // Test s'il y'a au moins un livre dans la base de donnée
    public function testCanGetAllBooks() : void
    {
        include("./src/database.php");
        $db = new Database();

        // Récupère les derniers livres ajoutés
        $books = $db->getBooksByCategory(2);

        $this->assertEquals(1, count($books));
    }

}