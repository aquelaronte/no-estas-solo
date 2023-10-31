<?php
$id_quote = $_GET["id_quote"];

require_once "../../models/quotes.php";

$quotesModel = new QuotesModel();
$quotesModel->finishQuote($id_quote);

header('Location: http://localhost/no%20estas%20solo/public/quotes_p.php');
