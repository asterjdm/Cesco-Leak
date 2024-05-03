<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">

    <title>cesco-leak</title>

    <script defer src="scripts/script.js"></script>
</head>

<body>
    <header>
        <h1 class="titleh1">The missing Cescole teacher monitoring</h1>
    </header>

    <div id="ratingPopup" class="popup popup-hidden">
        <form action="newRating.php" method="GET" class="popup-content">
            <label class="popup-label">
                "Ce professeur explique il bien ?"
                <input type="range" name="teachingQuality" class="popup-range" min=1 max=10>
            </label>
            <label class="popup-label">
                "Ce professeur est il sympa ?"
                <input type="range" name="kindness" class="popup-range" min=1 max=10>
            </label>
            <label class="popup-label">
                "Ce professeur a il de l'autorité ?"
                <input type="range" name="authority" class="popup-range" min=1 max=10>
            </label>
            <label class="popup-label">
                "Comment est l'humour de ce professeur ?"
                <input type="range" name="humor" class="popup-range" min=1 max=10>
            </label>
            <input type="hidden" id="teacherIdInput" name="teacherId" class="popup-hidden">
            <button type="submit" class="popup-button">Voter !</button>
            <button type="button" onclick="closeRatingPopup()" class="popup-button">Fermer</button>
        </form>
    </div>


    <main id="main">
        <?php

        $jsonData = file_get_contents('teachers_data.json');
        $teachers = json_decode($jsonData, true);
        foreach ($teachers as $teacher) {
            $charPTeachingQuality = "";
            $charPkidness = "";
            $charPAuthority = "";
            $charPHumor = "";
            for ($i = 0; $i < 10; $i++) {
                $charPTeachingQuality .= '<p class="char';
                $charPkidness .= '<p class="char';
                $charPAuthority .= '<p class="char';
                $charPHumor .= '<p class="char';

                
                if ($teacher["teachingQuality"]["votes"] != 0 && $teacher["teachingQuality"]["ratingSum"]/$teacher["teachingQuality"]["votes"] >= $i) {
                    $charPTeachingQuality .= ' checked';
                }
                if ($teacher["kindness"]["votes"] != 0 && $teacher["kindness"]["ratingSum"]/$teacher["kindness"]["votes"]  >= $i) {
                    $charPkidness .= ' checked';
                }
                if ($teacher["authority"]["votes"] != 0 && $teacher["authority"]["ratingSum"]/$teacher["authority"]["votes"]  >= $i) {
                    $charPAuthority .= ' checked';
                }
                if ($teacher["humor"]["votes"] != 0 && $teacher["humor"]["ratingSum"]/$teacher["humor"]["votes"]  >= $i) {
                    $charPHumor .= ' checked';
                }

                $charPTeachingQuality .= '">★</p>';
                $charPkidness .= '">★</p>';
                $charPAuthority .= '">★</p>';
                $charPHumor .= '">★</p>';
            }
            echo '
            <div class="card">
                <div class="container">
                    <div class="top">
                        <div class="top-content">
                            <img src="' . $teacher["image"] . '" alt="image" class="people-img">
                            <div class="people-name">
                                <p>' . $teacher["name"] . '</p>
                            </div>
                            <button class="voteButton" onclick="openRatingPopup('.$teacher["id"].')" >Voter</button>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="bottom-content">
                            <div class="ratings">
                                <h3>Teaching Quality:</h3>
                                ' . $charPTeachingQuality . '
                            </div>
                            <div class="ratings">
                                <h3>Kindness:</h3>
                                ' . $charPkidness . '
                            </div>
                            <div class="ratings">
                                <h3>Authority:</h3>
                                ' . $charPAuthority . '
                            </div>
                            <div class="ratings">
                                <h3>Humor:</h3>
                                ' . $charPHumor . '
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        ?>
    </main>
</body>
</html>
