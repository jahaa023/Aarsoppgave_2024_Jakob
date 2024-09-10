<?php
session_start();
$brukernavn = $_SESSION['brukernavn'];
$passord = $_SESSION['passord'];
include "db_conn.php";
require __DIR__ . '/validate.php';
$senotat = "";
$slettid = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste over reservasjoner</title>
    <style><?php include "style.css"?></style> <!-- bruker php for å importe style.css pga cache problemer -->
    <link rel="stylesheet" href="https://use.typekit.net/sxl6kxv.css"> <!--Font fra Adobe-->
    <link rel="icon" type="image/x-icon" href="images/La_Bella_Luna_favicon.png"> <!--Favicon-->
    <script>
    function hideNotater(){
        document.getElementById("notaterContainer").style.display = "none"
    }
    </script>
</head>
<body>
    <div class="liste_content">
        <header>
            <a href="index.php"><img src="images/La_Bella_Luna_Logo.svg" alt="La Bella Luna Logo"></a>
        </header>
        <form action="liste.php" method="POST" id="action_form"></form><!--Form som blir tilkalt når en knapp trykkes på tabell for å endre på database-->
        <form action="velgbord.php" method="POST" id="bord_form"></form><!--Form som blir tilkalt når ansatt velger bord for reservering-->
        <div class="table_wrapper">
        <table>
            <tr>
                <th>ID</th>
                <th>Fornavn</th>
                <th>Etternavn</th>
                <th>Telefonnummer</th>
                <th>E-post</th>
                <th>Dato</th>
                <th>Klokkeslett</th>
                <th>Notater</th>
                <th>Antall personer</th>
                <th>Bord</th>
                <th>Slett</th>
            </tr>
            <?php
            $sql = "SELECT * FROM brukere WHERE brukernavn='$brukernavn' AND passord='$passord'"; //SQL kode for å hente brukernavn og passord

            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) === 1) { //Sjekker om brukernavn og passord bruker skrev inn er riktig
                $row = mysqli_fetch_assoc($result);
                if($row['brukernavn'] === $brukernavn && $row['passord'] === $passord) {

                if(isset($_POST["slett"])) { //sletter rad fra tabell
                    $slett = $_POST["slett"];
                    $sql = "DELETE FROM reserver_info WHERE id=$slett";
                    $result = $conn-> query($sql);
                };

                if(isset($_POST["slett_bekreft"])) { //bekrefter om man skal slette rad fra tabell
                    $slettid = $_POST["slett_bekreft"];
                    echo '<style type="text/css">
                        .bekreft_slett_container {
                            display: inline;
                        }
                        </style>';
                };

                if(isset($_POST["senotat"])) {
                    if($_POST["senotat"] != 1) { //henter notater fra database
                        $senotat = $_POST["senotat"];
                        echo '<style type="text/css">
                        .notater_container {
                            display: inline;
                        }
                        </style>';
                    };
                }

                $sql = "SELECT id, fornavn, etternavn, telefonnummer, epost, dato, klokkeslett, notater, antall_personer, bord from reserver_info"; //SQL kode for å hente informasjon fra database
                $result = $conn-> query($sql);

                if ($result-> num_rows > 0) { //sjekker at resultatet ikke er tomt
                    while ($row = $result-> fetch_assoc()) { //for hver row i database, print det ut i ett html table
                        //Validerer alle variabler før det printes ut
                        $etternavn = validate($row['etternavn']);
                        $fornavn = validate($row['fornavn']);
                        $dato = validate($row['dato']);
                        $klokkeslett = validate($row['klokkeslett']);
                        $antallPersoner = validate($row['antall_personer']);


                        if(empty($row["notater"])) { //Har med notater knapp hvis notater er skrevet
                            $notaterInfo = "</td><td>Ingen notater";
                        } else {
                            $notater = validate($row['notater']);
                            $notaterInfo = "</td><td><button type='submit' name='senotat' form='action_form' value='". $fornavn . " " . $etternavn . ": <br>". $notater ."'>Les mer</button>";
                        };

                        if(empty($row["bord"])) { //Har med bord hvis reservasjonen har et bord
                            $bordInfo = "</td><td><button type='submit' name='bordid' form='bord_form' value='" .$row["id"] ."'>Velg bord</button>";
                        } else {
                            $bordInfo = "</td><td>". $row["bord"] ." <button type='submit' name='bordid' form='bord_form' value='" .$row["id"] ."'>Endre</button>";
                        };

                        echo "<tr><td>". $row["id"] ."</td><td>". $fornavn . "</td><td>". $etternavn ."</td><td>". $row["telefonnummer"] ."</td><td>". $row["epost"] ."</td><td>". $dato ."</td><td>". $klokkeslett .$notaterInfo . "</td><td>". $antallPersoner .$bordInfo ."</td><td><button type='submit' name='slett_bekreft' form='action_form' value='". $row["id"] ."'>Slett</button></td></tr>";
                    }
                    echo "</table>"; //lukker table på slutt
                }

                $conn-> close(); //lukker tilkobling etter den er ferdig
                };
            };
            ?>
        </table>
        </div>
        <div class="notater_container" id="notaterContainer"> <!--Container hvor notater vises når man trykker "Les mer" knappen-->
            <div class="notater_boks">
                <h1><?php echo $senotat; ?></h1>
                <div class="notat_ferdig_button_container">
                    <form action="liste.php" method="POST">
                        <button type="submit" name="senotat" value=1 class="notat_ferdig_button">Ferdig</button> <!--Value er satt til 1 for å ikke vise notater når man refresher--->
                    </form>
                </div>
            </div>
        </div>
        <div class="bekreft_slett_container"> <!--Container hvor man bekrefter sletting av rad når man trykker "slett" knappen-->
            <div class="bekreft_slett_boks">
                <h1>Er du sikker på at du vil slette <br> reservasjon for ID <?php echo $slettid ?>?</h1>
                <form action="liste.php" method="POST" class="bekreft_slett_knapper">
                    <button type="submit" id="avbryt_knapp">Avbryt</button>
                    <button type="submit" name="slett" value="<?php echo $slettid ?>" id="bekreft_knapp">Bekreft</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>