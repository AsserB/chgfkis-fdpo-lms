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
            `courses_description` VARCHAR(255) NOT NULL
         )";

        $confirmcoursesTableQuery = "CREATE TABLE IF NOT EXISTS `confirm_courses` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT(11) NOT NULL,
            `courses_id` INT(11) NOT NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
            FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`),
            UNIQUE (`user_id`, `courses_id`)
         )";

        try {

            $this->db->exec($coursesTableQuery);
            $this->db->exec($confirmcoursesTableQuery);
            return true;
        } catch (\PDOException $e) {

            return false;
        }
    }

    //Функция для получения всех ролей из базы данных
    public function getAllCourses()
    {
        try {

            $stmt = $this->db->query($query = "SELECT * FROM courses");
            $pages = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $pages[] = $row;
            }
            return $pages;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getAllCoursesByIdUser($user_id)
    {
        $query = "SELECT DISTINCT courses.*
         FROM courses
         JOIN confirm_courses ON courses.id = confirm_courses.courses_id
         WHERE confirm_courses.user_id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$user_id]);
            $courses = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $courses;
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function getFrdoDataByUserId($user_id)
    {
        $query = "SELECT COUNT(*) AS count FROM frdo WHERE user_id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$user_id]);
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function createCourses($data)
    {

        $query = "INSERT INTO courses (title, target, duration, timeline, courses_description) VALUES (?, ?, ?, ?, ?)";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['title'], $data['target'], $data['duration'], $data['timeline'], $data['courses_description']]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function updateCourses($data)
    {

        $query = "UPDATE courses SET title = ?, target = ?, duration = ?, timeline = ?, courses_description = ? WHERE id = ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['title'], $data['target'], $data['duration'], $data['timeline'], $data['courses_description'], $data['id']]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function deleteCourses($id)
    {
        $query = "DELETE FROM courses WHERE id= ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return  true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getCourseById($id)
    {
        $query = "SELECT * FROM courses WHERE id= ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $course = $stmt->fetch(\PDO::FETCH_ASSOC);
            return  $course ? $course : false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function confirmCourses($data)
    {

        $query = "INSERT INTO confirm_courses (user_id, courses_id) VALUES (?, ?)";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['user_id'], $data['courses_id']]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getAllUsersStudiesInCourses($id)
    {
        $query = "SELECT confirm_courses.id AS confirm_id, CONCAT(frdo.surname, ' ', frdo.firstname, ' ', frdo.thirdname) AS fullname, frdo.*
        FROM confirm_courses
        JOIN frdo ON confirm_courses.user_id = frdo.user_id
        WHERE confirm_courses.courses_id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $courses = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $courses;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function deleteUsersFromCourse($id)
    {
        $query = "DELETE FROM confirm_courses WHERE id= ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return  true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
