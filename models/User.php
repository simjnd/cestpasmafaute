<?php
    
namespace CPMF\Models;
    
abstract class User
{
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $id;
    
    public function __construct(string $email, string $password, string $firstName, string $lastName, int $id)
    {
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->id = $id;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function getPassword(): string
    {
        return $this->password;
    }
    
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    
    public function getLastName(): string
    {
        return $this->lastName;
    }
    
    public function getId(): int
    {
        return $this->id;
    }
}