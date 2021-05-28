<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");


class Attendance
{
    public function __construct()
    {
    }

    public function registerNewClass($topic, $groupID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO class_data (topic, time_class, groups_id) VALUES (?, now(), ?);";
            $pdo->prepare($sql)->execute([
                $topic,
                $groupID
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function updateClassData($topic, $classID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE class_data SET topic = ? WHERE id = ?;";
            return $pdo->prepare($sql)->execute([
                $topic,
                $classID
            ]);
        } else {
            return false;
        }
    }

    public function isPresent($num, $attID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE attendance SET present = ? WHERE id = ?;";
            return $pdo->prepare($sql)->execute([
                $num,
                $attID
            ]);
        } else {
            return false;
        }
    }

    public function getClassID($topic, $groupID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT id FROM class_data WHERE groups_id = $groupID AND topic = '$topic' ORDER BY id DESC LIMIT 1;";

            $exist = $pdo->query($sql);
            return intval($exist->fetchColumn());

        } else {
            return 0;
        }
    }

    public function getClassIDIfExist($groupID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
//            $sql = "SELECT IF((SELECT id FROM class_data WHERE groups_id = $groupID AND date_format(time_class, '%Y-%m-%d') = curdate() LIMIT 1) IS NULL, 0, (SELECT id FROM class_data WHERE groups_id = $groupID AND date_format(time_class, '%Y-%m-%d') = curdate() LIMIT 1));";
            $sql = "SELECT IFNULL((SELECT id FROM class_data WHERE groups_id = $groupID AND date_format(time_class, '%Y-%m-%d') = curdate() LIMIT 1), 0);";

            $exist = $pdo->query($sql);
            return intval($exist->fetchColumn());

        } else {
            return 0;
        }
    }

    public function verifyExistanceOfQualificationForGroup($groupID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT count(1) FROM qualifications WHERE groups_id = $groupID;";

            $count = $pdo->query($sql)->fetchColumn();

            return intval($count) !== 0;//true: ya existe calificaciones paar este grupo
        } else {
            return false;
        }
    }

    public function getClassTopic($classID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT topic FROM class_data WHERE id = $classID;";

            $exist = $pdo->query($sql);
            return $exist->fetchColumn();
        } else {
            return '';
        }
    }

    public function addStudentsToAttendance($groupID, $classID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT student_data_id FROM student_group WHERE groups_id = $groupID;";
        $my_query = "INSERT INTO attendance (student_data_id, class_data_id, present) VALUES ";

        if ($conn->query($sql)->rowCount() > 0) {

            foreach ($conn->query($sql) as $row) {
                $my_query .= "(" . $row['student_data_id'] . ",$classID, 1 ), ";
            }

            $my_query = substr($my_query, 0, strlen($my_query) - 2) . ";";

            $conn->query($my_query);
        }
    }

    public function addStudentsForQualification($groupID)
    {
        $DEFAULT_QUALIFICATION = 0;

        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT student_data_id FROM student_group WHERE groups_id = $groupID;";
        $my_query = "INSERT INTO qualifications (qualification_final, groups_id, student_data_id) VALUES ";

        if ($conn->query($sql)->rowCount() > 0) {

            foreach ($conn->query($sql) as $row) {
                $my_query .= "($DEFAULT_QUALIFICATION,$groupID, " . $row['student_data_id'] . "), ";
            }

            $my_query = substr($my_query, 0, strlen($my_query) - 2) . ";";

            $conn->query($my_query);
        }
    }

    public function getStudentsOfClass($classID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT 
                    att.id as id,
                    concat(pl.lastname, ' ', pl.name) as student,
                    att.present as present
                FROM attendance AS att 
                    JOIN student_data AS stdt ON stdt.id = att.student_data_id
                        JOIN students AS st ON st.id = stdt.students_id
                            JOIN people AS pl ON pl.id = st.people_id
                
                WHERE att.class_data_id = $classID ORDER BY pl.lastname;";
        $response['students'] = array();
        foreach ($conn->query($sql) as $row) {
            $teacher = array();
            $teacher['id'] = $row['id']; //classDataID
            $teacher['student'] = $row['student'];
            $teacher['present'] = $row['present'];
            array_push($response['students'], $teacher);
        }
        return json_encode($response);
    }

    public function getStudentsForQualification($groupID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT 
                    qlf.id as id,
                    concat(pl.lastname, ' ', pl.name) as student,
                    qlf.qualification_final as qualification
                FROM qualifications AS qlf 
                    JOIN student_data AS stdt ON stdt.id = qlf.student_data_id
                        JOIN students AS st ON st.id = stdt.students_id
                            JOIN people AS pl ON pl.id = st.people_id
                
                WHERE qlf.groups_id = $groupID ORDER BY pl.lastname;";
        $response['students'] = array();
        foreach ($conn->query($sql) as $row) {
            $teacher = array();
            $teacher['id'] = $row['id']; //qualificationsID
            $teacher['student'] = $row['student'];
            $teacher['qualification'] = $row['qualification'];
            array_push($response['students'], $teacher);
        }
        return json_encode($response);
    }

    public function updateQualification($qualification, $qlfID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE qualifications SET qualification_final = ? WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $qualification,
                $qlfID
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function getSchedulesOfClass($groupID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT
                    dy.name as 'day',
                    date_format(sch.time_start, '%H:%i') as time_start,
                    date_format(sch.time_end, '%H:%i') as time_end,
                    cl.name as classroom
                
                FROM schedules sch
                
                JOIN days as dy on dy.id = sch.days_id
                JOIN groups as gr on gr.id = sch.groups_id
                JOIN classrooms as cl on cl.id = sch.classrooms_id
                
                WHERE groups_id = $groupID;";
        $response['schedules'] = array();
        foreach ($conn->query($sql) as $row) {
            $teacher = array();
            $teacher['day'] = $row['day']; //classDataID
            $teacher['time_start'] = $row['time_start'];
            $teacher['time_end'] = $row['time_end'];
            $teacher['classroom'] = $row['classroom'];
            array_push($response['schedules'], $teacher);
        }
        return json_encode($response);
    }
}