<?php
session_start();
$dato = $_POST['dato']; //Henter variabler fra forrige side
$klokkeslett = $_POST['klokkeslett'];
$antallPersoner = $_POST['antallPersoner'];
$fornavn = $_POST['fornavn'];
$etternavn = $_POST['etternavn'];
$telefonnummer = $_POST['telefonnummer'];
$epost = $_POST['epost'];
$epostBekreft = "";

include __DIR__ . '/phpmail/mail.php';
require __DIR__ . '/validate.php';

if (isset($_POST['notater'])) { //Sjekker om bruker har skrevet inn spesielle forespørsler eller ikke
    $notater = $_POST['notater'];
    $notater = validate($notater);
} else {
    $notater = "";
};

include "db_conn.php"; //Kobler til database

if (!$conn){ //Varsler brukeren hvis nettsiden ikke kunne koble til database
    $storTekst = "Kunne ikke registrere reservasjon. Prøv igjen senere.";
    goto end;
}

$sjekkDuplikat = mysqli_query($conn, "SELECT * from reserver_info WHERE dato = '$dato' AND klokkeslett = '$klokkeslett' AND antall_personer = '$antallPersoner' AND fornavn = '$fornavn' AND etternavn = '$etternavn' AND telefonnummer = '$telefonnummer' AND epost = '$epost'"); //sjekker om duplikat av reservasjon allerede finnes på database

if (mysqli_num_rows($sjekkDuplikat) > 0) { //Lar deg ikke reservere hvis reservasjonen allerede finnes
    $storTekst = "Denne reservasjonen er allerede registrert.";
    goto end;
};

$sql = "INSERT INTO `reserver_info`(`fornavn`, `etternavn`, `telefonnummer`, `epost`, `dato`, `klokkeslett`, `notater`, `antall_personer`) VALUES ('$fornavn','$etternavn','$telefonnummer','$epost','$dato','$klokkeslett','$notater','$antallPersoner')"; //SQL kode for å inserte reservasjon data inn i database

$run = mysqli_query($conn, $sql); //kjører SQL koden

sendMail($epost, $fornavn, $etternavn, $dato, $klokkeslett, $antallPersoner, $notater);

if ($run) { //sjekker om dataen ble sendt
    $storTekst = "Din reservasjon er registrert.";
    $epostBekreft = $_SESSION['epost_bekreft'];
} else {
    $storTekst = "Kunne ikke registrere reservasjon. Prøv igjen senere.";
    $epostBekreft = "";
}
end:
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Bella Luna Restaurant</title>
    <link rel="icon" type="image/x-icon" href="images/La_Bella_Luna_favicon.png"> <!--Favicon-->
    <style><?php include "style.css"?></style> <!-- bruker php for å importe style.css pga cache problemer -->
    <link rel="stylesheet" href="https://use.typekit.net/sxl6kxv.css"> <!--Font fra Adobe-->
</head>
<body class="reserver_body">
    <header>
        <a href="index.php"><img src="images/La_Bella_Luna_Logo.svg" alt="La Bella Luna Logo"></a>
    </header>
    <div class="reserver_input_container">
        <div class="registrert_container">
            <h1 class="registrert_headline"><?php echo $storTekst; ?></h1>
            <p class="epost_bekreft"><?php echo $epostBekreft; ?></p>
        </div>
        <div class="tilbake_hjem_container">
            <a class="registrert_button" href="index.php">Tilbake hjem</a>
        </div>
    </div>
</body>
</html>