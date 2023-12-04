<?php

namespace models\pages;

use models\Database;

class pageModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `pages` LIMIT 1"); //Если таблица существует то получаем результат
        } catch (\PDOException $e) {
            $this->createTable(); // Если нету такой таблицы то отраьатывает метод создания таблицы
        }
    }

    //Метод для создания таблицы
    public function createTable()
    {
        $pageTableQuery = "CREATE TABLE IF NOT EXISTS `pages` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `slug` VARCHAR(255) NOT NULL,
            `role` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `update_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;
            ";

        try {

            $this->db->exec($pageTableQuery);
            return true;
        } catch (\PDOException $e) {

            return false;
        }
    }

    //Функция для получения всех ролей из базы данных
    public function getAllPages()
    {
        try {

            $stmt = $this->db->query($query = "SELECT * FROM pages");
            $pages = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $pages[] = $row;
            }
            return $pages;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getPageByID($id)
    {
        $query = "SELECT * FROM pages WHERE id= ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $page = $stmt->fetch(\PDO::FETCH_ASSOC);
            return  $page ? $page : false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function findBySlug($slug)
    {
        $query = "SELECT * FROM pages WHERE slug = ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$slug]);
            $page = $stmt->fetch(\PDO::FETCH_ASSOC);
            return  $page ? $page : false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function createPage($title, $slug, $roles)
    {

        $query = "INSERT INTO pages (title, slug, role) VALUES (?, ?, ?)";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $slug, $roles]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function updatePage($id, $title, $slug, $roles)
    {

        $query = "UPDATE pages SET title = ?, slug = ?, role = ? WHERE id = ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $slug, $roles, $id]);
            return  true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function deletePage($id)
    {
        $query = "DELETE FROM pages WHERE id= ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return  true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
