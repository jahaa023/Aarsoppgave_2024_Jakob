<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Bella Luna Restaurant</title>
    <link rel="icon" type="image/x-icon" href="images/La_Bella_Luna_favicon.png"> <!--Favicon-->
    <link rel="stylesheet" href="style.css">
    <style><?php include "style.css"?></style> <!-- bruker php for å importe style.css pga cache problemer -->
    <link rel="stylesheet" href="https://use.typekit.net/sxl6kxv.css"> <!--Font fra Adobe-->
</head>
<body class="reserver_body">
    <header>
        <a href="index.php"><img src="images/La_Bella_Luna_Logo.svg" alt="La Bella Luna Logo"></a>
    </header>
    <div class="reserver_input_container">
        <h1 class="reserver_input_container_headline">Hvor mange personer blir det?</h1>
        <form action="velgdato.php" class="antall_personer_form" method="POST">
            <div class="antall_personer_button_row">
                <button name="1_2_personer">1 - 2 personer</button>
                <button name="3_4_personer">3 - 4 personer</button>
                <button name="5_6_personer">5 - 6 personer</button>
            </div>
            <br>
            <div class="antall_personer_button_row">
                <button name="7_8_personer">7 - 8 personer</button>
                <button name="9_personer">9 eller flere personer</button>
            </div>
        </form>
    </div>
</body>
</html>