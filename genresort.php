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
                            <li><a href="index.php">Home</a></li>
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

                //Genre-ID aus der Datenbank holen
                if (isset($_POST['genresort'])) {
                    $genreId = $_POST['genreId'];

                    $record =  mysqli_query($con, "SELECT * FROM autor, buch, genre, review WHERE genre.GENREID = $genreId AND autor.AUTORID = buch.AUTORID
                    AND genre.GENREID = buch.GENREID AND buch.BUCHID = review.BUCHID");
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
                                <option value="1" <?php echo ($genreId == '1') ? 'selected' : '' ?>>Roman</option>
                                <option value="3" <?php echo ($genreId == '3') ? 'selected' : '' ?>>Thriller</option>
                                <option value="30" <?php echo ($genreId == '30') ? 'selected' : '' ?>>Humor</option>
                                <option value="31" <?php echo ($genreId == '31') ? 'selected' : '' ?>>Krimi</option>
                                <option value="2" <?php echo ($genreId == '2') ? 'selected' : '' ?>>Fantasy</option>
                                <option value="29" <?php echo ($genreId == '29') ? 'selected' : '' ?>>Science Fiction</option>
                                <option value="32" <?php echo ($genreId == '32') ? 'selected' : '' ?>>Liebesroman</option>
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
                    //Return all posts/reviews with the selected genre
                    $sql =  "SELECT * FROM autor, genre, buch, review WHERE genre.GENREID = $genreId AND review.BUCHID = buch.BUCHID AND buch.AUTORID = autor.AUTORID AND buch.GENREID = genre.GENREID";
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

                            <h4>Review</h4>
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

                    <?php
                    //If the query doesn't return a result, show the text below
                    $anzahl_ergebnisse = mysqli_num_rows($result);

                    if ($anzahl_ergebnisse < 1) {
                        echo "<span class='sortresponse'>Es gibt keine Rezension zu diesem Genre.</span>";
                    }  ?>

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