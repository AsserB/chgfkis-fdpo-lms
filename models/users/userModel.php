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

        try {
            $this->db->exec($userTableQuery);

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
        $query = "SELECT * FROM users WHERE id= ?";

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
}
