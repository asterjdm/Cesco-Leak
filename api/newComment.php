<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

header('Content-type: application/json');

include_once(dirname(__FILE__) . "/database.php");
include_once(dirname(__FILE__) . "/utils/getClientIp.php");
include_once(dirname(__FILE__) . "/secrets.php");

$db = new Database;

$content =  $db->escapeStrings(htmlspecialchars($_POST['content']));
$teacherId = $db->escapeStrings($_POST['teacherId']);

$clientIp = getClientIp();
$hashedIp = $db->escapeStrings(hash("sha256", $clientIp . HASH_SECRET));

$bannRecords = $db->select("SELECT * FROM cescoleaks_bann WHERE IP = '$hashedIp'");

if (count($bannRecords) > 0) {
    echo json_encode(array("error" => "banned"));
}

$db->query("INSERT INTO cescoleaks_comments (teacher_ID, IP, content) VALUES 
            ('$teacherId', '$hashedIp', '$content')");
echo json_encode(array());

exit();
