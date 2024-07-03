<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neue Buchrezension</title>
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
                            <li><a class="active" href="createreview.php">Neue Rezension</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main>
            <div class="mainbackground">


                <!--Review Formular-->
                <div class="form">
                    <form action=" index.php" method="POST">
                        <fieldset>
                            <legend>Neue Rezension</legend>

                            <div class="row">
                                <div class="label">
                                    <label for="buchtitel">Buchtitel</label>
                                </div>
                                <div class="input">
                                    <input type="text" id="buchtitel" name="buchtitel" placeholder="Der Titel des Buches..." required>
                                </div>
                            </div>

                            <!--Genre Auswahl-->
                            <div class="row">
                                <div class="label">
                                    <label for="genreid">Genre</label>
                                </div>
                                <div class="input">
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
                            </div>

                            <!--Autor Vorname-->
                            <div class="row">
                                <div class="label">
                                    <label for="vorname">Vorname</label>
                                </div>
                                <div class="input">
                                    <input type="text" id="vorname" name="vorname" placeholder="Der Vorname des Autors..." required>
                                </div>
                            </div>

                            <!--Autor Nachname-->
                            <div class="row">
                                <div class="label">
                                    <label for="nachname">Nachname</label>
                                </div>
                                <div class="input">
                                    <input type="text" id="nachname" name="nachname" placeholder="Der Nachname des Autors..." required>
                                </div>
                            </div>

                            <!--Radio Buttons für Bewertung-->
                            <div class="row">
                                <div class="label">
                                    <label for="bewertung">Bewertung</label>
                                </div>
                                <div class="input">
                                    <fieldset>
                                        <input type="radio" id="eins" name="bewertung" value="1" required>
                                        <label for="eins">1</label>
                                        <input type="radio" id="zwei" name="bewertung" value="2" required>
                                        <label for="zwei">2</label>
                                        <input type="radio" id="drei" name="bewertung" value="3" required>
                                        <label for="drei">3</label>
                                        <input type="radio" id="vier" name="bewertung" value="4" required>
                                        <label for="vier">4</label>
                                        <input type="radio" id="fuenf" name="bewertung" value="5" required>
                                        <label for="fuenf">5</label>
                                    </fieldset>
                                </div>
                            </div>

                            <!--Rezension textarea-->
                            <div class="row">
                                <div class="label">
                                    <label for="review">Rezension</label>
                                </div>
                                <div class="input">
                                    <textarea name="review" id="review" cols="30" rows="10" placeholder="Schreibe etwas über das Buch..." required></textarea>
                                </div>
                            </div>

                            <!--Buttons-->
                            <div class="row">
                             <input type="submit" name="save" value="Speichern">   
                            </div>

                            <div class="row">
                                <input type="reset">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </main>
        <div class="footerbackground">
            <footer>
            </footer>
        </div>
    </div>
</body>

</html>