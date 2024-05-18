<?php

header('Content-type: application/json');
include_once(dirname(__FILE__) . "/database.php");
include_once(dirname(__FILE__) . "/utils/getClientIp.php");
include_once(dirname(__FILE__) . "/secrets.php");


$db =  new Database;
$clientIp = getClientIp();
$hashedIp = $db->escapeStrings(hash("sha256", $clientIp . HASH_SECRET));

$bannRecords = $db->select("SELECT * FROM cescoleaks_bann WHERE IP = '$hashedIp'");

if (count($bannRecords) >= 1) {
    echo json_encode(array(
        "banned" => true,
        "start_date" => $bannRecords[0]["start_date"],
        "end_date" => $bannRecords["end_date"],
        "reason" => $bannRecords[0]["reason"],
        "ip" => $bannRecords[0]["IP"],
    ));
} else {
    echo json_encode(array(
        "banned" => false,
        "ip" => $hashedIp,
    ));
}
