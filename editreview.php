<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buchrezension bearbeiten</title>
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


                //Daten aus der Datenbank holen, um sie im Formular anzeigen zu können
                if (isset($_GET['edit'])) {
                    $reviewId = $_GET['edit'];

                    $record =  mysqli_query($con, "SELECT * FROM autor, buch, genre, review WHERE review.REVIEWID = $reviewId AND autor.AUTORID = buch.AUTORID
                    AND genre.GENREID = buch.GENREID AND buch.BUCHID = review.BUCHID");

                    $data = mysqli_fetch_array($record);
                    $autorId = $data['AUTORID'];
                    $genreId = $data['GENREID'];
                    $buchId = $data['BUCHID'];
                    $buchtitel = $data['BUCHTITEL'];
                    $vorname = $data['VORNAME'];
                    $nachname = $data['NACHNAME'];
                    $bewertung = $data['BEWERTUNG'];
                    $review = $data['REVIEW'];
                }

                ?>
                <!--Review Formular-->
                <div class="form">
                    <form action="index.php" method="POST">
                        <fieldset>
                            <legend>Rezension bearbeiten</legend>

                            <input type="hidden" name="reviewId" value="<?php echo $reviewId; ?>">
                            <input type="hidden" name="autorId" value="<?php echo $autorId; ?>">
                            <input type="hidden" name="buchId" value="<?php echo $buchId; ?>">

                            <div class="row">
                                <div class="label">
                                    <label for="buchtitel">Buchtitel</label>
                                </div>
                                <div class="input">
                                    <input type="text" id="buchtitel" name="buchtitel" value="<?php echo $buchtitel; ?>" placeholder="Der Titel des Buches..." required>
                                </div>
                            </div>

                            <!--Genre Auswahl-->
                            <div class="row">
                                <div class="label">
                                    <label for="genreId">Genre</label>
                                </div>
                                <div class="input">
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
                            </div>

                            <div class="row">
                                <div class="label">
                                    <label for="vorname">Vorname</label>
                                </div>
                                <div class="input">
                                    <input type="text" id="vorname" name="vorname" value="<?php echo $vorname; ?>" placeholder="Der Vorname des Autors..." required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="label">
                                    <label for="nachname">Nachname</label>
                                </div>
                                <div class="input">

                                    <input type="text" id="nachname" name="nachname" value="<?php echo $nachname; ?>" placeholder="Der Nachname des Autors..."required>
                                </div>
                            </div>

                            <!--Radio Buttons für Bewertung-->
                            <div class="row">
                                <div class="label">
                                    <label for="bewertung"></label>
                                </div>
                                <div class="input">
                                    <fieldset>
                                        <input type="radio" id="eins" name="bewertung" value="1" <?php echo ($bewertung == '1') ? 'checked' : '' ?> required>
                                        <label for="eins">1</label>
                                        <input type="radio" id="zwei" name="bewertung" value="2" <?php echo ($bewertung == '2') ? 'checked' : '' ?> required>
                                        <label for="zwei">2</label>
                                        <input type="radio" id="drei" name="bewertung" value="3" <?php echo ($bewertung == '3') ? 'checked' : '' ?> required>
                                        <label for="drei">3</label>
                                        <input type="radio" id="vier" name="bewertung" value="4" <?php echo ($bewertung == '4') ? 'checked' : '' ?> required>
                                        <label for="vier">4</label>
                                        <input type="radio" id="fuenf" name="bewertung" value="5" <?php echo ($bewertung == '5') ? 'checked' : '' ?> required>
                                        <label for="fuenf">5</label>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row">
                                <div class="label">
                                    <label for="review">Rezension</label><br>
                                </div>
                                <div class="input">

                                    <textarea id="review" name="review" cols="30" rows="10" placeholder="Schreibe etwas über das Buch..." required><?php echo $review; ?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <input type="submit" name="update" value="Änderungen speichern">
                            </div>

                        </fieldset>
                    </form>
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