<?php
require_once "../app/models/quotes.php";

$quotesModel = new QuotesModel();

$response = $quotesModel->getQuotes_psychologist();
$_SESSION["quotes"] = $response;
