<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog für Buchrezensionen</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="headerbackground">
                <div class="opacity">
                    <h1>Blog für Buchrezensionen</h1>
                    <nav>
                        <ul>
                            <li><a class="active" href="index.php">Home</a></li>
                            <li><a href="createreview.php">Neue Rezension</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main>
            <div class="mainbackground">
                <?php
                //Verbindung zur Datenbank herstellen
                include "initdb.php";

                //Code, der nach Absenden in creativereview.php ausgeführt wird
                if (isset($_POST['save'])) {
                    $buchtitel = $_POST['buchtitel'];
                    $genreId = $_POST['genreId'];
                    $vorname = $_POST['vorname'];
                    $nachname = $_POST['nachname'];
                    $bewertung = $_POST['bewertung'];
                    $review = $_POST['review'];

                    //Daten aus PHP Form in Datenbank eintragen

                    //Prüfen, ob der Autor schon existiert
                    $query = mysqli_query($con, "SELECT 1 FROM autor WHERE autor.VORNAME = '$vorname' AND autor.NACHNAME = '$nachname'");

                    if (mysqli_num_rows($query) > 0) {
                        //ID des Autors in einer Variablen speichern, wenn er existiert
                        $result = mysqli_query($con, "SELECT * FROM autor WHERE autor.VORNAME = '$vorname' AND autor.NACHNAME = '$nachname'");
                        $data = mysqli_fetch_array($result);
                        $autorId = $data['AUTORID'];
                    } else {
                        //Autor in die Tabelle eintragen, wenn er nicht existiert
                        mysqli_query($con, "INSERT INTO autor (AUTORID, VORNAME, NACHNAME) VALUES('', '$vorname', '$nachname')");
                        $autorId = mysqli_insert_id($con);
                    }

                    mysqli_query($con, "INSERT INTO buch (BUCHID, GENREID, AUTORID, BUCHTITEL) VALUES('', '$genreId', '$autorId', '$buchtitel')");
                    $buchId = mysqli_insert_id($con);

                    mysqli_query($con, "INSERT INTO review (REVIEWID, BUCHID, REVIEW, BEWERTUNG, DATUM) VALUES('', '$buchId', '$review', '$bewertung', now())");
                }

                //Updates a book review with data from editreview.php
                if (isset($_POST['update'])) {
                    $reviewId = $_POST['reviewId'];
                    $autorId = $_POST['autorId'];
                    $genreId = $_POST['genreId'];
                    $buchId = $_POST['buchId'];
                    $buchtitel = $_POST['buchtitel'];
                    $vorname = $_POST['vorname'];
                    $nachname = $_POST['nachname'];
                    $bewertung = $_POST['bewertung'];
                    $review = $_POST['review'];

                    mysqli_query($con, "UPDATE `autor` SET `VORNAME` = '$vorname',`NACHNAME` = '$nachname' WHERE `autor`.`AUTORID` = $autorId");
                    mysqli_query($con, "UPDATE `buch` SET `GENREID` = '$genreId', `BUCHTITEL` = '$buchtitel'  WHERE `buch`.`BUCHID` = $buchId");
                    mysqli_query($con, "UPDATE `review` SET `BEWERTUNG` = '$bewertung', `REVIEW` = '$review' WHERE `review`.`REVIEWID` = $reviewId");
                }

                //Deletes a book review
                if (isset($_GET['delete'])) {
                    $reviewId = $_GET['delete'];

                    mysqli_query($con, "DELETE review, buch, autor FROM review INNER JOIN buch INNER JOIN autor WHERE review.REVIEWID = $reviewId AND buch.BUCHID = review.BUCHID 
                            AND autor.AUTORID = buch.AUTORID");
                }

                ?>

                               <!--Sortieren Navigation-->
                               <div class="sort">
                    

                    <div class="sortfloat1">
                        <form action="authorsort.php" method="POST">
                            <input type="submit" name="authorsort" id="authorsort" value="Nach Autor sortieren">
                        </form>
                    </div>

                    <div class="sortfloat1">
                        <form action="booksort.php" method="POST">
                            <input type="submit" name="booksort" id="booksort" value="Nach Buch sortieren">
                        </form>
                    </div>

                    <div class="sortfloat1">
                        <form action="bewertungsort.php" method="POST">
                            <input type="submit" name="bewertungsort" id="bewertungsort" value="Nach Bewertung sortieren">
                        </form>
                    </div>


                    <form action="genresort.php" method="POST">
                        <div class="sortfloat2">
                            <select name="genreId" required>
                                <option value="1">Roman</option>
                                <option value="3">Thriller</option>
                                <option value="30">Humor</option>
                                <option value="31">Krimi</option>
                                <option value="2">Fantasy</option>
                                <option value="29">Science Fiction</option>
                                <option value="32">Liebesroman</option>
                            </select>
                        </div>

                        <div class="sortfloat2">
                            <input type="submit" name="genresort" id="genresort" value="Nach Genre sortieren">
                        </div>
                    </form>
                </div>

                <!-- Daten aus der Datenbank holen und in einem Review-Post anzeigen -->
                <div class="review">
                    <?php

                    $sql =  "SELECT * FROM autor, buch, genre, review WHERE autor.AUTORID = buch.AUTORID  
                            AND genre.GENREID = buch.GENREID AND buch.BUCHID = review.BUCHID ORDER BY DATUM DESC";
                    $result = $con->query($sql);

                    ?>

                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class=post>
                            <span class="datum">
                            <?php echo "Erstellt am: " . $row["DATUM"]; ?>
                            </span>

                            <h3>
                                <?php echo $row["BUCHTITEL"]; ?>
                            </h3>

                            <span class="name">
                            <?php echo "von " . $row["VORNAME"]; ?>
                            <?php echo $row["NACHNAME"]; ?>
                            </span><br>

                            <span class="genre">
                            <?php echo "Genre: " . $row["GENRE"]; ?>
                            </span>
                            <span class="bewertung">
                            <?php echo $row["BEWERTUNG"] . " von 5 Sternen"; ?>
                            </span>

                            <h4>Rezension</h4>
                            <div class="reviewtext">
                            <?php echo $row["REVIEW"]; ?>
                            </div>

                            <div class="reviewbuttons">
                            <a href="editreview.php?edit=<?php echo $row['REVIEWID']; ?>">Bearbeiten </a>
                            </div>
                            <div class="reviewbuttons">
                            <a href="index.php?delete=<?php echo $row['REVIEWID']; ?> ">Löschen </a>
                            </div>
                            <div class="empty"></div>
                        </div>
                    <?php } ?>

                </div>
                <?php
                // Verbindung zur Datenbank schließen
                mysqli_close($con);
                ?>

            </div>
        </main>
        <div class="footerbackground">
            <footer>
            </footer>
        </div>
    </div>
</body>

</html>