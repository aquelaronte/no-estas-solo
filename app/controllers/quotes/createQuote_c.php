<?php
session_start();
$id_student = $_SESSION["user"]["id"];
$title = $_POST["title"];
$description = $_POST["description"];
$creation_date = $_POST["creation_date"];

require_once "../../models/quotes.php";

$quotesModel = new QuotesModel();

$response = $quotesModel->createQuote($id_student, $title, $description, $creation_date);
header("Location: ../../../public/quotes.php");
