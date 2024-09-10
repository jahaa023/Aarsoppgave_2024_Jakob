<?php
//Importerer nødvendige ressurser
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function sendMail($mottaker, $fornavn, $etternavn, $dato, $klokkeslett, $antallPersoner, $notater){ //funksjon for å sende e-post
//Lager en instance
$mail = new PHPMailer(true);

try {
    //Server innstillinger
    $mail->CharSet = "UTF-8"; //For å støtte norske bokstaver
    $mail->Encoding = 'base64'; //For å støtte norske bokstaver
    $mail->SMTPDebug = 0; //Gjemmer error codes fra brukeren
    $mail->isSMTP(); //spesifiserer om eposten skal sendes gjennom smtp
    $mail->Host       = 'smtp.office365.com'; //hvilken smtp server emailen sendes fra
    $mail->SMTPAuth   = true; //Gjør at man trenger passord og brukernavn for å sende epost
    $mail->Username   = 'example@outlook.com'; //Outlook kontoen som eposten sendes fra
    $mail->Password   = 'examplepassword'; //Passord til outlook kontoen
    $mail->Port       = 587; //Port for office365 sin SMTP server

    //Fra og til
    $mail->setFrom('example@outlook.com', 'La Bella Luna Restaurant'); //Spesifiserer sender av e-post
    $mail->addAddress($mottaker); //Spesifiserer mottaker av e-post

    //Innhold
    $mail->isHTML(true); //Setter e-post type til HTML
    $mail->Subject = 'Din reservasjon hos La Bella Luna'; //Overskrift på mail
    //HTML dokumentet som laster på e-posten.
    if(empty($notater)){ //Tar med spesielle forespørsler hvis bruker har skrevet spesielle forespørsler
    $mail->Body = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </head>
    <body>
        <img src='https://i.ibb.co/0Kjrptx/La-Bella-Luna-Logo.png' alt='La Bella Luna Restaurant Logo' style='width: 80px; height: 80px;'>
        <br>
        Informasjon om din reservasjon hos La Bella Luna:
        <br>
        Fornavn: $fornavn
        <br>
        Etternavn: $etternavn
        <br>
        Dato for reservasjon: $dato
        <br>
        Klokkeslett for reservasjon: $klokkeslett
        <br>
        Antall personer for reservasjonen: $antallPersoner
        <br>
        <br>
        Lurer du på noe? Kontakt La Bella Luna Restaurant via epost: <a href='mailto:labellalunarestaurant@outlook.com'>labellalunarestaurant@outlook.com</a>
    </body>
    ";
    //Plaintext som laster på eposten for enheter som ikke støtter HTML eposter
    $mail->AltBody = "
    Informajon om din reservasjon hos La Bella Luna:
    Fornavn: $fornavn
    Etternavn: $etternavn
    Dato for reservasjon: $dato
    Klokkeslett for reservasjon: $klokkeslett
    Antall personer for reservasjonen: $antallPersoner

    Har noen spørsmål? Kontakt La Bella Luna Restaurant via epost: labellalunarestaurant@outlook.com
    ";
    } else {
    $mail->Body = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </head>
    <body>
        <img src='https://i.ibb.co/0Kjrptx/La-Bella-Luna-Logo.png' alt='La Bella Luna Restaurant Logo' style='width: 80px; height: 80px;'>
        <br>
        Informasjon om din reservasjon hos La Bella Luna:
        <br>
        Fornavn: $fornavn
        <br>
        Etternavn: $etternavn
        <br>
        Dato for reservasjon: $dato
        <br>
        Klokkeslett for reservasjon: $klokkeslett
        <br>
        Antall personer for reservasjonen: $antallPersoner
        <br>
        Spesielle forespørsler: $notater
        <br>
        <br>
        Lurer du på noe? Kontakt La Bella Luna Restaurant via epost: <a href='mailto:labellalunarestaurant@outlook.com'>labellalunarestaurant@outlook.com</a>
    </body>
    ";
    //Plaintext som laster på eposten for enheter som ikke støtter HTML eposter
    $mail->AltBody = "
    Informajon om din reservasjon hos La Bella Luna:
    Fornavn: $fornavn
    Etternavn: $etternavn
    Dato for reservasjon: $dato
    Klokkeslett for reservasjon: $klokkeslett
    Antall personer for reservasjonen: $antallPersoner

    Har noen spørsmål? Kontakt La Bella Luna Restaurant via epost: labellalunarestaurant@outlook.com
    ";
    };

    $mail->send(); //Sender e-posten
    $_SESSION['epost_bekreft'] = "Du får tilsendt en epost på: <br> $mottaker";
} catch (Exception $e) { //Hvis noe går galt så kommer en error.
    $_SESSION['epost_bekreft'] = "Reservarsjonen er registrert,<br>men kunne ikke sende e-post.";
    echo "<script>alert('Kunne ikke sende e-post!')</script>";
}
}