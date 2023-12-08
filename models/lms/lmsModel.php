<?

namespace models\lms;

use models\Database;

class lmsModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `courses` LIMIT 1"); //Если таблица существует то получаем результат
        } catch (\PDOException $e) {
            $this->createTable(); // Если нету такой таблицы то отраьатывает метод создания таблицы
        }
    }

    //Метод для создания таблицы
    public function createTable()
    {
        $coursesTableQuery = "CREATE TABLE IF NOT EXISTS `courses` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `target` VARCHAR(255) NOT NULL,
            `duration` VARCHAR(255) NOT NULL,
            `timeline` VARCHAR(255) NOT NULL,
            `courses_description` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;
            ";

        try {

            $this->db->exec($coursesTableQuery);
            return true;
        } catch (\PDOException $e) {

            return false;
        }
    }

    //Функция для получения всех ролей из базы данных
    public function getAllCourses()
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

    public function createCourses($data)
    {

        $query = "INSERT INTO courses (title, slug, role) VALUES (?, ?, ?)";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['title'],]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
