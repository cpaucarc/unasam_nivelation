<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class Tracing
{
    public function __construct()
    {
    }

    public function getCoursesOfProgram($procID, $progID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT 
                    id as groupID,
                    name as groupName,
                    (SELECT name FROM dimensions WHERE id = dimensions_id) as dimName,
                    (SELECT concat(lastname, ' ', name) FROM people WHERE id = (SELECT people_id FROM teachers WHERE id = teachers_id )) as teacher,
                    (SELECT name FROM areas WHERE id = areas_id) as areaName,
                    date_format(date_start, '%d-%m-%Y') as date_start,
	                date_format(date_end, '%d-%m-%Y') as date_end,
                    (SELECT count(1) FROM student_group WHERE groups_id = id) as numStudents
                FROM groups WHERE id IN (SELECT groups_id FROM student_group 
                WHERE student_data_id IN (SELECT id FROM student_data 
                WHERE programs_id = $progID AND process_id = $procID));";
        $response['dimensions'] = array();
        foreach ($conn->query($sql) as $row) {
            $teacher = array();
            $teacher['groupID'] = $row['groupID'];
            $teacher['groupName'] = $row['groupName'];
            $teacher['dimName'] = $row['dimName'];
            $teacher['teacher'] = $row['teacher'];
            $teacher['areaName'] = $row['areaName'];
            $teacher['date_start'] = $row['date_start'];
            $teacher['date_end'] = $row['date_end'];
            $teacher['numStudents'] = $row['numStudents'];
            array_push($response['dimensions'], $teacher);
        }
        return json_encode($response);
    }

    public function getStudentsOfProgramByGroup($groupID, $progID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT
                    stgr.id as id,
                    stdt.code as code,
                    concat(pl.lastname, ' ', pl.name) as student,
                    IFNULL(phone, 'Sin dato') as phone,
                    IFNULL(email, 'Sin dato') as email,
                    IFNULL(address, 'Sin dato') as address,
                    percentAttendace(stgr.student_data_id, stgr.groups_id) as percent
                FROM student_group AS stgr
                JOIN groups as gr on gr.id = stgr.groups_id
                JOIN student_data as stdt on stdt.id = stgr.student_data_id
                    JOIN students as st on st.id = stdt.students_id
                        JOIN people as pl on pl.id = st.people_id
                WHERE gr.id = $groupID AND stdt.programs_id = $progID;";
        $response['students'] = array();
        foreach ($conn->query($sql) as $row) {
            $student = array();
            $student['id'] = $row['id'];//student_groupID
            $student['code'] = $row['code'];
            $student['student'] = $row['student'];
            $student['phone'] = $row['phone'];
            $student['email'] = $row['email'];
            $student['address'] = $row['address'];
            $student['percent'] = $row['percent'];
            array_push($response['students'], $student);
        }
        return json_encode($response);
    }

    public function getProgramOfDirector($directorID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT programs_id FROM directors WHERE id = $directorID;";

            $exist = $pdo->query($sql);
            return intval($exist->fetchColumn());

        } else {
            return 0;
        }
    }

}