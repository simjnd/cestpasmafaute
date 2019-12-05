<?php
namespace CPMF\Models\Entities;
    
abstract class User extends Model
{
    private $idLogin;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    
    
    public function __construct(array $data) 
    {
        parent::__construct($data);
    }

    protected function callFunction(string $methodName, string $value = ""): void
    {
        if(method_exists($this, $methodName)) {
            $this->$methodName($value);
        }   
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

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setIdLogin(int $idLogin): void
    {
        $this->idLogin = $idLogin;
    }
}