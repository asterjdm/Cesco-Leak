<?php
header('Content-type: application/json');

$db = new Database;

$teacherId = $db->escapeStrings($_POST['teacherID']);

$teachers = $db -> select("SELECT * FROM cescoleaks_comments WHERE teacher_ID = '$teacherId'");

echo json_encode($teachers);
?>