<?php
require $_SERVER['DOCUMENT_ROOT'] . '/nivelation/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


session_start();

$filename = $_SESSION['files']['filepath'] ?? '';

if ($filename !== '') {

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filename);
    $data = $spreadsheet->getActiveSheet()->toArray();
    $tb_body = "";

    foreach ($data as $row) {
        $num = $row['0'];
        $dni = $row['1'];
        $codepos = $row['2'];
        $codeuni = $row['3'];
        $lastname = $row['4'];
        $name = $row['5'];
        $gender = $row['6'];
        $area = $row['7'];
        $school = $row['8'];
        $omg = $row['9'];

        $q1 = $row['10'];
        $q2 = $row['11'];
        $q3 = $row['12'];
        $q4 = $row['13'];
        $q5 = $row['14'];
        $q6 = $row['15'];
        $q7 = $row['16'];
        $q8 = $row['17'];
        $q9 = $row['18'];
        $q10 = $row['19'];
        $q11 = $row['20'];
        $q12 = $row['21'];
        $q13 = $row['22'];
        $q14 = $row['23'];
        $q15 = $row['24'];
        $q16 = $row['25'];
        $q17 = $row['26'];
        $q18 = $row['27'];
        $q19 = $row['28'];
        $q20 = $row['29'];
        $q21 = $row['30'];
        $q22 = $row['31'];
        $q23 = $row['32'];
        $q24 = $row['33'];
        $q25 = $row['34'];
        $q26 = $row['35'];
        $q27 = $row['36'];
        $q28 = $row['37'];
        $q29 = $row['38'];
        $q30 = $row['39'];
        $q31 = $row['40'];
        $q32 = $row['41'];
        $q33 = $row['42'];
        $q34 = $row['43'];
        $q35 = $row['44'];
        $q36 = $row['45'];
        $q37 = $row['46'];
        $q38 = $row['47'];
        $q39 = $row['48'];
        $q40 = $row['49'];
        $q41 = $row['50'];
        $q42 = $row['51'];
        $q43 = $row['52'];
        $q44 = $row['53'];
        $q45 = $row['54'];
        $q46 = $row['55'];
        $q47 = $row['56'];
        $q48 = $row['57'];
        $q49 = $row['58'];
        $q50 = $row['59'];
        $q51 = $row['60'];
        $q52 = $row['61'];
        $q53 = $row['62'];
        $q54 = $row['63'];
        $q55 = $row['64'];
        $q56 = $row['65'];
        $q57 = $row['66'];
        $q58 = $row['67'];
        $q59 = $row['68'];
        $q60 = $row['69'];
        $q61 = $row['70'];
        $q62 = $row['71'];
        $q63 = $row['72'];
        $q64 = $row['73'];
        $q65 = $row['74'];
        $q66 = $row['75'];
        $q67 = $row['76'];
        $q68 = $row['77'];
        $q69 = $row['78'];
        $q70 = $row['79'];
        $q71 = $row['80'];
        $q72 = $row['81'];
        $q73 = $row['82'];
        $q74 = $row['83'];
        $q75 = $row['84'];
        $q76 = $row['85'];
        $q77 = $row['86'];
        $q78 = $row['87'];
        $q79 = $row['88'];
        $q80 = $row['89'];
        $q81 = $row['90'];
        $q82 = $row['91'];
        $q83 = $row['92'];
        $q84 = $row['93'];
        $q85 = $row['94'];
        $q86 = $row['95'];
        $q87 = $row['96'];
        $q88 = $row['97'];
        $q89 = $row['98'];
        $q90 = $row['99'];
        $q91 = $row['100'];
        $q92 = $row['101'];
        $q93 = $row['102'];
        $q94 = $row['103'];
        $q95 = $row['104'];
        $q96 = $row['105'];
        $q97 = $row['106'];
        $q98 = $row['107'];
        $q99 = $row['108'];
        $q100 = $row['109'];

        $score = $row['110'];
        $blank = $row['111'];
        $good = $row['112'];
        $bad = $row['113'];

        $tb_body .= "<tr>";
        $tb_body .= "<td><small>$num</small></td>";
        $tb_body .= "<td><small>$dni</small></td>";
        $tb_body .= "<td><small>$codepos</small></td>";
        $tb_body .= "<td><small>$codeuni</small></td>";
        $tb_body .= "<td><small>$lastname</small></td>";
        $tb_body .= "<td><small>$name</small></td>";
        $tb_body .= "<td><small>$gender</small></td>";
        $tb_body .= "<td><small>$area</small></td>";
        $tb_body .= "<td><small>$school</small></td>";
        $tb_body .= "<td><small>$omg</small></td>";
        $tb_body .= "<td><small>$q1</small></td>";
        $tb_body .= "<td><small>$q2</small></td>";
        $tb_body .= "<td><small>$q3</small></td>";
        $tb_body .= "<td><small>$q4</small></td>";
        $tb_body .= "<td><small>$q5</small></td>";
        $tb_body .= "<td><small>$q6</small></td>";
        $tb_body .= "<td><small>$q7</small></td>";
        $tb_body .= "<td><small>$q8</small></td>";
        $tb_body .= "<td><small>$q9</small></td>";
        $tb_body .= "<td><small>$q10</small></td>";
        $tb_body .= "<td><small>$q11</small></td>";
        $tb_body .= "<td><small>$q12</small></td>";
        $tb_body .= "<td><small>$q13</small></td>";
        $tb_body .= "<td><small>$q14</small></td>";
        $tb_body .= "<td><small>$q15</small></td>";
        $tb_body .= "<td><small>$q16</small></td>";
        $tb_body .= "<td><small>$q17</small></td>";
        $tb_body .= "<td><small>$q18</small></td>";
        $tb_body .= "<td><small>$q19</small></td>";
        $tb_body .= "<td><small>$q20</small></td>";
        $tb_body .= "<td><small>$q21</small></td>";
        $tb_body .= "<td><small>$q22</small></td>";
        $tb_body .= "<td><small>$q23</small></td>";
        $tb_body .= "<td><small>$q24</small></td>";
        $tb_body .= "<td><small>$q25</small></td>";
        $tb_body .= "<td><small>$q26</small></td>";
        $tb_body .= "<td><small>$q27</small></td>";
        $tb_body .= "<td><small>$q28</small></td>";
        $tb_body .= "<td><small>$q29</small></td>";
        $tb_body .= "<td><small>$q30</small></td>";
        $tb_body .= "<td><small>$q31</small></td>";
        $tb_body .= "<td><small>$q32</small></td>";
        $tb_body .= "<td><small>$q33</small></td>";
        $tb_body .= "<td><small>$q34</small></td>";
        $tb_body .= "<td><small>$q35</small></td>";
        $tb_body .= "<td><small>$q36</small></td>";
        $tb_body .= "<td><small>$q37</small></td>";
        $tb_body .= "<td><small>$q38</small></td>";
        $tb_body .= "<td><small>$q39</small></td>";
        $tb_body .= "<td><small>$q40</small></td>";
        $tb_body .= "<td><small>$q41</small></td>";
        $tb_body .= "<td><small>$q42</small></td>";
        $tb_body .= "<td><small>$q43</small></td>";
        $tb_body .= "<td><small>$q44</small></td>";
        $tb_body .= "<td><small>$q45</small></td>";
        $tb_body .= "<td><small>$q46</small></td>";
        $tb_body .= "<td><small>$q47</small></td>";
        $tb_body .= "<td><small>$q48</small></td>";
        $tb_body .= "<td><small>$q49</small></td>";
        $tb_body .= "<td><small>$q50</small></td>";
        $tb_body .= "<td><small>$q51</small></td>";
        $tb_body .= "<td><small>$q52</small></td>";
        $tb_body .= "<td><small>$q53</small></td>";
        $tb_body .= "<td><small>$q54</small></td>";
        $tb_body .= "<td><small>$q55</small></td>";
        $tb_body .= "<td><small>$q56</small></td>";
        $tb_body .= "<td><small>$q57</small></td>";
        $tb_body .= "<td><small>$q58</small></td>";
        $tb_body .= "<td><small>$q59</small></td>";
        $tb_body .= "<td><small>$q60</small></td>";
        $tb_body .= "<td><small>$q61</small></td>";
        $tb_body .= "<td><small>$q62</small></td>";
        $tb_body .= "<td><small>$q63</small></td>";
        $tb_body .= "<td><small>$q64</small></td>";
        $tb_body .= "<td><small>$q65</small></td>";
        $tb_body .= "<td><small>$q66</small></td>";
        $tb_body .= "<td><small>$q67</small></td>";
        $tb_body .= "<td><small>$q68</small></td>";
        $tb_body .= "<td><small>$q69</small></td>";
        $tb_body .= "<td><small>$q70</small></td>";
        $tb_body .= "<td><small>$q71</small></td>";
        $tb_body .= "<td><small>$q72</small></td>";
        $tb_body .= "<td><small>$q73</small></td>";
        $tb_body .= "<td><small>$q74</small></td>";
        $tb_body .= "<td><small>$q75</small></td>";
        $tb_body .= "<td><small>$q76</small></td>";
        $tb_body .= "<td><small>$q77</small></td>";
        $tb_body .= "<td><small>$q78</small></td>";
        $tb_body .= "<td><small>$q79</small></td>";
        $tb_body .= "<td><small>$q80</small></td>";
        $tb_body .= "<td><small>$q81</small></td>";
        $tb_body .= "<td><small>$q82</small></td>";
        $tb_body .= "<td><small>$q83</small></td>";
        $tb_body .= "<td><small>$q84</small></td>";
        $tb_body .= "<td><small>$q85</small></td>";
        $tb_body .= "<td><small>$q86</small></td>";
        $tb_body .= "<td><small>$q87</small></td>";
        $tb_body .= "<td><small>$q88</small></td>";
        $tb_body .= "<td><small>$q89</small></td>";
        $tb_body .= "<td><small>$q90</small></td>";
        $tb_body .= "<td><small>$q91</small></td>";
        $tb_body .= "<td><small>$q92</small></td>";
        $tb_body .= "<td><small>$q93</small></td>";
        $tb_body .= "<td><small>$q94</small></td>";
        $tb_body .= "<td><small>$q95</small></td>";
        $tb_body .= "<td><small>$q96</small></td>";
        $tb_body .= "<td><small>$q97</small></td>";
        $tb_body .= "<td><small>$q98</small></td>";
        $tb_body .= "<td><small>$q99</small></td>";
        $tb_body .= "<td><small>$q100</small></td>";

        $tb_body .= "<td><small>$score</small></td>";
        $tb_body .= "<td><small>$blank</small></td>";
        $tb_body .= "<td><small>$good</small></td>";
        $tb_body .= "<td><small>$bad</small></td>";
        $tb_body .= "</tr>";
    }

    echo $tb_body;
} else {
    echo "<p>No hay datos</p>";
}
