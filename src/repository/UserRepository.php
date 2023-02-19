<?php

namespace App\repository;

use App\model\User;
use Ramsey\Uuid\Uuid;

class UserRepository
{
    private string $dns;
    private string $username;
    private string $password;

    public function __construct(array $databaseCredentials)
    {
        list($this->dns,$this->username,$this->password) = $databaseCredentials;
    }
    public function getUser(int $id) : User{
        $this->handlePdoWrapper(
            "SELECT * FROM users WHERE user_id = ?",
            [$id],
            function (array $row) use (&$user){
                $user = $this->configureUser($row);
            }
        );
        return $user;
    }
    public function createUser(User $user) : void{
        $this->handlePdoWrapper(
            "INSERT INTO users (name,password_hash,session_token) VALUES (?,?,?)",
            [$user->getName(),$user->getPasswordHash(),$user->getSessionToken()],
        );
    }
    public function removeUser(int $id) : void{
        $this->handlePdoWrapper(
            "DELETE FROM users WHERE user_id = ?",
            [$id]
        );
    }
    public function updateUser(User $user) : void{
        $this->handlePdoWrapper(
            "UPDATE users SET name = ?, password_hash = ?, session_token = ? WHERE user_id = ?",
            [$user->getName(), $user->getPasswordHash(), $user->getSessionToken(), $user->getId()]
        );
    }
    public function getUserByName(string $name) : ?User{
        $this->handlePdoWrapper(
            "SELECT * FROM users WHERE name = ?",
            [$name],
            function ($row) use (&$user){
                $user = $this->configureUser($row);
            });
        return $user;
    }
    public function getUserByToken(string $token) : ?User{
        $this->handlePdoWrapper(
            "SELECT * FROM users WHERE session_token = ?",
            [$token],
            function ($row) use (&$user){
                $user = $this->configureUser($row);
            });
        return $user;
    }
    protected function configureUser(array $info) : User{
        return new User(
            $info["user_id"],
            $info["name"],
            $info["password_hash"],
            $info["session_token"]
        );
    }
    protected function createPDO() : \PDO{
        return new \PDO($this->dns,$this->username,$this->password);
    }
    protected function handlePdoWrapper(string $query, ?array $params = null, ?callable $callable = null) : void{
        try {
            $pdo = $this->createPDO();
            $preparedStatement = $pdo->prepare($query);
            $preparedStatement->execute($params);
            if($callable !== null)
                foreach ($preparedStatement as $row) {
                    $callable($row);
                }
        }catch (\PDOException $exception){
            error_log($exception);
            throw new \RuntimeException("repository exception", 0, $exception);
        }finally {
            $preparedStatement = null;
            $pdo = null;
        }
    }
}
