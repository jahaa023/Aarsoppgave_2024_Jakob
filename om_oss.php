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
</head>
<body>
    <header>
        <a href="index.php"><img src="images/La_Bella_Luna_Logo.svg" alt="La Bella Luna Logo"></a>
        <div class="logg_inn_knapp_container">
            <h1>Er du ansatt? <br class="logg_inn_knapp_mobil_breakline"> <a class="logg_inn_knapp_link" href="login.php">Logg inn</a></h1>
        </div>
        <div class="header_link_container">
            <a href="index.php">Hjem</a>
        </div>
    </header>
    <div class="hero_image_om_oss">
        <h1>Om La Bella Luna Restaurant</h1>
    </div>
    <div class="meny_om_oss">
        <h1>Vi ofrer god italiensk mat, med en komfortabel matopplevelse </h1>
        <a href="resources/meny_labellaluna.pdf">Se vår meny</a>
    </div>
    <div class="om_oss_info">
        <h1>Om La Bella Luna Restaurant</h1>
        <p>Vi er en restaurant som <br>
        serverer italiensk mat <br>
        for en god pris. <br>
        Spis maten vår. Nå. 
        </p>
    </div>
    <footer>
        <div class="footer_top">
            <img src="images/La_Bella_Luna_Logo_hvit.svg" alt="La Bella Luna Logo">
        </div>
        <div class="footer_divider"></div>
        <div class="footer_bottom">
            <div class="footer_links_container">
                <a href="mailto:labellalunarestaurant@outlook.com">Kontakt La Bella Luna på epost: labellalunarestaurant@outlook.com</a>
                <h1>La Bella Luna Restaurant 2024 ©</h1>
            </div>
        </div>
    </footer>
</body>
</html>