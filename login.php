<?php
$feilPassord = 0;
if(isset($_POST['uname'])){
    $feilPassord = 1;
    session_start();
    include "db_conn.php";

    require __DIR__ . '/validate.php'; //Gjør at man ikke kan sende html eller javascript kode gjennom forms

    //Henter data fra login side
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    $sql = "SELECT * FROM brukere WHERE brukernavn='$uname' AND passord='$pass'"; //SQL kode for å hente brukernavn og passord

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) === 1) { //Sjekker om brukernavn og passord bruker skrev inn er riktig
        $row = mysqli_fetch_assoc($result);
        if($row['brukernavn'] === $uname && $row['passord'] === $pass) {
            $_SESSION['brukernavn'] = $row['brukernavn'];
            $_SESSION['passord'] = $row['passord'];
            header("Location: liste.php");
            exit();
        };
    };
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logg inn som ansatt</title>
    <style><?php include "style.css"?></style> <!-- bruker php for å importe style.css pga cache problemer -->
    <link rel="stylesheet" href="https://use.typekit.net/sxl6kxv.css"> <!--Font fra Adobe-->
    <link rel="icon" type="image/x-icon" href="images/La_Bella_Luna_favicon.png"> <!--Favicon-->
</head>
<body>
    <div class="logg_inn_container">
        <img src="images/La_Bella_Luna_Logo.svg" alt="La Bella Luna Logo">
        <h1>Logg inn:</h1>
        <form action="login.php" method="POST" class="logg_inn_form">
            <input type="text" name="uname" placeholder="Brukernavn" required>
            <br>
            <input type="password" name="password" placeholder="Passord" required>
            <br>
            <h1 id="feilPassord">Brukernavn eller passord feil! Prøv igjen.</h1>
            <input type="submit" value="Logg inn" id="logg_inn_form_knapp">
        </form>
    </div>
</body>
</html>

<?php
if($feilPassord == 1) { //Varsler bruker hvis passord er feil
    echo '<style type="text/css">
    #feilPassord {
        display: inline;
    }
    </style>';
};
?>