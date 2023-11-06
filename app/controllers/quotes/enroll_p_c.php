<?php
session_start();
$id_quote = $_POST["id_quote"];
$appointment_date = $_POST["appointment_date"];
$id_psychologist = $_SESSION["user"]["id"];

require "../../models/quotes.php";
$quotesModel = new QuotesModel();

$quotesModel->enroll_psichologyst($id_quote, $id_psychologist, $appointment_date);

header("Location: ../../../public/quotes_p.php");

?>