<?php
include_once(dirname(__FILE__) . "/database.php");

session_start();


$teachingQualityRating = $_GET["teachingQuality"];
$kindnessRating = $_GET["kindness"];
$authorityRating = $_GET["authority"];
$humorRating = $_GET["humor"];

$teacherId = $_GET["teacherId"];

// if($_SESSION["alreadyVoted".$teacherId] == true){
//     echo '<script>alert("Vous ne pouvez pas voter deux fois sur le même professeur!");</script>';

//     header("location: index.php");
//     exit();
// }

if($teachingQualityRating > 10 || $teachingQualityRating <= 0 || $kindnessRating > 10 || $kindnessRating <= 0 || $authorityRating > 10 || $authorityRating <= 0 || $humorRating > 10 || $humorRating <= 0) {
    echo "invalid values";
    exit();
}
$db = new Database;
$db -> query("INSERT INTO cescoleaks_votes (teacher_ID, teaching_quality, kindness, authority, humor) VALUES 
            ('$teacherId', '$teachingQualityRating', '$kindnessRating', '$authorityRating', '$humorRating')");

header("location: index.php");

exit(); // Because we never know...
?>