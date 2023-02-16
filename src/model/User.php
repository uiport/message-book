<?php

namespace App\model;

class User
{
    private int $id;
    private string $passwordHash;
    private string $sessionToken;
    private string $name;

    public function __construct(int $id, string $name, string $passwordHash, string $sessionToken)
    {
        $this->id = $id;
        $this->name = $name;
        $this->passwordHash = $passwordHash;
        $this->sessionToken = $sessionToken;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }
    public function getSessionToken(): string
    {
        return $this->sessionToken;
    }
    public function setSessionToken(string $sessionToken): void
    {
        $this->sessionToken = $sessionToken;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}