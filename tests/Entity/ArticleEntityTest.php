<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use PHPUnit\Framework\TestCase;

class ArticleEntityTest extends TestCase
{
    public function testTitle()
    {
        $article = new Article();
        $title = "Test Title";
        
        $article->setTitle($title);
        $this->assertEquals("Test Title", $article->getTitle());
    }

    public function testImage()
    {
        $article = new Article();
        $image = "url1";
        
        $article->setImage($image);
        $this->assertEquals("url1", $article->getImage());
    }

    public function testDescription()
    {
        $article = new Article();
        $description = "description test";
        
        $article->setDescription($description);
        $this->assertEquals("description test", $article->getDescription());
    }

    public function testPrice()
    {
        $article = new Article();
        $price = 15;
        
        $article->setPrice($price);
        $this->assertEquals(15, $article->getPrice());
    }
}
