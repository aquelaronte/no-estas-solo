<?php
session_start();
$id_user = $_SESSION["user"]["id"];
$title = $_POST["title"];
$description = $_POST["description"];

require_once "../../models/notes.php";

$notesModel = new NotesModel();

$response = $notesModel->createNote($id_user, $title, $description);

header("Location: ../../../public/notes.php");
