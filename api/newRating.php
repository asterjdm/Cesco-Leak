<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once(dirname(__FILE__) . "/database.php");

$db = new Database;
$teachingQualityRating = $db->escapeStrings($_POST["teachingQuality"]);
$kindnessRating =  $db->escapeStrings($_POST["kindness"]);
$authorityRating = $db->escapeStrings($_POST["authority"]);
$humorRating = $db->escapeStrings($_POST["humor"]);

$teacherId = $db->escapeStrings($_POST["teacherId"]);

if($teachingQualityRating > 10 || $teachingQualityRating <= 0 || 
   $kindnessRating > 10 || $kindnessRating <= 0 || 
   $authorityRating > 10 || $authorityRating <= 0 || 
   $humorRating > 10 || $humorRating <= 0) {
    echo "invalid values";
    exit();
}

$db->query("INSERT INTO cescoleaks_votes (teacher_ID, teaching_quality, kindness, authority, humor) VALUES 
            ('$teacherId', '$teachingQualityRating', '$kindnessRating', '$authorityRating', '$humorRating')");

exit(); // we never know
?>
