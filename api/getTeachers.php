<?php
header('Content-type: application/json');

include_once(dirname(__FILE__) . "/database.php");

$searchQuery = $_GET["searchQuery"];

$db = new Database;
if(isset($searchQuery)){
    $teachers = $db->select("SELECT * FROM cescoleaks_teachers WHERE name LIKE '%$searchQuery%'");
}else {
    $teachers = $db->select("SELECT * FROM cescoleaks_teachers");
}

foreach ($teachers as &$teacher) {
    $votesData = $db->select("SELECT * FROM cescoleaks_votes WHERE teacher_ID = '{$teacher["ID"]}'");
    $votesCount = count($votesData);

    $teachingQualityTotal = 0;
    $kindnessTotal = 0;
    $authorityTotal = 0;
    $humorTotal = 0;

    foreach ($votesData as $vote) {
        $teachingQualityTotal += $vote["teaching_quality"];
        $kindnessTotal += $vote["kindness"];
        $authorityTotal += $vote["authority"];
        $humorTotal += $vote["humor"];
    }

    $teacher["teaching_quality"] = ($votesCount > 0) ? round($teachingQualityTotal / $votesCount) : 0;
    $teacher["kindness"] = ($votesCount > 0) ? round($kindnessTotal / $votesCount) : 0;
    $teacher["authority"] = ($votesCount > 0) ? round($authorityTotal / $votesCount) : 0;
    $teacher["humor"] = ($votesCount > 0) ? round($humorTotal / $votesCount) : 0;
}

echo json_encode($teachers);

?>
