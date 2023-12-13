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
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (username, email, password, role, created_at) VALUES (?, ?, ?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['username'], $data['email'], password_hash($data['password'], PASSWORD_DEFAULT), $data['role'], $created_at]);
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

    public function postTempPassword($user_id, $tempPassword)
    {
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO temp_passwords (user_id, temp_password, created_at) VALUES (?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$user_id, $tempPassword, $created_at]);

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function deletePassword($user_id)
    {
        $query = "UPDATE users SET password = NULL WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$user_id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getChekTempPassword($data)
    {

        try {
            $query = "SELECT * FROM temp_passwords WHERE temp_password = ?";

            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['temp_password']]);
            $temp_passwords_row = $stmt->fetch(\PDO::FETCH_ASSOC);

            return  $temp_passwords_row ? $temp_passwords_row : false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getTempPasswordUserID($data)
    {

        try {
            $query = "SELECT user_id FROM temp_passwords WHERE temp_password = ?";

            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['temp_password']]);
            $res = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function changePassword($data)
    {
        try {
            $query = "UPDATE users SET password = ? WHERE id = ?";

            $stmt = $this->db->prepare($query);
            $stmt->execute([password_hash($data['password'], PASSWORD_DEFAULT), $data['id']]);
            $res = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function deleteTempPassword($data)
    {
        try {
            $query = "DELETE FROM temp_passwords WHERE user_id = ?";

            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['id']]);
            $res = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
