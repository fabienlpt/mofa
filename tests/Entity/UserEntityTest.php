<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function testEmail()
    {
        $user = new User();
        $email = "admin.mofa@gmail.com";
        
        $user->setEmail($email);
        $this->assertEquals("admin.mofa@gmail.com", $user->getEmail());
    }

    public function testRole()
    {
        $user = new User();
        
        $this->assertEquals(["ROLE_USER"], $user->getRoles());
    }

    public function testPassword()
    {
        $user = new User();
        $password = 'pass_1234';
        
        $user->setPassword($password);
        $this->assertEquals('pass_1234', $user->getPassword());
    }
}
