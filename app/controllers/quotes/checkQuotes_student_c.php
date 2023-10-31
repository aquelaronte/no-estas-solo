<?php
$id_user = $_SESSION["user"]["id"];

require_once "../app/models/quotes.php";

$quotesModel = new QuotesModel();

$response = $quotesModel->getQuotes_student($id_user);
$_SESSION["quotes"] = $response;
