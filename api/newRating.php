<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

header('Content-type: application/json');

include_once(dirname(__FILE__) . "/database.php");
include_once(dirname(__FILE__) . "/utils/getClientIp.php");
include_once(dirname(__FILE__) . "/secrets.php");

$db = new Database;
$teachingQualityRating = $db->escapeStrings($_POST["teachingQuality"]);
$kindnessRating =  $db->escapeStrings($_POST["kindness"]);
$authorityRating = $db->escapeStrings($_POST["authority"]);
$humorRating = $db->escapeStrings($_POST["humor"]);

$teacherId = $db->escapeStrings($_POST["teacherId"]);

$clientIp = getClientIp();
$hashedIp = $db->escapeStrings(hash("sha256", $clientIp. HASH_SECRET));

if($teachingQualityRating > 10 || $teachingQualityRating <= 0 || 
   $kindnessRating > 10 || $kindnessRating <= 0 || 
   $authorityRating > 10 || $authorityRating <= 0 || 
   $humorRating > 10 || $humorRating <= 0) {
    echo "invalid values";
    exit();
}

$sameUserVotes = $db->select("SELECT * FROM cescoleaks_votes WHERE teacher_ID = '$teacherId' AND IP = '$hashedIp'");
if(count($sameUserVotes) >= 1){
    $db->query("UPDATE cescoleaks_votes 
                SET teaching_quality = '$teachingQualityRating', 
                    kindness = '$kindnessRating', 
                    authority = '$authorityRating', 
                    humor = '$humorRating' 
                WHERE teacher_ID = '$teacherId' AND IP = '$hashedIp'
    ");

    echo json_encode(array("info" => "vote updated"));
    exit();
}

$db->query("INSERT INTO cescoleaks_votes (teacher_ID, IP, teaching_quality, kindness, authority, humor) VALUES 
            ('$teacherId', '$hashedIp', '$teachingQualityRating', '$kindnessRating', '$authorityRating', '$humorRating')");

exit(); // we never know
?>
