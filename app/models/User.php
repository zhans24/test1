<?php

namespace models;

class User
{
    private ?int $id;
    private string $email;
    private string $password;
    private string $name;
    public function __construct(?int $id,$name,$email,$password)
    {
        $this->id=$id;
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    public function toArray() : array
    {
        return [
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password
        ];
    }
}