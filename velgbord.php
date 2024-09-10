<?php
session_start();
include "db_conn.php"; //Kobler til database
//Henter data fra forrige side
$brukernavn = $_SESSION['brukernavn'];
$passord = $_SESSION['passord'];
$bordid = $_POST["bordid"];
if(isset($_POST["bord"])) {
    $bord = $_POST["bord"];
};
$ledigArray = array();
$opptattArray = array();

$sql = "SELECT * FROM brukere WHERE brukernavn='$brukernavn' AND passord='$passord'"; //SQL kode for å hente brukernavn og passord

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) === 1) { //Sjekker om brukernavn og passord bruker skrev inn er riktig
    $row = mysqli_fetch_assoc($result);
    if($row['brukernavn'] === $brukernavn && $row['passord'] === $passord) {
        for ($i = 1; $i < 9; $i++){ //Definerer hver "BordTallTxt" variabel, en for hvert bord, og fyller array for ledige plasser
            $arrayPushValue = "Bord " . $i;
            array_push($ledigArray, $arrayPushValue);
            $bordTekstVar = "Bord" . $i . "Txt";
            ${$bordTekstVar} = "Ledig";
        };
        $sql = "SELECT * FROM reserver_info WHERE id='$bordid'"; //SQL kode for å hente dato og klokkeslett assosiert med bordid
        
        $result = mysqli_query($conn, $sql);
        $row = $result-> fetch_assoc();
        $klokkeslett = $row['klokkeslett']; //Klokkeslett assosiert med bordid
        $dato = $row['dato']; //Dato assosiert med bordid
        
        $sql = "SELECT * FROM reserver_info WHERE klokkeslett='$klokkeslett' AND dato='$dato'"; //SQL kode for å hente reserversjoner med samme klokkeslett og dato som bordid
        
        $result = mysqli_query($conn, $sql);
        if ($result-> num_rows > 0) { //sjekker at resultatet ikke er tomt
            while ($row = $result-> fetch_assoc()) { //for hver row i database som har lik klokkeslett og dato, sjekk hvilke bord som er tatt.
                if ($row['id'] == $bordid) { //Gjør at den ikke sjekker seg selv, aka bordid
                    continue;
                } else {
                    array_push($opptattArray, $row['bord']); // Legger alle optatte bord i en array, for mobil versjonen
                    $opptattBord = str_replace(' ', '', $row['bord']); //Fjerner mellomrom fra "Bord Tall" og gjør det til "BordTall"
                    $opptattBord = $opptattBord . "Txt"; //Legger til Txt på slutten
                    ${$opptattBord} = "Opptatt"; //Gjør teksten på opptatt ledig varslene til Opptatt på bordene som er opptatt
                };
            };
        };

        
        // Fjerner opptatte bord fra ledig bord arrayen
        $intersectedArrayValues = array_intersect($ledigArray, $opptattArray);
        foreach ($intersectedArrayValues as $value) {
            if (($key = array_search($value, $ledigArray)) !== false) {
                unset($ledigArray[$key]);
            }
        }
    };
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Bella Luna Restaurant</title>
    <link rel="stylesheet" href="style.css">
    <style><?php include "style.css"?></style> <!-- bruker php for å importe style.css pga cache problemer -->
    <link rel="stylesheet" href="https://use.typekit.net/sxl6kxv.css"> <!--Font fra Adobe-->
    <link rel="icon" type="image/x-icon" href="images/La_Bella_Luna_favicon.png"> <!--Favicon-->
    <script> const optionsArray = []; </script> <!-- Array som må bli definert før siden loader inn -->
</head>
<body>
    <div class="bord_container" id="reserverBord">
        <div class="bord_boks">
            <img src="images/restaurant_layout.jpg" alt="Bilde av restaurant layout" id="bord_bilde_normal">
            <img src="images/restaurant_layout_mobil.jpg" alt="Bilde av restaurant layout" id="bord_bilde_mobil">
            <form action="velgbord.php" method="POST" id="bord_form_normal"> <!--Form hvor man kan velge hvilket bord kunden skal ha-->
                <button id="Bord1" type="submit" name="bord" value="Bord 1">
                    <div class="opptatt_ledig_varsel">
                        <h1 id="h1Bord1"><?php echo $Bord1Txt ?></h1>
                    </div>
                    Bord 1
                </button>
                <button id="Bord2" type="submit" name="bord" value="Bord 2">
                    <div class="opptatt_ledig_varsel">
                        <h1 id="h1Bord2"><?php echo $Bord2Txt ?></h1>
                    </div>
                    Bord 2
                </button>
                <button id="Bord3" type="submit" name="bord" value="Bord 3">
                    <div class="opptatt_ledig_varsel">
                        <h1 id="h1Bord3"><?php echo $Bord3Txt ?></h1>
                    </div>
                    Bord 3
                </button>
                <button id="Bord4" type="submit" name="bord" value="Bord 4">
                    Bord 4
                    <div class="opptatt_ledig_varsel">
                        <h1 id="h1Bord4"><?php echo $Bord4Txt ?></h1>
                    </div>
                </button>
                <button id="Bord5" type="submit" name="bord" value="Bord 5">
                    Bord 5
                    <div class="opptatt_ledig_varsel">
                        <h1 id="h1Bord5"><?php echo $Bord5Txt ?></h1>
                    </div>
                </button>
                <button id="Bord6" type="submit" name="bord" value="Bord 6">
                    Bord 6
                    <div class="opptatt_ledig_varsel">
                        <h1 id="h1Bord6"><?php echo $Bord6Txt ?></h1>
                    </div>
                </button>
                <button id="Bord7" type="submit" name="bord" value="Bord 7">
                    Bord 7
                    <div class="opptatt_ledig_varsel">
                        <h1 id="h1Bord7"><?php echo $Bord7Txt ?></h1>
                    </div>
                </button>
                <button id="Bord8" type="submit" name="bord" value="Bord 8">
                    Bord 8
                    <div class="opptatt_ledig_varsel">
                        <h1 id="h1Bord8"><?php echo $Bord8Txt ?></h1>
                    </div>
                </button>
                <input type="hidden" name="bordid" value="<?php echo $bordid; ?>"> <!--Sender dataen videre til neste side-->
            </form>
            <form action="velgbord.php" method="POST" id="bord_form_mobil"> <!--Form hvor man kan velge hvilket bord kunden skal ha, på mobil/mindre skjermer-->
                <select name="bord">
                    <option value="Bord 1" id="optionBord1">Bord 1</option>
                    <option value="Bord 2" id="optionBord2">Bord 2</option>
                    <option value="Bord 3" id="optionBord3">Bord 3</option>
                    <option value="Bord 4" id="optionBord4">Bord 4</option>
                    <option value="Bord 5" id="optionBord5">Bord 5</option>
                    <option value="Bord 6" id="optionBord6">Bord 6</option>
                    <option value="Bord 7" id="optionBord7">Bord 7</option>
                    <option value="Bord 8" id="optionBord8">Bord 8</option>
                </select>
                <button type="submit">Registrer</button>
                <input type="hidden" name="bordid" value="<?php echo $bordid; ?>"> <!--Sender dataen videre til neste side-->
            </form>
            <div class="opptatt_ledig_mobil">
                <div class="ledig_mobil_container">
                    <h1>Ledig</h1>
                    <?php
                    foreach ($ledigArray as $value) {
                        echo $value . "<br>";
                    }
                    ?>
                </div>
                <div class="opptatt_mobil_container">
                    <h1>Opptatt</h1>
                    <?php
                    foreach ($opptattArray as $value) {
                        echo $value . "<br>";
                        echo "<script>optionsArray.push('" . $value . "');</script>"; //Legger til opptatte bord i JavaScript array for senere
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bord_varsel_container"> <!--Varsel som kommer opp når man registrerer et bord-->
        <div class="bord_varsel_boks">
            <h1><?php echo $bord; ?> er registrert for ID <?php echo $bordid; ?>.</h1>
            <form action="liste.php" method="POST">
                <button type="submit">Ferdig</button>
            </form>
        </div>
    </div>
</body>
<script>
    function checkButtons() { //funksjon for å skru av knapper på opptatte bord og skifte farge på tekst
        for (let i = 1; i < 9; i++) { //Loop 8 ganger, for hvert bord
            var elementId = "Bord" + String(i); 
            var currentButton = document.getElementById(elementId); //får id'en for knappen
            elementId = "h1" + elementId;
            var currentH1 = document.getElementById(elementId); //får id'en for h1 taggen
            var opptattLedig = currentH1.textContent; //Henter teksten inne i h1 taggen
            if (opptattLedig == "Opptatt") { //Hvis bordet er opptatt skru av knappen og skift fargen på teksten til rød
                currentButton.disabled = true;
                currentButton.style.cursor = "auto";
                currentH1.style.color = "rgb(197, 45, 45)";
            } else { //Hvis bordet ikke er opptatt skift fargen til grønn
                currentH1.style.color = "rgb(11, 240, 11)";
            }
        }
    }
    
    function checkOptions(){ //funksjon for å skru av options på opptatte bord på mobil
        for (let i = 1; i < 9; i++) { //Loop 8 ganger, for hvert bord
            var elementId = "optionBord" + String(i); 
            var currentOption = document.getElementById(elementId); //får element for option
            var optionValue = currentOption.value; //Får valuen i option
            if(optionsArray.includes(optionValue)) { //Hvis bordet for option er opptatt, fjern option
                currentOption.disabled = true;
            }
        }
    }

    checkButtons();
    checkOptions();
</script>
</html>

<?php
$sql = "SELECT * FROM brukere WHERE brukernavn='$brukernavn' AND passord='$passord'"; //SQL kode for å hente brukernavn og passord

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) === 1) { //Sjekker om brukernavn og passord bruker skrev inn er riktig
    $row = mysqli_fetch_assoc($result);
    if($row['brukernavn'] === $brukernavn && $row['passord'] === $passord) {
        if(isset($_POST["bord"])) { //registrerer bord
            $sql = "UPDATE `reserver_info` SET `bord`='$bord' WHERE `id`='$bordid'"; //Registrer bord til spesifikk reservasjon
            $result = $conn-> query($sql);

            echo '<style type="text/css">
                .bord_varsel_container {
                    display: inline;
                }
                </style>';
        };
    };
};
?>