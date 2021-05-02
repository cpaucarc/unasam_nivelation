<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require $_SERVER['DOCUMENT_ROOT'] . '/nivelation/vendor/autoload.php';
require_once(UTIL_PATH . "Student.php");
require_once(UTIL_PATH . "Question.php");

use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelReader
{
    private string $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    function read()
    {
        $filename = $this->path;

        if ($filename !== '' and $filename !== null) {

            $spreadsheet = IOFactory::load($filename);
            $data = $spreadsheet->getActiveSheet()->toArray();

            $students = array();

            foreach ($data as $row) {
                $student = new Student();
                $student->setId(0);
                $student->setDni($row['1']);
                $student->setPostulantCode($row['2']);
                $student->setCode($row['3']);
                $student->setLastname($row['4']);
                $student->setName($row['5']);
                $student->setGender($row['6']);
                $student->setArea($row['7']);
                $student->setProgram($row['8']);
                $student->setOmg(intval($row['9']));
                $student->setOmp(0);

                $questions = array();
                array_push($questions, new Question(1, floatval($row['10'])));
                array_push($questions, new Question(2, floatval($row['11'])));
                array_push($questions, new Question(3, floatval($row['12'])));
                array_push($questions, new Question(4, floatval($row['13'])));
                array_push($questions, new Question(5, floatval($row['14'])));
                array_push($questions, new Question(6, floatval($row['15'])));
                array_push($questions, new Question(7, floatval($row['16'])));
                array_push($questions, new Question(8, floatval($row['17'])));
                array_push($questions, new Question(9, floatval($row['18'])));
                array_push($questions, new Question(10, floatval($row['19'])));
                array_push($questions, new Question(11, floatval($row['20'])));
                array_push($questions, new Question(12, floatval($row['21'])));
                array_push($questions, new Question(13, floatval($row['22'])));
                array_push($questions, new Question(14, floatval($row['23'])));
                array_push($questions, new Question(15, floatval($row['24'])));
                array_push($questions, new Question(16, floatval($row['25'])));
                array_push($questions, new Question(17, floatval($row['26'])));
                array_push($questions, new Question(18, floatval($row['27'])));
                array_push($questions, new Question(19, floatval($row['28'])));
                array_push($questions, new Question(20, floatval($row['29'])));
                array_push($questions, new Question(21, floatval($row['30'])));
                array_push($questions, new Question(22, floatval($row['31'])));
                array_push($questions, new Question(23, floatval($row['32'])));
                array_push($questions, new Question(24, floatval($row['33'])));
                array_push($questions, new Question(25, floatval($row['34'])));
                array_push($questions, new Question(26, floatval($row['35'])));
                array_push($questions, new Question(27, floatval($row['36'])));
                array_push($questions, new Question(28, floatval($row['37'])));
                array_push($questions, new Question(29, floatval($row['38'])));
                array_push($questions, new Question(30, floatval($row['39'])));
                array_push($questions, new Question(31, floatval($row['40'])));
                array_push($questions, new Question(32, floatval($row['41'])));
                array_push($questions, new Question(33, floatval($row['42'])));
                array_push($questions, new Question(34, floatval($row['43'])));
                array_push($questions, new Question(35, floatval($row['44'])));
                array_push($questions, new Question(36, floatval($row['45'])));
                array_push($questions, new Question(37, floatval($row['46'])));
                array_push($questions, new Question(38, floatval($row['47'])));
                array_push($questions, new Question(39, floatval($row['48'])));
                array_push($questions, new Question(40, floatval($row['49'])));
                array_push($questions, new Question(41, floatval($row['50'])));
                array_push($questions, new Question(42, floatval($row['51'])));
                array_push($questions, new Question(43, floatval($row['52'])));
                array_push($questions, new Question(44, floatval($row['53'])));
                array_push($questions, new Question(45, floatval($row['54'])));
                array_push($questions, new Question(46, floatval($row['55'])));
                array_push($questions, new Question(47, floatval($row['56'])));
                array_push($questions, new Question(48, floatval($row['57'])));
                array_push($questions, new Question(49, floatval($row['58'])));
                array_push($questions, new Question(50, floatval($row['59'])));
                array_push($questions, new Question(51, floatval($row['60'])));
                array_push($questions, new Question(52, floatval($row['61'])));
                array_push($questions, new Question(53, floatval($row['62'])));
                array_push($questions, new Question(54, floatval($row['63'])));
                array_push($questions, new Question(55, floatval($row['64'])));
                array_push($questions, new Question(56, floatval($row['65'])));
                array_push($questions, new Question(57, floatval($row['66'])));
                array_push($questions, new Question(58, floatval($row['67'])));
                array_push($questions, new Question(59, floatval($row['68'])));
                array_push($questions, new Question(60, floatval($row['69'])));
                array_push($questions, new Question(61, floatval($row['70'])));
                array_push($questions, new Question(62, floatval($row['71'])));
                array_push($questions, new Question(63, floatval($row['72'])));
                array_push($questions, new Question(64, floatval($row['73'])));
                array_push($questions, new Question(65, floatval($row['74'])));
                array_push($questions, new Question(66, floatval($row['75'])));
                array_push($questions, new Question(67, floatval($row['76'])));
                array_push($questions, new Question(68, floatval($row['77'])));
                array_push($questions, new Question(69, floatval($row['78'])));
                array_push($questions, new Question(70, floatval($row['79'])));
                array_push($questions, new Question(71, floatval($row['80'])));
                array_push($questions, new Question(72, floatval($row['81'])));
                array_push($questions, new Question(73, floatval($row['82'])));
                array_push($questions, new Question(74, floatval($row['83'])));
                array_push($questions, new Question(75, floatval($row['84'])));
                array_push($questions, new Question(76, floatval($row['85'])));
                array_push($questions, new Question(77, floatval($row['86'])));
                array_push($questions, new Question(78, floatval($row['87'])));
                array_push($questions, new Question(79, floatval($row['88'])));
                array_push($questions, new Question(80, floatval($row['89'])));
                array_push($questions, new Question(81, floatval($row['90'])));
                array_push($questions, new Question(82, floatval($row['91'])));
                array_push($questions, new Question(83, floatval($row['92'])));
                array_push($questions, new Question(84, floatval($row['93'])));
                array_push($questions, new Question(85, floatval($row['94'])));
                array_push($questions, new Question(86, floatval($row['95'])));
                array_push($questions, new Question(87, floatval($row['96'])));
                array_push($questions, new Question(88, floatval($row['97'])));
                array_push($questions, new Question(89, floatval($row['98'])));
                array_push($questions, new Question(90, floatval($row['99'])));
                array_push($questions, new Question(91, floatval($row['100'])));
                array_push($questions, new Question(92, floatval($row['101'])));
                array_push($questions, new Question(93, floatval($row['102'])));
                array_push($questions, new Question(94, floatval($row['103'])));
                array_push($questions, new Question(95, floatval($row['104'])));
                array_push($questions, new Question(96, floatval($row['105'])));
                array_push($questions, new Question(97, floatval($row['106'])));
                array_push($questions, new Question(98, floatval($row['107'])));
                array_push($questions, new Question(99, floatval($row['108'])));
                array_push($questions, new Question(100, floatval($row['109'])));

                $student->setScore(floatval($row['110']));
                $student->setBlank(intval($row['111']));
                $student->setGood(intval($row['112']));
                $student->setBad(intval($row['113']));

                array_push($students, $student);
            }
            return $students;
        } else {
            return null;
        }
    }
}