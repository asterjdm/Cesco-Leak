<?php

session_start();


$teachingQualityRating = $_GET["teachingQuality"];
$kindnessRating = $_GET["kindness"];
$authorityRating = $_GET["authority"];
$humorRating = $_GET["humor"];

$teacherId = $_GET["teacherId"];

if($_SESSION["alreadyVoted".$teacherId] == true){
    echo '<script>alert("Vous ne pouvez pas voter deux fois sur le même professeur!");</script>';

    header("location: index.php");
    exit();
}

if($teachingQualityRating > 10 || $teachingQualityRating <= 0 || $kindnessRating > 10 || $kindnessRating <= 0 || $authorityRating > 10 || $authorityRating <= 0 || $humorRating > 10 || $humorRating <= 0) {
    echo "invalid values";
    exit();
}

$jsonString = file_get_contents('teachers_data.json');
$data = json_decode($jsonString, true);

for ($i=0; $i < count($data); $i++) { 
    if($data[$i]["id"] == $teacherId) {
        $data[$i]["teachingQuality"]["ratingSum"] += $teachingQualityRating;
        $data[$i]["kindness"]["ratingSum"] += $kindnessRating;
        $data[$i]["authority"]["ratingSum"] += $authorityRating;
        $data[$i]["humor"]["ratingSum"] += $humorRating;
        $data[$i]["teachingQuality"]["votes"] += 1;
        $data[$i]["kindness"]["votes"] += 1;
        $data[$i]["authority"]["votes"] += 1;
        $data[$i]["humor"]["votes"] += 1;
        break;
    }
}

$newJsonString = json_encode($data);
file_put_contents('teachers_data.json', $newJsonString);

$_SESSION["alreadyVoted".$teacherId] = true;

header("location: index.php");

exit(); // Because we never know...
?>