<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");


class Classroom
{
    function createNewGroup($procID, $areaID, $dimID, $dateStart, $dateEnd, $teacherID, $groupName)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            if ($teacherID > 0) {
                $sql = "INSERT INTO groups (areas_id, date_start, date_end, dimensions_id, process_id, teachers_id, name) VALUES (?, ?, ?, ?, ?, ?, ?);";
                return $pdo->prepare($sql)->execute([
                    $areaID,
                    $dateStart,
                    $dateEnd,
                    $dimID,
                    $procID,
                    $teacherID,
                    $groupName
                ]);
            } else {
                $sql = "INSERT INTO groups (areas_id, date_start, date_end, dimensions_id, process_id, name) VALUES (?, ?, ?, ?, ?,?);";
                return $pdo->prepare($sql)->execute([
                    $areaID,
                    $dateStart,
                    $dateEnd,
                    $dimID,
                    $procID,
                    $groupName
                ]);
            }
        } else {
            return false;
        }

    }

    function createNewSchedule($groupID, $classroomID, $dayID, $timeStart, $timeEnd)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO schedules (time_start, time_end, days_id, groups_id, classrooms_id) VALUES (?, ?, ?, ?, ?);";
            return $pdo->prepare($sql)->execute([
                $timeStart,
                $timeEnd,
                $dayID,
                $groupID,
                $classroomID
            ]);

        } else {
            return false;
        }
    }

    function deleteSchedule($scheduleID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "DELETE FROM schedules WHERE id = ?;";
            return $pdo->prepare($sql)->execute([
                $scheduleID
            ]);
        } else {
            return false;
        }
    }

    function addStudentToGroup($stdtID, $groupID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO student_group (groups_id, student_data_id) VALUES(?, ?);";
            return $pdo->prepare($sql)->execute([
                $groupID,
                $stdtID
            ]);
        } else {
            return false;
        }
    }

    function removeStudentFromGroup($stgrID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "DELETE FROM student_group WHERE id = ?;";
            return $pdo->prepare($sql)->execute([
                $stgrID
            ]);
        } else {
            return false;
        }
    }

    function editGroup($groupID, $procID, $areaID, $dimID, $dateStart, $dateEnd, $teacherID, $groupName)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE groups SET areas_id = $areaID, date_start = '$dateStart', date_end = '$dateEnd', dimensions_id = $dimID, process_id = $procID WHERE id = $groupID;";

            $pdo->prepare($sql)->execute();

            if ($teacherID > 0) {
                $sql = "UPDATE groups SET teachers_id = $teacherID WHERE id = $groupID;";
                $pdo->prepare($sql)->execute();
            }
            return true;
        } else {
            return false;
        }
    }

    function verifyIfExistGroup($procID, $areaID, $dimID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT EXISTS(SELECT 1 FROM groups WHERE areas_id = " . $areaID . " AND dimensions_id = " . $dimID . " AND process_id = " . $procID . ");";

            $exist = $pdo->query($sql);
            return intval($exist->fetchColumn()) === 1;

        } else {
            return false;
        }
    }

    function verifyIfExistScheduleByDay($groupID, $dayID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT count(1) FROM schedules WHERE days_id = $dayID AND groups_id = $groupID;";

            $exist = $pdo->query($sql);
            return intval($exist->fetchColumn());

        } else {
            return false;
        }
    }

    function countHoursOfScheduleByWeek($groupID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT sum(ROUND(ROUND(TIMEDIFF(time_end, time_start))/10000)) FROM schedules WHERE groups_id = $groupID;";

            $exist = $pdo->query($sql);
            return intval($exist->fetchColumn());

        } else {
            return false;
        }
    }

    function getHoursByDimension($groupID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT 
                    CASE
                        WHEN dimensions_id = 2 THEN 8
                        WHEN dimensions_id = 3 THEN 8
                        WHEN dimensions_id = 7 THEN 4
                        ELSE 0
                    END as hours
                    FROM groups WHERE id = $groupID;";

            $exist = $pdo->query($sql);
            return intval($exist->fetchColumn());

        } else {
            return false;
        }
    }

    function countName($procID, $areaID, $dimID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT count(1) FROM groups WHERE areas_id = $areaID AND dimensions_id = $dimID AND process_id = $procID;";

            $exist = $pdo->query($sql);
            return intval($exist->fetchColumn()) + 1;

        } else {
            return false;
        }
    }

    function getGroupID($procID, $areaID, $dimID, $groupName)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT id FROM groups WHERE areas_id = $areaID  AND dimensions_id = $dimID AND process_id = $procID AND name = '$groupName';";
            $exist = $pdo->query($sql);
            return intval($exist->fetchColumn());
        } else {
            return false;
        }
    }

    public function getAllGroups()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT id, group_name, teacher, id_teacher, dimension, area, process, amount, DATE_FORMAT(date_start, \"%d/%m/%y\") as date_start, DATE_FORMAT(date_end, \"%d/%m/%y\") as date_end, stat  FROM vgroups ORDER BY date_end DESC, area ASC, dimension ASC";
        $response['groups'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['group_name'] = $row['group_name'];
            $p['teacher'] = $row['teacher'];
            $p['id_teacher'] = $row['id_teacher'];
            $p['dimension'] = $row['dimension'];
            $p['area'] = $row['area'];
            $p['process'] = $row['process'];
            $p['amount'] = $row['amount'];
            $p['date_start'] = $row['date_start'];
            $p['date_end'] = $row['date_end'];
            $p['stat'] = $row['stat'];
            array_push($response['groups'], $p);
        }
        return json_encode($response);
    }

    public function getAllRooms()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT id, name FROM classrooms ORDER BY name ASC;";
        $response['rooms'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['name'] = $row['name'];
            array_push($response['rooms'], $p);
        }
        return json_encode($response);
    }

    public function getSchedulesByGroup($groupID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT id, TIME_FORMAT(time_start, \"%H:%i\") as time_start, TIME_FORMAT(time_end, \"%H:%i\") as time_end, ROUND(ROUND(TIMEDIFF(time_end, time_start))/10000) AS hours, (SELECT name FROM days WHERE id = days_id) as days, (SELECT name FROM classrooms WHERE id = classrooms_id) as room
FROM schedules WHERE groups_id = $groupID ORDER BY days_id;";
        $response['schedules'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['time_start'] = $row['time_start'];
            $p['time_end'] = $row['time_end'];
            $p['hours'] = $row['hours'];
            $p['days'] = $row['days'];
            $p['room'] = $row['room'];
            array_push($response['schedules'], $p);
        }
        return json_encode($response);
    }

    public function getStudentsWithoutGroup($groupID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT 
                    id,
                    (SELECT concat(lastname, ' ', name) FROM people WHERE id = (SELECT people_id FROM students WHERE id = students_id)) as student,
                    (SELECT name FROM programs WHERE id = programs_id) as program,
                    score
                FROM student_data 
                    WHERE process_id = (SELECT process_id FROM groups WHERE id = $groupID) AND 
                    programs_id IN (SELECT id FROM programs WHERE areas_id = (SELECT areas_id FROM groups WHERE id = $groupID)) AND 
                    score < (SELECT percent * 4 FROM process WHERE id = (SELECT process_id FROM groups WHERE id = $groupID)) AND 
                    id NOT IN (SELECT student_data_id FROM student_group WHERE groups_id = $groupID) ORDER BY score DESC;";
        $response['students'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['student'] = $row['student'];
            $p['program'] = $row['program'];
            $p['score'] = $row['score'];
            array_push($response['students'], $p);
        }
        return json_encode($response);
    }

    public function getStudentsInGroup($groupID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT
                    stgr.id as stgr,
                    concat(pl.lastname, ' ', pl.name)  as student,
                    pg.name as program,
                    stdt.score as score
                FROM student_group as stgr
                JOIN student_data as stdt ON stdt.id = stgr.student_data_id
                    JOIN students as st ON st.id = stdt.students_id
                        JOIN people as pl ON pl.id = st.people_id
                    JOIN programs as pg ON pg.id = stdt.programs_id
                WHERE stgr.groups_id = $groupID ORDER BY stdt.score DESC;";
        $response['students'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['stgr'];
            $p['student'] = $row['student'];
            $p['program'] = $row['program'];
            $p['score'] = $row['score'];
            array_push($response['students'], $p);
        }
        return json_encode($response);
    }
}