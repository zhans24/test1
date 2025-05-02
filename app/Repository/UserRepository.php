<?php

namespace Repository;

use config\Database;
use models\User;
use PDOException;
use PDO;

class UserRepository
{
    private $conn;

    public function __construct(Database $db)
    {
        $this->conn = $db->getConn();
    }

    public function addUser(User $user): bool
    {
        try {
            $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $this->conn->prepare($query);

            $name = $user->getName();
            $password = $user->getPassword();
            $email = $user->getEmail();

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \RuntimeException("Ошибка при добавлении пользователя.", 0, $e);
        }
    }

    public function getAll(): array
    {
        try {
            $query = "SELECT * FROM users";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res ?: [];

        } catch (PDOException $e) {
            throw new \RuntimeException("Ошибка при получении всех пользователей.", 0, $e);
        }
    }

    public function getByEmail(string $email): ?User
    {
        try {
            $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":email", $email);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                return new User($userData['id'],$userData['name'], $userData['email'], $userData['password']);
            } else {
                return null;
            }

        } catch (PDOException $e) {
            throw new \RuntimeException("Ошибка при получении пользователя по email.", 0, $e);
        }
    }

    public function deleteUser(string $email): bool
    {
        try {
            $query = "DELETE FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":email", $email);
            $stmt->execute();

            return $stmt->rowCount() > 0;

        } catch (PDOException $e) {
            throw new \RuntimeException("Ошибка при удалении пользователя.", 0, $e);
        }
    }

    public function updateUser(string $email, User $user): bool
    {
        try {
            $query = "UPDATE users SET name = :name, email = :new_email, password = :password WHERE email = :old_email";
            $stmt = $this->conn->prepare($query);

            $name = $user->getName();
            $old_email = $user->getEmail();
            $password = $user->getPassword();


            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":new_email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":old_email", $old_email);

            $stmt->execute();

            return $stmt->rowCount() > 0;

        } catch (PDOException $e) {
            throw new \RuntimeException("Ошибка при обновлении пользователя.", 0, $e);
        }
    }
}