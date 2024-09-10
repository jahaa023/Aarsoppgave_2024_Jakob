<?php
$dato = $_POST['dato']; //Henter variabler fra forrige side
$klokkeslett = $_POST['klokkeslett'];
$antallPersoner = $_POST['antallPersoner'];
$fornavn = $_POST['fornavn'];
$etternavn = $_POST['etternavn'];
$telefonnummer = $_POST['telefonnummer'];
$epost = $_POST['epost'];

require __DIR__ . '/validate.php'; //Validerer alle variablene sånn at html eller javascript kode ikke kan bli tatt inn i databasen
$dato = validate($dato);
$klokkeslett = validate($klokkeslett);
$antallPersoner = validate($antallPersoner);
$fornavn = validate($fornavn);
$etternavn = validate($etternavn);
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
<body class="reserver_body" id="reserver_body_sammendrag">
    <header>
        <a href="index.php"><img src="images/La_Bella_Luna_Logo.svg" alt="La Bella Luna Logo"></a>
    </header>
    <div class="reserver_input_container" id="input_container_sammendrag">
        <h1 class="reserver_input_container_headline">Sammendrag og notater</h1>
        <div class="sammendrag_notater_container">
            <div class="sammendrag_container">
                <p>Navn: <?php echo $fornavn . ' ' . $etternavn; ?></p>
                <p>Telefonnummer: <?php echo $telefonnummer; ?></p>
                <p>E-post: <?php echo $epost; ?></p>
                <p>Dato: <?php echo $dato; ?></p>
                <p>Klokkeslett: <?php echo $klokkeslett; ?></p>
                <p>Antall personer: <?php echo $antallPersoner; ?></p>
                <p>Du har reservasjon i en time.</p>
            </div>
            <form action="reservarsjon.php" method="POST" class="notater_form" id="notater_form">
                Skriv inn spesielle <br>
                forespørsler her: <br>
                (ikke obligatorisk)
                <br>
                <textarea cols="30" rows="10" name="notater"></textarea>
                <br>
                <input type="hidden" name="antallPersoner" value="<?php echo $antallPersoner; ?>"> <!--Sender dataen videre til neste side-->
                <input type="hidden" name="dato" value="<?php echo $dato; ?>"> <!--Sender dataen videre til neste side-->
                <input type="hidden" name="klokkeslett" value="<?php echo $klokkeslett; ?>"> <!--Sender dataen videre til neste side-->
                <input type="hidden" name="fornavn" value="<?php echo $fornavn; ?>"> <!--Sender dataen videre til neste side-->
                <input type="hidden" name="etternavn" value="<?php echo $etternavn; ?>"> <!--Sender dataen videre til neste side-->
                <input type="hidden" name="telefonnummer" value="<?php echo $telefonnummer; ?>"> <!--Sender dataen videre til neste side-->
                <input type="hidden" name="epost" value="<?php echo $epost; ?>"> <!--Sender dataen videre til neste side-->
            </form>
        </div>
        <div class="neste_knapp_container">
            <input type="submit" value="Reserver bord" form="notater_form" class="neste_knapp" id="reserver_bord_knapp">
        </div>
    </div>
</body>
</html>