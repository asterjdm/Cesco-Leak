<?php
$adminPassword = $_GET["password"];
$teacherName = $_GET["name"];
$imageUrl = $_GET["imageUrl"];



if (hash("md5", $adminPassword) == "dd19318448e24a788d5313f690f4fa7e") {
    $jsonString = file_get_contents('teachers_data.json');
    $data = json_decode($jsonString, true);

    $defaultRating = array("ratingSum" => 0, "votes" => 0);
    array_push($data, array(
        'name' => $teacherName,
        'id' => count($data) + 1,
        'image' => $imageUrl,
        'teachingQuality' => $defaultRating,
        'kindness' => $defaultRating,
        'authority' => $defaultRating,
        'humor' => $defaultRating
    ));
    
    $newJsonString = json_encode($data);
    file_put_contents('teachers_data.json', $newJsonString);
    echo "success";
    exit();
}else {
    echo "invalid password";
    exit();
}

exit();
?>
