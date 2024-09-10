<?php
//Lager array av alle variabler fra forrige side
$personerArray = array('1_2_personer', '3_4_personer', '5_6_personer', '7_8_personer', '9_personer');
if(!isset($_POST['antallPersoner'])){
    foreach($personerArray as $x) { //Gjør dataen mer leselig
        if (isset($_POST[$x])) {
            if($x == '1_2_personer') {
                $antallPersoner = "1 til 2 personer.";
            }elseif($x == '3_4_personer') {
                $antallPersoner = "3 til 4 personer.";
            }elseif($x == '5_6_personer') {
                $antallPersoner = "5 til 6 personer.";
            }elseif($x == '7_8_personer') {
                $antallPersoner = "7 til 8 personer.";
            }elseif($x == '9_personer') {
                $antallPersoner = "9 eller flere personer.";
            };
        };
    };
} else {
    $antallPersoner = $_POST['antallPersoner'];
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> <!--Bruker jQuery for kalender-->
    <link rel="stylesheet" href="/resources/demos/style.css"> <!--Bruker jQuery for kalender-->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script> <!--Bruker jQuery for kalender-->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> <!--Bruker jQuery for kalender-->
    <script>
    $( function() { //Script som spesifiserer ting for jQuery kalender
        $( "#datepicker" ).datepicker({
            dateFormat: "dd-mm-yy", 
            dayNamesMin: [ "Sø", "Ma", "Ti", "On", "To", "Fr", "Lø" ], 
            monthNames: [ "Januar", "Februar", "Mars", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Desember" ], 
            monthNamesShort: [ "Jan", "Feb", "Mar", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Des" ], 
            changeMonth: true, 
            changeYear: true, 
            minDate: 0+1,
            maxDate: "+3m",
        });
    });
    </script>
</head>
<body class="reserver_body">
    <header>
        <a href="index.php"><img src="images/La_Bella_Luna_Logo.svg" alt="La Bella Luna Logo"></a>
    </header>
    <div class="reserver_input_container" id="klokkeslett_dato">
        <h1 class="reserver_input_container_headline">Velg en dato.</h1>
        <form action="velgklokkeslett.php" method="POST" class="dato_klokkeslett_form" id="dato_klokkeslett_form">
            Dato: 
            <br>
            <input name="dato" type="text" id="datepicker" required onkeypress="return false;" required/>
            <input type="hidden" name="antallPersoner" value="<?php echo $antallPersoner; ?>"> <!--Sender dataen videre til neste side-->
        </form>
        <div class="neste_knapp_container">
            <input type="submit" value="Neste" form="dato_klokkeslett_form" class="neste_knapp">
        </div>
    </div>
</body>
</html>