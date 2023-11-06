<?php
$id = $_GET["id"];

require_once "../../models/notes.php";

$notesModel = new NotesModel();

$response = $notesModel->deleteNote($id);

header("Location: ../../../public/notes.php");
