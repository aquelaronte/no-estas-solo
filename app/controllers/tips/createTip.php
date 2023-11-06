<?php
$title = $_POST["title"];
$description = $_POST["description"];
$id_psychologist = $_POST["id_psychologist"];

require "../../models/tips.php";

$tipsModel = new TipsModel();

$tipsModel->createTip($title, $description, $id_psychologist);

header('Location: ../../../public/tips.php')
?>