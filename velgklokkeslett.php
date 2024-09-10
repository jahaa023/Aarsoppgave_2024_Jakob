<?php
$dato = $_POST['dato']; //Henter variabler fra forrige side
$antallPersoner = $_POST['antallPersoner'];

require __DIR__ . '/validate.php'; //Validerer alle variablene sånn at html eller javascript kode ikke kan bli tatt inn i databasen
$dato = validate($dato);
$antallPersoner = validate($antallPersoner);
$klokkeslettArray = array();
$opptatteKlokkeslett = array();
echo "<script> const opptattKlokkeslettArray = []; </script>"; //Array i javascript som må defineres før resten av koden
include "db_conn.php"; //Kobler til database

$sql = "SELECT * FROM reserver_info WHERE dato='$dato'"; //SQL kode for å hente klokkeslett som er reservert på datoen
$result = mysqli_query($conn, $sql);
if ($result-> num_rows > 0) { //sjekker at resultatet ikke er tomt
    while ($row = $result-> fetch_assoc()) { //for hver row i database som har lik dato, sjekk hvilke klokkeslett som er tatt.
        array_push($klokkeslettArray, $row['klokkeslett']); //Legger alle reserverte klokkeslett på datoen inn i en array
    };
};

$duplicates = array_count_values($klokkeslettArray); //Sjekker hvilke klokkeslett har mer enn eller lik 3 reservarsjoner, og tar det inn i en javascript array
foreach ($duplicates as $key => $value) { 
    if ($value >= 3) { 
        echo "<script>opptattKlokkeslettArray.push('" . $key . "');</script>";
    }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Bella Luna Restaurant</title>
    <link rel="icon" type="image/x-icon" href="images/La_Bella_Luna_favicon.png"> <!--Favicon-->
    <link rel="stylesheet" href="https://use.typekit.net/sxl6kxv.css"> <!--Font fra Adobe-->
    <style><?php include "style.css"?></style> <!-- bruker php for å importe style.css pga cache problemer -->
</head>
<body class="reserver_body">
    <header>
        <a href="index.php"><img src="images/La_Bella_Luna_Logo.svg" alt="La Bella Luna Logo"></a>
    </header>
    <form action="velgdato.php" id="endre_dato_form" method="POST">
        <input type="hidden" name="antallPersoner" value="<?php echo $antallPersoner; ?>"> <!--Sender dataen videre til neste side-->
    </form>
    <div class="reserver_input_container" id="klokkeslett_dato">
        <h1 class="reserver_input_container_headline">Velg ett klokkeslett.</h1>
        <form action="personlig_info.php" method="POST" class="dato_klokkeslett_form" id="dato_klokkeslett_form">
        Dato: <?php echo $dato; ?> <br id="endre_dato_break"> <button id="endre_dato_knapp" form="endre_dato_form">Endre</button>
        <br>
        Klokkeslett:
            <br> 
            <select name="klokkeslett" class="klokkeslett_input" required>
                <option hidden disabled selected value>Velg ett klokkeslett.</option>
                <option value="12:00" id="12:00">12:00</option>
                <option value="13:00" id="13:00">13:00</option>
                <option value="14:00" id="14:00">14:00</option>
                <option value="15:00" id="15:00">15:00</option>
                <option value="16:00" id="16:00">16:00</option>
                <option value="17:00" id="17:00">17:00</option>
                <option value="18:00" id="18:00">18:00</option>
                <option value="19:00" id="19:00">19:00</option>
                <input type="hidden" name="antallPersoner" value="<?php echo $antallPersoner; ?>"> <!--Sender dataen videre til neste side-->
                <input type="hidden" name="dato" value="<?php echo $dato; ?>"> <!--Sender dataen videre til neste side-->
            </select>
            <br>
        </form>
        <div class="neste_knapp_container">
            <input type="submit" value="Neste" form="dato_klokkeslett_form" class="neste_knapp">
        </div>
    </div>
    <script>
        function checkKlokkeslett(){ //Skrur av klokkeslett options som er opptatte
            opptattKlokkeslettArray.forEach((element) => {
                currentElement = document.getElementById(element);
                currentElement.disabled = true;
                currentElement.title = "Dette klokkeslettet er opptatt";
            });
        }

        checkKlokkeslett();
    </script>
</body>
</html>