<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once(dirname(__FILE__) . "/database.php");
include_once(dirname(__FILE__) . "/utils/getClientIp.php");
include_once(dirname(__FILE__) . "/secrets.php");

$db = new Database;

$adminPassword = $_POST["password"];
if ($adminPassword != ADMIN_PASSWORD) {
    echo "wrong admin password";
    exit();
}

$commentId = $db->escapeStrings($_POST['comment_id']);
$duration = $_POST['duration'];
$endDate = $db->escapeStrings(time() + $duration);
$comment = $db->select("SELECT * FROM cescoleaks_comment WHERE comment_id = '$commentId'");

$authorIp = $db->escapeStrings($comment[0]["IP"]);
$db->query("DELETE FROM cescoleaks_comments WHERE ID = '$commentId'");

$db->query("INSERT INTO cescoleaks_bann ('IP', 'end_time') VALUES ('$authorIp', '$endDate')");
