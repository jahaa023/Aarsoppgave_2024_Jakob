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
<body class="body_index">
    <header>
        <a href="index.php"><img src="images/La_Bella_Luna_Logo.svg" alt="La Bella Luna Logo"></a>
        <div class="logg_inn_knapp_container">
            <h1>Er du ansatt? <br class="logg_inn_knapp_mobil_breakline"> <a class="logg_inn_knapp_link" href="login.php">Logg inn</a></h1>
        </div>
        <div class="header_link_container">
            <a href="om_oss.php">Om oss</a>
        </div>
    </header>
    <div class="index_image"></div>
    <div class="text_container">
        <h1>Reserver bord hos La Bella Luna</h1>
        <form action="antall_personer.php"><button>Reserver bord.</button></form>
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