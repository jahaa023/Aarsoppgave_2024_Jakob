<?php //Henter variabler fra forrige side
    $dato = $_POST['dato'];
    $klokkeslett = $_POST['klokkeslett'];
    $antallPersoner = $_POST['antallPersoner'];
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
    <div class="reserver_input_container" id="personlig_info">
        <h1 class="reserver_input_container_headline">Personlig info</h1>
        <form action="sammendrag_notater.php" method="POST" class="personlig_info_form" id="personlig_info_form">
            Fornavn:
            <input type="text" name="fornavn" id="personlig_info_input" required>
            Etternavn:
            <input type="text" name="etternavn" id="personlig_info_input" required>
            Telefonnummer:
            <input type="number" name="telefonnummer" id="personlig_info_input" required>
            E-post:
            <input type="email" name="epost" id="personlig_info_input" required>
            <input type="hidden" name="antallPersoner" value="<?php echo $antallPersoner; ?>"> <!--Sender dataen videre til neste side-->
            <input type="hidden" name="dato" value="<?php echo $dato; ?>"> <!--Sender dataen videre til neste side-->
            <input type="hidden" name="klokkeslett" value="<?php echo $klokkeslett; ?>"> <!--Sender dataen videre til neste side-->
        </form>
        <div class="neste_knapp_container">
            <input type="submit" value="Neste" form="personlig_info_form" class="neste_knapp">
        </div>
    </div>
</body>
</html>