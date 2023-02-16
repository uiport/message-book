<?php

namespace App\repository;

use App\model\User;

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
                $user = new User(
                    $row["user_id"],
                    $row["name"],
                    $row["password_hash"],
                    $row["session_token"]
                );
            }
        );
        return $user;
    }
    public function createUser(User $user) : void{
        $this->handlePdoWrapper(
            "INSERT INTO users (name,password_hash,session_token) VALUES (?,?,?)",
            [$user->getName(),$user->getPasswordHash(),$user->getSessionToken()]
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
    protected function createPDO() : \PDO{
        return new \PDO($this->dns,$this->username,$this->password);
    }
    protected function handlePdoWrapper(string $query, array $params, ?callable $callable = null) : void{
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
