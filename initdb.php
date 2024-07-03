<?php
//Daten für Server: Benutzername und Passwort in Variablen speichern
$server = "localhost";
$user = "root";
$passwort = "";

//Verbindung zur Datenbank herstellen
$db = new mysqli($server, $user, $passwort);

$con = mysqli_connect($server, $user, $passwort, `andodb`);
$sql = mysqli_select_db($con, `andodb`);

//UTF-8 als Zeichensatz verwenden
mysqli_set_charset($con, "utf-8");

//Erstelle die Datenbank, falls sie noch nicht existiert
$createdb = "CREATE DATABASE IF NOT EXISTS `andodb`";
//Ausführen des Befehls auf dem Server
$con->query($createdb);

//Datenbank andodb1 benutzen
$usedb = "USE `andodb`";
//Ausführen des Befehls auf dem Server
$con->query($usedb);

//Tabellen erstellen

//Tabellenstruktur für Tabelle `autor`
$createtableautor = "CREATE TABLE IF NOT EXISTS `autor` (
    `AUTORID` int(11) NOT NULL,
  `VORNAME` varchar(50) NOT NULL,
  `NACHNAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$con->query($createtableautor);

//Daten für Tabelle `autor`
$insertautor = "INSERT INTO `autor` (`AUTORID`, `VORNAME`, `NACHNAME`) VALUES
(2, 'Philip', 'Pullman'),
(3, 'Ursula', 'Poznanski'),
(4, 'Giorgos', 'Koukoulas'),
(59, 'John', 'Ironmonger'),
(123, 'Dawn', 'Cook'),
(124, 'Julie', 'Kagawa'),
(125, 'Paige', 'Toon');";

$con->query($insertautor);

//Tabellenstruktur für Tabelle `buch`
$createtablebuch = "CREATE TABLE IF NOT EXISTS `buch` (
    `BUCHID` bigint(20) NOT NULL,
    `GENREID` int(11) NOT NULL,
    `AUTORID` int(11) NOT NULL,
    `BUCHTITEL` varchar(200) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$con->query($createtablebuch);

//Daten für Tabelle `buch`
$insertbuch = "INSERT INTO `buch` (`BUCHID`, `GENREID`, `AUTORID`, `BUCHTITEL`) VALUES
(9783551310927, 2, 2, 'Der goldene Kompass'),
(9783743200494, 3, 3, 'Erebos 2'),
(9786188178700, 1, 4, 'Atlantis wird nie untergehen'),
(9789047704836, 3, 3, 'Saeculum'),
(9789047704855, 1, 59, 'Der Wal und das Ende der Welt'),
(9789047704920, 2, 123, 'Die Tochter der Königin'),
(9789047704921, 2, 124, 'Plötzlich Fee: Sommernacht Band 1'),
(9789047704922, 1, 125, 'Du bist mein Stern')";

$con->query($insertbuch);

//Tabellenstruktur für Tabelle `genre`
$createtablegenre = "CREATE TABLE IF NOT EXISTS `genre` (
    `GENREID` int(11) NOT NULL,
    `GENRE` varchar(50) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$con->query($createtablegenre);

//Daten für Tabelle `genre`
$insertgenre = "INSERT INTO `genre` (`GENREID`, `GENRE`) VALUES
  (2, 'Fantasy'),
  (30, 'Humor'),
  (31, 'Krimi'),
  (32, 'Liebesroman'),
  (1, 'Roman'),
  (29, 'Science Fiction'),
  (3, 'Thriller');";

$con->query($insertgenre);

//Tabellenstruktur für Tabelle `review`
$createtablereview = "CREATE TABLE IF NOT EXISTS `review` (
    `REVIEWID` int(11) NOT NULL,
    `BUCHID` bigint(11) NOT NULL,
    `REVIEW` longtext NOT NULL,
    `BEWERTUNG` int(11) NOT NULL,
    `DATUM` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$con->query($createtablereview);

//Daten für Tabelle `review`
$insertreview = "INSERT INTO `review` (`REVIEWID`, `BUCHID`, `REVIEW`, `BEWERTUNG`, `DATUM`) VALUES
(2, 9783743200494, 'Der zweite Teil von Erebos ist genauso spannend wie der erste Teil. Ich wusste bis zur Auflösung nicht, wer oder was diesmal hinter Erebos steckte. Deswegen habe ich das Buch in aller Eile verschlungen.', 5, '2020-07-15 15:49:49'),
(3, 9783551310927, 'Der erste Teil einer ganz tollen Buchreihe. In der Welt von Lyra Belacqua ist einiges anders als bei uns. Zum Beispiel hat jeder Mensch einen Daemon, der seine Seele widerspiegelt. Die Welt von Lyra zieht einen schnell in ihren Bann. Ich kann das Buch nur empfehlen.', 5, '2020-07-15 15:50:12'),
(4, 9786188178700, 'Ich habe das Buch in einem Urlaub in Griechenland gekauft und war sofort begeistert. In dem Buch gibt es zwei Handlungsstränge: Einer findet in der Gegenwart statt, der andere Jahrtausende in der Vergangenheit. Die Geschichten verlaufen parallel zueinander, haben aber einen faszinierenden Zusammenhang. Sehr zu empfehlen!', 4, '2020-07-15 15:50:36'),
(5, 9789047704836, 'Ein weiterer spannener Thriller von Ursula Poznanski. Ich konnte gar nicht aufhören zu lesen. Ein Nachteil ist aber, das es beim zweiten Lesen dann nicht mehr so spannend ist, da man dann schon weiß, was hinter allem steckt.', 3, '2020-07-15 15:50:56'),
(26, 9789047704855, 'Der Wal und das Ende der Welt ist ein überraschend aktuelles Buch, in dem es um eine globale Epidemie geht.\r\nDie liebenswerten Charaktere und die Handlung ziehen einen schnell in ihren Bann. Sehr zu empfehlen!', 4, '2020-08-01 21:11:06'),
(58, 9789047704920, 'Dieses Buch konnte ich fast nicht mehr aus der Hand legen. Die Charaktere sind vielschichtig und die Probleme der Königreiche im Hintergrund sind faszinierend beschrieben. Wer an mittelalterlichen Spionen mit Fantasy Touch interessiert ist, für den ist das ein empfehlenswertes Buch!', 5, '2020-08-09 12:53:30'),
(59, 9789047704921, 'Ursprünglich habe ich mir das Buch wegen des hübschen Covers gekauft. Die Geschichte ist ganz nett, lässt aber in den Folgeteilen deutlich nach und wird zu kompliziert und unübersichtlich. ', 2, '2020-08-09 12:59:10'),
(60, 9789047704922, 'Der Schreibstil von Paige Toon begeistert und man wird in die Story hineingezogen. Auch wenn das offene Ende ein wenig unerwartet kommt und erst im Folgeband aufgelöst wird, so ist der Weg dorthin spannend und man folgt den Erlebnissen von Meg gerne. ', 3, '2020-08-09 13:09:17');";

$con->query($insertreview);

//Indizes für die Tabelle `autor`
$alterautor = "ALTER TABLE `autor`
  ADD PRIMARY KEY (`AUTORID`),
  ADD KEY `AUTORID` (`AUTORID`);";

$con->query($alterautor);

//Indizes für die Tabelle `buch`
$alterbuch = "ALTER TABLE `buch`
  ADD PRIMARY KEY (`BUCHID`),
  ADD KEY `ISBN` (`BUCHID`),
  ADD KEY `GENREID` (`GENREID`),
  ADD KEY `AUTORID` (`AUTORID`);";

$con->query($alterbuch);

//Indizes für die Tabelle `genre`
$altergenre = "ALTER TABLE `genre`
  ADD PRIMARY KEY (`GENREID`),
  ADD UNIQUE KEY `GENRE` (`GENRE`),
  ADD KEY `GENREID` (`GENREID`);";

$con->query($altergenre);

//Indizes für die Tabelle `review`
$alterreview = "ALTER TABLE `review`
  ADD PRIMARY KEY (`REVIEWID`),
  ADD KEY `REVIEWID` (`REVIEWID`),
  ADD KEY `ISBN` (`BUCHID`);";

$con->query($alterreview);

//AUTO_INCREMENT für Tabelle `autor`
$ai_autor = "ALTER TABLE `autor`
  MODIFY `AUTORID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;";

$con->query($ai_autor);

//AUTO_INCREMENT für Tabelle `buch`
$ai_buch = "ALTER TABLE `buch`
  MODIFY `BUCHID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9789047704920;";

$con->query($ai_buch);

//AUTO_INCREMENT für Tabelle `genre`
$ai_genre = "ALTER TABLE `genre`
  MODIFY `GENREID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;";

$con->query($ai_genre);

//AUTO_INCREMENT für Tabelle `review`
$ai_review = "ALTER TABLE `review`
  MODIFY `REVIEWID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;";

$con->query($ai_review);

//Constraints der Tabelle `buch`
$constraintbuch = "ALTER TABLE `buch`
  ADD CONSTRAINT `buch_ibfk_1` FOREIGN KEY (`GENREID`) REFERENCES `genre` (`GENREID`),
  ADD CONSTRAINT `buch_ibfk_2` FOREIGN KEY (`AUTORID`) REFERENCES `autor` (`AUTORID`);";

$con->query($constraintbuch);

//Constraints der Tabelle `review`
$constraintreview = "ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`BUCHID`) REFERENCES `buch` (`BUCHID`);";

$con->query($constraintreview);

$commit = "COMMIT;";
$con->query($commit);
