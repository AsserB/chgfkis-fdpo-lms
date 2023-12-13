<?php

namespace models\users;

use models\Database;

class userModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `users` LIMIT 1"); //Если таблица существует то получаем результат
        } catch (\PDOException $e) {
            $this->createTable(); // Если нету такой таблицы то отраьатывает метод создания таблицы
        }
    }

    //Метод для создания таблицы
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

        $frdoTableQuery = "CREATE TABLE IF NOT EXISTS `frdo` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `user_id` INT(11) NOT NULL,
            `surname` VARCHAR(255) NOT NULL,
            `firstname` VARCHAR(255) NOT NULL,
            `thirdname` VARCHAR(255) NOT NULL,
            `gender` VARCHAR(50) NOT NULL,
            `birthday` DATE,
            `education` VARCHAR(255) NOT NULL,
            `education_number` VARCHAR(100) NOT NULL,
            `spec` VARCHAR(255) NOT NULL,
            `job_place` VARCHAR(255) NOT NULL,
            `job_title` VARCHAR(255) NOT NULL,
            `exp_all` VARCHAR(255) NOT NULL,
            `exp_in_org` VARCHAR(255) NOT NULL,
            `title` VARCHAR(255) NOT NULL,
            `disability` VARCHAR(100) NOT NULL,
            `snils` VARCHAR(50) NOT NULL,
            `snils_path` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
          )";

        $tempPasswordsTableQuery = "CREATE TABLE IF NOT EXISTS `temp_passwords` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            temp_password VARCHAR(255),
            created_at DATETIME
            )";

        try {
            $this->db->exec($userTableQuery);
            $this->db->exec($frdoTableQuery);
            $this->db->exec($tempPasswordsTableQuery);

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function allUsers()
    {
        try {

            $stmt = $this->db->query("SELECT * FROM `users`"); //новый способ написания запроса могут быть ошибки в зависимости от версии базы данных
            $users = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }

            return $users;
        } catch (\PDOException $e) {
            return false;
        }
    }

    //Метод для обновления пользователя взаимодействие с SQL для поиска по id пользователя
    public function readUser($id)
    {
        $query = "SELECT * FROM users WHERE id = ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $res = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            return false;
        }
    }

    //Обновление данных пользователя в SQL с ранее вытянутых данных (вверхний метод) 
    public function updateUser($data)
    {

        $query = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['username'], $data['email'], $data['role'], $data['id']]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    //Метод для удаления пользователя взаимодействие с SQL
    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id= ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function updateprofile($data)
    {

        $query = "UPDATE users SET username = ?, email = ? WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['username'], $data['email'], $data['id']]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    // _______________USERDATA________________

    public function readUserFrdo($user_id)
    {
        $query = "SELECT * FROM frdo WHERE user_id = ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$user_id]);
            $res = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function frdoInput($data)
    {


        $query = "INSERT INTO frdo (user_id, surname, firstname, thirdname, gender, birthday, education, education_number, spec, job_place, job_title, exp_all, exp_in_org, title, disability, snils, snils_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['user_id'], $data['surname'], $data['firstname'], $data['thirdname'], $data['gender'], $data['birthday'], $data['education'], $data['education_number'], $data['spec'], $data['job_place'], $data['job_title'], $data['exp_all'], $data['exp_in_org'], $data['title'], $data['disability'], $data['snils'], $data['snils_path']]);
            return true;
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // _______________CURATOR________________\

}
