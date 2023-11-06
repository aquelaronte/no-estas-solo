<?php
$id_quote = $_GET["id_quote"];

require_once "../../models/quotes.php";

$quotesModel = new QuotesModel();
$quotesModel->finishQuote($id_quote);

header('Location: ../../../public/quotes_p.php');
