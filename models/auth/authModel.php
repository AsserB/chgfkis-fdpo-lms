<?php

namespace models\auth;

use models\Database;

class authModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `users` LIMIT 1");
        } catch (\PDOException $e) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $userTableQuery = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `role` INT(11) NOT NULL DEFAULT 1,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`role`) REFERENCES `roles` (`id`)
          )";

        try {
            $this->db->exec($userTableQuery);
            return true;
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function register($data)
    {

        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['username'], $data['email'], password_hash($data['password'], PASSWORD_DEFAULT)]);
            return true;
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function login($email, $password)
    {
        try {
            $query = "SELECT * FROM users WHERE email = ? LIMIT 1";

            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }

            return false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function findByEmail($email)
    {
        try {
            $query = "SELECT * FROM users WHERE email = ? LIMIT 1";

            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $user ? $user : false;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
