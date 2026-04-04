<?php
namespace model;

class UserDAO
{
    public function getConnection() {
        $host = getenv('DB_HOST');
        $db   = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWORD');
        $port = getenv('DB_PORT');
        $dsn  = "pgsql:host=$host;port=$port;dbname=$db";
        try {
            $pdo = new \PDO($dsn, $user, $pass, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]);
            return $pdo;
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function addUser($user) {
        $connection = $this->getConnection();
        if (!$connection) return false;
        $stmt = $connection->prepare("INSERT INTO users (username, lastname, firstname, password, lastmodified) VALUES (?, ?, ?, ?, NOW())");
        return $stmt->execute([
            $user->getUsername(),
            $user->getLastname(),
            $user->getFirstname(),
            password_hash($user->getPassword(), PASSWORD_DEFAULT)
        ]);
    }

    public function authenticateUser($username, $passwd) {
        $connection = $this->getConnection();
        if (!$connection) return null;
        $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $found = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($found && password_verify($passwd, $found['password'])) {
            return $found;
        }
        return null;
    }
}