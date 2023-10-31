<?php
require_once "../app/models/quotes.php";

$quotesModel = new QuotesModel();
$id_psychologist = $_SESSION['user']['id'];

$response = $quotesModel->getQuotes_aware($id_psychologist);
$_SESSION["quotes_aware"] = $response;

