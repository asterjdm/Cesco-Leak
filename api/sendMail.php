<?php
include_once(dirname(__FILE__) . "/secrets.php");

include_once(dirname(__FILE__) . "/utils/getClientIp.php");

$userMsg = $_GET['msg'];
$clientIP = getClientIp();
$msg = "Le message du débile en question : $userMsg\n Son IP (on sais jamais) $clientIP";

for ($i=0; $i < count(EMAILS); $i++) { 
    mail(EMAILS[$i], "CESCOLEAKS: Ya un débile qui nous envoi un message", $msg);
}

header("location: ../about.html");

?>